<?php

namespace App\Livewire\Forms;

use App\Models\AvailabilityDate;
use App\Models\AvailabilityTime;
use App\Models\CartItem;
use App\Models\GiftCard;
use App\Models\Product;
use Carbon\Carbon;
use Livewire\Attributes\Computed;
use Livewire\Form;

class CartItemForm extends Form
{
    public ?CartItem $cart_item;

    public ?Product $product;

    public ?GiftCard $gift_card;

    public $availability_date = null;

    public $date = null;

    public $time = null;

    public $adults = null;

    public $kids = null;

    public $children = null;

    public $time_list = [];

    public $receiver_name = null;

    public $receiver_email = null;

    public $receiver_message = null;

    public function setCartItem(?CartItem $cart_item)
    {
        $this->cart_item = $cart_item;
        match ($cart_item->type) {
            'product' => call_user_func(function () use ($cart_item) {
                $this->product = $cart_item->product;
                $availability_time = AvailabilityTime::find($cart_item->availability_time_id);
                $this->time = $availability_time->id;
                $this->date = Carbon::parse($availability_time->date)->startOfDay()->format('Y-m-d');
                $this->adults = $cart_item->adults ?? 0;
                $this->kids = $cart_item->kids ?? 0;
                $this->children = $cart_item->children ?? 0;
                $this->calculateTimeList($this->date);
                $this->updatedTime();
            }),
            'gift-card' => call_user_func(function () use ($cart_item) {
                $this->gift_card = $cart_item->gift_card;
            }),
        };

        $this->receiver_name = $cart_item->receiver_name ?? '';
        $this->receiver_email = $cart_item->receiver_email ?? '';
        $this->receiver_message = $cart_item->receiver_message ?? '';

    }

    public function calculateTimeList($date)
    {
        $date = rescue(fn() => Carbon::createFromFormat('Y-m-d', $date)->format('Y/m/d'), $date);
        if ($date) {
            $productId = $this->product->id;
            $today = Carbon::today()->format('Y/m/d');

            // Controllo se la data è nel passato confrontandola direttamente con la data odierna
            if ($date < $today) {
                $this->time_list = [];

                return;
            }

            $availability_dates = AvailabilityDate::whereHas('availability', function ($q) use ($date, $productId) {
                $q->where('product_id', $productId)
                    ->whereDate('date_start', '<=', $date)
                    ->whereDate('date_end', '>=', $date);
            })->get();

            $this->availability = $availability_dates->first()->availability ?? null;

            $time_list = [];

            foreach ($availability_dates as $availability_date) {
                $times = $availability_date->times()->whereColumn('max', '!=', 'sold')->whereDate('date', $date)->get();
                foreach ($times as $time) {
                    $formatted_time = Carbon::createFromTimeString($time->time)->format('H:i');

                    // Se la data è oggi, confronta l'orario con l'orario attuale
                    if ($date == $today) {
                        $current_time = Carbon::now()->format('H:i');
                        if ($formatted_time > $current_time) {
                            $time_list[$time->id] = $formatted_time;
                        }
                    } else {
                        // Se la data è futura, includo tutti gli orari
                        $time_list[$time->id] = $formatted_time;
                    }
                }
            }
            $this->time_list = $time_list;
        }
    }

    public function updatedTime()
    {
        $time = AvailabilityTime::find($this->time);
        $this->availability_date = $time->availability_date;
    }

    #[Computed]
    public function total()
    {
        $availability_time = AvailabilityTime::find($this->time);
        if ($availability_time) {
            return $availability_time->getTotalPrice($this->adults, $this->kids, $this->children);
        } else {
            return 0;
        }
    }

    public function updatedDate($newDate)
    {
        $this->time = null;
        if ($newDate !== null) {
            $this->date = Carbon::createFromFormat('d/m/Y', $newDate)->format('Y/m/d');
            $this->calculateTimeList($this->date);
        }
    }

    public function increment($what)
    {
        $this->$what++;
        session()->put($what, $this->$what);
    }

    public function decrement($what)
    {
        if ($this->$what > 0) {
            $this->$what--;
            session()->put($what, $this->$what);
        }
    }

    public function updateGiftData()
    {
        $this->validate([
            'receiver_name' => 'required',
            'receiver_email' => 'required|email',
            'receiver_message' => 'nullable',
        ]);
        $this->cart_item->update([
            'receiver_name' => $this->receiver_name,
            'receiver_email' => $this->receiver_email,
            'receiver_message' => $this->receiver_message,
        ]);

        $this->component->dispatch('cart-item-updated');
    }

    public function checkAvailability()
    {
        $availability = AvailabilityTime::find($this->time);

        // Verifico se la data e l'orario selezionati sono passati rispetto alla data e all'orario attuali
        if (Carbon::parse($availability->date.' '.$availability->time) <= now()) {
            $this->component->addError('date_past', 'Spiacenti, la data o l\'ora selezionati risultano passati. Ti invitiamo a provare un\'altra combinazione.');

            $this->calculateTimeList($this->date);

            return;
        }

        if ($this->product->isRental()) {
            $slots = $availability->realAvailability;
            if ($this->participants() > $availability->availability_date->participants_per_vehicle) {
                $this->component->addError('slots', 'Purtroppo il numero di partecipanti supera la capienza massima del mezzo.');
            } elseif ($slots <= 0) {
                $this->component->addError('slots', 'Purtroppo non ci sono abbastanza posti disponibili per questa data/ora. Ti invitiamo a provare un\'altra combinazione.');
            } else {
                $this->component->dispatch('update-cart-item', $this->cart_item, $availability->id, $this->adults, $this->kids, $this->children);
            }
        } else {
            $slots = $availability->max - (($availability->booked - $this->cart_item->participants) + $availability->sold);
            if ($slots < $this->participants()) {
                $this->component->addError('slots', 'Purtroppo non ci sono abbastanza posti disponibili per questa data/ora. Ti invitiamo a provare un\'altra combinazione.');
            } else {
                $this->component->dispatch('update-cart-item', $this->cart_item, $availability->id, $this->adults, $this->kids, $this->children);
            }
        }
    }

    #[Computed]
    public function participants()
    {
        return $this->adults + $this->kids + $this->children;
    }
}
