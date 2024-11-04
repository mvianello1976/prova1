<?php

namespace App\Livewire\Forms;

use App\Models\AvailabilityDate;
use App\Models\AvailabilityTime;
use App\Models\Order;
use App\Models\Product;
use Carbon\Carbon;
use Livewire\Attributes\Computed;
use Livewire\Form;

class OrderForm extends Form
{
    public ?Order $order;

    public Product $product;

    public $availability_date = null;

    public $date = null;

    public $time = null;

    public $adults = null;

    public $kids = null;

    public $children = null;

    public $time_list = [];

    public function setOrder(?Order $order)
    {
        $this->order = $order;
        $this->product = Product::find($order->data['product']['id']);
        $availability_time = AvailabilityTime::find($order->data['booking']['time_id']);
        $this->time = $availability_time->id;
        $this->date = Carbon::parse($availability_time->date)->startOfDay()->format('Y-m-d');
        $this->adults = $order->data['booking']['participants']['adults'] ?? 0;
        $this->kids = $order->data['booking']['participants']['kids'] ?? 0;
        $this->children = $order->data['booking']['participants']['children'] ?? 0;

        $this->calculateTimeList($this->date);
        $this->updatedTime();
    }

    public function calculateTimeList($date)
    {
        $date = rescue(fn () => Carbon::createFromFormat('Y-m-d', $date)->format('Y/m/d'), $date);
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
                // ->whereColumn('max', '!=', 'sold')
                $times = $availability_date->times()->whereDate('date', $date)->get();
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

    public function checkAvailability()
    {
        $availability = AvailabilityTime::find($this->time);
        $slots = $availability->realAvailability;

        // Verifica se la data e l'orario selezionati sono passati rispetto alla data e all'orario attuali
        if (Carbon::parse($availability->date . ' ' . $availability->time) <= now()) {
            $this->component->addError('date_past', 'Spiacenti, la data o l\'ora selezionati risultano passati. Ti invitiamo a provare un\'altra combinazione.');
            $this->calculateTimeList($this->date);
            return;
        }

        // Numero di partecipanti attualmente prenotati per l'ordine
        $currentParticipants = $this->order->data['booking']['participants']['total'];

        // Numero di partecipanti aggiornato
        $newParticipants = $this->participants();

        // Differenza tra i partecipanti attuali e i nuovi partecipanti
        $participantDifference = $newParticipants - $currentParticipants;

        // Controlla che il numero totale di partecipanti non superi il massimo consentito
        if ($newParticipants > $availability->max) {
            $this->component->addError('slots', 'Purtroppo il numero totale di partecipanti supera la capienza massima consentita.');
            return;
        }

        // Controlla che ci siano abbastanza slot disponibili per i nuovi partecipanti
        if ($participantDifference > 0 && $slots < $participantDifference) {
            $this->component->addError('slots', 'Purtroppo non ci sono abbastanza posti disponibili per questa data/ora. Ti invitiamo a provare un\'altra combinazione.');
            return;
        }

        // Esegui il dispatch per aggiornare l'ordine
        if ($this->product->isRental()) {
            if ($this->participants() > $availability->availability_date->participants_per_vehicle) {
                $this->component->addError('slots', 'Purtroppo il numero di partecipanti supera la capienza massima del mezzo.');
            } else {
                $this->component->dispatch('update-order', $this->order, $availability->id, $this->adults, $this->kids, $this->children);
            }
        } else {
            $this->component->dispatch('update-order', $this->order, $availability->id, $this->adults, $this->kids, $this->children);
        }
    }

//    #[Computed]
//    public function canUpdate() {
//        if($this->participants() !== $this->order->data['booking']['participants']['total'] ||
//            $this->time !== $this->order->data['booking']['time_id'] ||
//            $this->availability_date !== $this->order->data['booking']['date']
//        ) {
//            dump($this->availability_date);
//            return true;
//        }
//    }

    #[Computed]
    public function participants()
    {
        return $this->adults + $this->kids + $this->children;
    }
}
