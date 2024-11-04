<?php

namespace App\Livewire\Forms;

use App\Livewire\Partner\Pages\Availability\Show;
use App\Mail\notFoundOrders;
use App\Models\AvailabilityDate;
use App\Models\AvailabilityTime;
use App\Models\CartItem;
use App\Models\Order;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Support\Facades\Mail;
use Livewire\Form;

class EditAvailabilityDateForm extends Form
{
    public AvailabilityDate $availability_date;

    public $adults_price = null;

    public $kids_price = null;

    public $children_price = null;

    public $dates = [];

    public $time_start = null;

    public $time_end = null;

    public $step = null;

    public $vehicles_per_slot = null;

    public $participants_per_vehicle = null;

    public $rental_total_price = null;

    public function setAvailabilityDate(?AvailabilityDate $availability_date)
    {
        $this->availability_date = $availability_date;

        $this->adults_price = $availability_date->adults_price;
        $this->kids_price = $availability_date->kids_price;
        $this->children_price = $availability_date->children_price;
        $this->dates = [
            $availability_date->date_start->startOfDay()->format('Y-m-d'),
            $availability_date->date_end->startOfDay()->format('Y-m-d'),
        ];
        $this->time_start = $availability_date->time_start->format('H:i');
        $this->time_end = $availability_date->time_end->format('H:i');
        $this->step = $availability_date->step;
        $this->vehicles_per_slot = $availability_date->vehicles_per_slot;
        $this->participants_per_vehicle = $availability_date->participants_per_vehicle;
        $this->rental_total_price = $availability_date->rental_total_price;
    }

    public function submit($force = false)
    {

        // Formatto le date
        if (Carbon::canBeCreatedFromFormat($this->dates[0], 'Y-m-d')) {
            $date_start = Carbon::createFromFormat('Y-m-d', $this->dates[0])->startOfDay();
        } else {
            $date_start = Carbon::createFromFormat('d/m/Y', $this->dates[0])->startOfDay();
        }

        if (Carbon::canBeCreatedFromFormat($this->dates[1], 'Y-m-d')) {
            $date_end = Carbon::createFromFormat('Y-m-d', $this->dates[1])->startOfDay();
        } else {
            $date_end = Carbon::createFromFormat('d/m/Y', $this->dates[1])->startOfDay();
        }

        $this->availability_date->date_start = $date_start;
        $this->availability_date->date_end = $date_end;
        $this->availability_date->adults_price = $this->adults_price;
        $this->availability_date->kids_price = $this->kids_price;
        $this->availability_date->children_price = $this->children_price;
        $this->availability_date->time_start = $this->time_start;
        $this->availability_date->time_end = $this->time_end;
        $this->availability_date->step = $this->step;
        $this->availability_date->vehicles_per_slot = $this->vehicles_per_slot;
        $this->availability_date->participants_per_vehicle = $this->participants_per_vehicle;
        $this->availability_date->rental_total_price = $this->rental_total_price;

        // Controllo se ci sono dati modificati
        if ($this->availability_date->isDirty()) {
            // Controllo se tra i dati modificati ci sono le date
            if ($this->availability_date->isDirty('date_start') || $this->availability_date->isDirty('date_end') || $this->availability_date->isDirty('time_start') || $this->availability_date->isDirty('time_end') || $this->availability_date->isDirty('step')) {
                // Controllo sovrapposizioni
                $check = $this->checkOverlap($date_start, $date_end);
                if ($check) {
                    $this->component->addError('overlap', __('Sovrapposizione orari: controllare!'));

                    return false;
                }

                // Controllo se ci sono orari acquistati
                $sold = $this->availability_date->times()->whereDate('date', '>=', now())->where('sold', '>', 0)->get();
                // Se ci sono orari acquistati ritorno un avviso
                if ($sold->count() && ! $force) {
                    $this->component->addError('sold',
                        trans_choice('{1} C\'è :count biglietto venduto|[2,*] Ci sono :count biglietti venduti',
                            $sold->count()));

                    return false;
                } else {
                    // Se non ci sono, continuo con la validazione dei dati
                    $this->validate([
                        'time_start' => 'required|date_format:H:i',
                        'time_end' => 'required|date_format:H:i|after:time_start',
                        'step' => 'required',
                        'vehicles_per_slot' => ! $this->availability_date->availability->product->isRental() ? 'nullable' : 'required',
                        'participants_per_vehicle' => ! $this->availability_date->availability->product->isRental() ? 'nullable' : 'required',
                        'adults_price' => ! $this->availability_date->availability->product->isRental() ? 'required' : 'nullable',
                        'kids_price' => ! $this->availability_date->availability->product->isRental() ? 'required' : 'nullable',
                        'children_price' => ! $this->availability_date->availability->product->isRental() ? 'required' : 'nullable',
                        'rental_total_price' => ! $this->availability_date->availability->product->isRental() ? 'nullable' : 'required|numeric',
                    ]);

                    // .. e l'aggiornamento
                    $this->availability_date->update([
                        'adults_price' => $this->adults_price ?? null,
                        'kids_price' => $this->kids_price ?? null,
                        'children_price' => $this->children_price ?? null,
                        'time_start' => $this->time_start,
                        'time_end' => $this->time_end,
                        'step' => $this->step,
                        'vehicles_per_slot' => $this->vehicles_per_slot,
                        'participants_per_vehicle' => $this->participants_per_vehicle,
                        'rental_total_price' => $this->rental_total_price,
                    ]);

                    // Clono (per utilizzo successivo) e poi elimino gli orari vecchi
                    $oldTimes = clone $this->availability_date->times;
                    $this->availability_date->times()->delete();

                    // Rigenero gli orari con le nuove fasce di data e di tempo
                    $date_period = CarbonPeriod::create($this->availability_date->date_start, '1 day',
                        $this->availability_date->date_end);
                    foreach ($date_period as $date) {
                        $time_period = CarbonPeriod::create($this->availability_date->time_start,
                            "{$this->availability_date->step} minutes", $this->availability_date->time_end);
                        foreach ($time_period as $time) {
                            $this->availability_date->times()->create([
                                'date' => $date->format('Y-m-d'),
                                'time' => $time->format('H:i'),
                                'max' => $this->availability_date->availability->participants ?? $this->availability_date->vehicles_per_slot,
                            ]);
                        }
                    }

                    $newTimes = $this->availability_date->fresh()->times;
                    // In "oldTimes" ci sono data/ora corrispondenti in "newTimes"?
                    // Filtra gli elementi nell'array $newTimes che hanno combinazioni di data e ora presenti nell'array $oldTimes
                    $commonElements = $newTimes->filter(function ($item) use ($oldTimes) {
                        return $oldTimes->contains(function ($oldItem) use ($item) {
                            return $oldItem->date === $item->date && $oldItem->time === $item->time && $oldItem->sold > 0;
                        });
                    });
                    // Quali sono gli orari non più esistenti in newTimes?
                    $notFoundElements = collect();
                    foreach ($oldTimes as $oldItem) {
                        $found = false;

                        foreach ($newTimes as $newItem) {
                            if ($oldItem->date === $newItem->date &&
                                $oldItem->time === $newItem->time &&
                                $oldItem->sold > 0) {
                                $found = true;
                                break;
                            }
                        }

                        // Se l'orario non è stato trovato in $newTimes, aggiungilo agli orari non presenti
                        if (! $found) {
                            if ($oldItem->sold > 0) {
                                $notFoundElements[] = $oldItem;
                            }
                        }
                    }

                    if ($notFoundElements->isNotEmpty()) {
                        $notFoundOrders = Order::query();
                        foreach ($notFoundElements as $notFoundElement) {
                            $notFoundOrders = $notFoundOrders->whereJsonContains('data->booking', ['time_id' => $notFoundElement['id']]);
                            $cart_items = CartItem::where('availability_time_id', $notFoundElement['id'])->get();
                            foreach ($cart_items as $cart_item) {
                                $cart = $cart_item->cart;
                                $cart_item->delete();
                                if ($cart->items->count() === 0) {
                                    $cart->delete();
                                }
                            }
                        }
                    }

                    // Verifica se ci sono elementi comuni
                    if ($commonElements->isNotEmpty()) {
                        // Ci sono elementi comuni
                        // Puoi fare qualcosa qui, ad esempio stampare gli elementi comuni
                        $commonElements->each(function ($item) use ($oldTimes) {
                            $oldItem = $oldTimes->where('date', $item->date)->where('time', $item->time)->first();
                            $el = [
                                'old_id' => $oldItem->id,
                                'new_id' => $item->id,
                                'booked' => $oldItem->booked,
                                'sold' => $oldItem->sold,
                            ];
                            // Modifico l'ex ID con il nuovo ID
                            $orders = Order::whereJsonContains('data->booking', ['time_id' => $el['old_id']])->get();
                            $cart_items = CartItem::where('availability_time_id', $el['old_id'])->get();
                            foreach ($cart_items as $cart_item) {
                                $cart_item->update([
                                    'availability_time_id' => $item->id,
                                ]);
                            }
                            AvailabilityTime::find($el['new_id'])->update([
                                'booked' => $el['booked'],
                                'sold' => $el['sold'],
                            ]);
                            $orders->each(function ($order) use ($el) {
                                $time = AvailabilityTime::find($el['new_id']);
                                $order->update([
                                    'data->booking->time_id' => $time->id,
                                ]);
                            });
                        });
                    }

                    $this->component->closeModal();
                    $this->component->dispatch('availability_updated')->to(Show::class);

                    if (count($notFoundElements)) {
                        $users = [];
                        foreach ($notFoundOrders->get() as $notFoundOrder) {
                            $users[] = $notFoundOrder->user->email;
                        }

                        Mail::to(auth()->user())->send(new NotFoundOrders($this->availability_date, $users));
                    }
                }
            } else {
                $this->validate([
                    'vehicles_per_slot' => ! $this->availability_date->availability->product->isRental() ? 'nullable' : 'required',
                    'participants_per_vehicle' => ! $this->availability_date->availability->product->isRental() ? 'nullable' : 'required',
                    'adults_price' => ! $this->availability_date->availability->product->isRental() ? 'required' : 'nullable',
                    'kids_price' => ! $this->availability_date->availability->product->isRental() ? 'required' : 'nullable',
                    'children_price' => ! $this->availability_date->availability->product->isRental() ? 'required' : 'nullable',
                    'rental_total_price' => ! $this->availability_date->availability->product->isRental() ? 'nullable' : 'required|numeric',
                ]);

                // .. e l'aggiornamento
                $this->availability_date->update([
                    'adults_price' => $this->adults_price ?? null,
                    'kids_price' => $this->kids_price ?? null,
                    'children_price' => $this->children_price ?? null,
                    'vehicles_per_slot' => $this->vehicles_per_slot,
                    'participants_per_vehicle' => $this->participants_per_vehicle,
                    'rental_total_price' => $this->rental_total_price,
                ]);

                $this->component->closeModal();
                $this->component->dispatch('availability_updated')->to(Show::class);
            }
        }
    }

    protected function checkOverlap($date_start, $date_end)
    {
        $dates = [];

        foreach ($this->availability_date->availability->dates->except($this->availability_date->id) as $date) {
            $dates[] = [
                'adults_price' => $date->adults_price,
                'kids_price' => $date->kids_price,
                'children_price' => $date->children_price,
                'dates' => [
                    Carbon::parse($date->date_start)->format('Y-m-d'),
                    Carbon::parse($date->date_end)->format('Y-m-d'),
                ],
                'time_start' => Carbon::createFromTimeString($date->time_start)->format('H:i'),
                'time_end' => Carbon::createFromTimeString($date->time_end)->format('H:i'),
                'step' => $date->step,
                'vehicles_per_slot' => $date->vehicles_per_slot,
                'participants_per_vehicle' => $date->participants_per_vehicle,
                'rental_total_price' => $date->rental_total_price,
            ];
        }

        $dates[] = [
            'adults_price' => $this->adults_price,
            'kids_price' => $this->kids_price,
            'children_price' => $this->children_price,
            'dates' => [
                $date_start->format('Y-m-d'),
                $date_end->format('Y-m-d'),
            ],
            'time_start' => $this->time_start,
            'time_end' => $this->time_end,
            'step' => $this->step,
            'vehicles_per_slot' => $this->vehicles_per_slot,
            'participants_per_vehicle' => $this->participants_per_vehicle,
            'rental_total_price' => $this->rental_total_price,
        ];

        return $this->availability_date->availability->checkOverlap($dates);
    }
}
