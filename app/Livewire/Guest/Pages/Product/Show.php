<?php

namespace App\Livewire\Guest\Pages\Product;

use App\Models\AvailabilityDate;
use App\Models\AvailabilityTime;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Destination;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;

#[Layout('layouts.guest')]
class Show extends Component
{
    public Destination $destination;

    public Product $product;

    public $currentTab = 'book';

    public $availability_date = null;

    public $date = null;

    public $time = null;

    public $adults = 0;

    public $kids = 0;

    public $children = 0;

    public $time_list = [];

    public function mount()
    {
        $this->date = session()->get('date') ?? Carbon::today()->format('Y/m/d');
        $this->adults = session()->get('adults') ?? 0;
        $this->kids = session()->get('kids') ?? 0;
        $this->children = session()->get('children') ?? 0;

        $this->calculateTimeList($this->date);
    }

    public function calculateTimeList($date)
    {
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

    #[Computed]
    public function is_gift()
    {
        return $this->currentTab === 'gift';
    }

    #[Computed]
    public function participants()
    {
        return $this->adults + $this->kids + $this->children;
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

    public function updatedTime()
    {
        $time = AvailabilityTime::find($this->time);
        $this->availability_date = $time->availability_date;
    }

    public function updatedDate($newDate)
    {
        $this->time = null;
        if ($newDate !== null) {
            $this->date = Carbon::createFromFormat('d/m/Y', $newDate)->format('Y/m/d');
            $this->calculateTimeList($this->date);
        }
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

        // Verifico se la data e l'orario selezionati sono passati rispetto alla data e all'orario attuali
        if (Carbon::parse($availability->date.' '.$availability->time) <= now()) {
            $this->addError('date_past', 'Spiacenti, la data o l\'ora selezionati risultano passati. Ti invitiamo a provare un\'altra combinazione.');

            $this->calculateTimeList($this->date);

            return;
        }

        if ($this->product->isRental()) {
            if ($this->participants > $availability->availability_date->participants_per_vehicle) {
                $this->addError('slots', 'Purtroppo il numero di partecipanti supera la capienza massima del mezzo.');
            } elseif ($slots <= 0) {
                $this->addError('slots', 'Purtroppo non ci sono abbastanza posti disponibili per questa data/ora. Ti invitiamo a provare un\'altra combinazione.');
            } else {
                if ($this->product->extra_services->count()) {
                    $this->dispatch('openModal', 'common.modals.add-extra-services-modal', [
                        'product' => $this->product,
                        'is_gift' => $this->is_gift()
                    ]);
                } else {
                    $this->dispatch('add-to-cart', [], $this->is_gift());
                }
            }
        } else {
            if ($slots < $this->participants) {
                $this->addError('slots', 'Purtroppo non ci sono abbastanza posti disponibili per questa data/ora. Ti invitiamo a provare un\'altra combinazione.');
            } else {
                if ($this->product->extra_services->count()) {
                    $this->dispatch('openModal', 'common.modals.add-extra-services-modal', [
                        'product' => $this->product,
                        'is_gift' => $this->is_gift()
                    ]);
                } else {
                    $this->dispatch('add-to-cart', [], $this->is_gift());
                }
            }
        }
    }

    #[On('add-to-cart')]
    public function addToCart($services, $is_gift)
    {
        if (auth()->check()) {
            $cart = auth()->user()->cart ?? auth()->user()->cart()->create();
        } else {
            if (!session()->get('guest_id')) {
                session()->put('guest_id', Str::random(10));
            }
            $cart = Cart::firstOrCreate([
                'user_id' => session('guest_id'),
            ]);
        }

        $cart_item = CartItem::updateOrCreate([
            'cart_id' => $cart->id,
            'product_id' => $this->product->id,
            'availability_time_id' => $this->time,
            'adults' => session()->get('adults') ?? 0,
            'kids' => session()->get('kids') ?? 0,
            'children' => session()->get('children') ?? 0,
            'services' => json_encode($services),
            'gift' => $is_gift
        ]);

        // Prenoto i posti per l'orario scelto
        if ($this->product->isRental()) {
            AvailabilityTime::where('id', $this->time)->increment('booked');
        } else {
            AvailabilityTime::where('id', $this->time)->increment('booked', $this->participants);
        }

        session()->flash('added-to-cart', $cart_item);
        $this->dispatch('added-to-cart');
    }

    public function increment($what)
    {
        $this->$what++;
        session()->put($what, $this->$what);
    }

    public function toggleFavorite()
    {
        $user = auth()->user();

        if ($user->favorites()->where('product_id', $this->product->id)->exists()) {
            $user->favorites()->detach($this->product->id);
        } else {
            $user->favorites()->attach($this->product->id);
        }

        $this->dispatch('favorite-toggled');
    }

    public function render()
    {
        return view('livewire.guest.pages.product.show', [
            'isFavorited' => auth()->user() && auth()->user()->favorites->contains($this->product->id),
        ]);
    }
}
