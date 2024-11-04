<?php

namespace App\Livewire\Partner\Pages\Availability\Modals;

use App\Mail\AvailabilityDateDeleted;
use App\Models\AvailabilityDate;
use App\Models\CartItem;
use App\Models\Order;
use Illuminate\Support\Facades\Mail;
use LivewireUI\Modal\ModalComponent;

class DeleteAvailability extends ModalComponent
{
    public AvailabilityDate $availability_date;

    public $sold;

    public function mount()
    {
        // Controllo se ci sono orari acquistati
        $this->sold = $this->availability_date->times()->whereDate('date', '>=', now())->where('sold', '>', 0)->get();
        // Se ci sono orari acquistati ritorno un avviso
        if ($this->sold->count()) {
            $this->addError('sold',
                trans_choice('{1} C\'è :count biglietto venduto|[2,*] Ci sono :count biglietti venduti',
                    $this->sold->count()));
        }
    }

    public function submit()
    {
        $orders = Order::query();
        $cart_items = CartItem::whereIn('availability_time_id', $this->availability_date->times()->pluck('id'))->get();
        $users = [];
        foreach ($this->sold as $time) {
            $orders->orWhereJsonContains('data->booking', ['time_id' => $time->id]);
        }
        foreach ($orders->get() as $order) {
            $users[] = $order->user->email;
        }

        foreach ($cart_items as $cart_item) {
            $cart = $cart_item->cart;
            $cart_item->delete();
            if ($cart->items->count() === 0) {
                $cart->delete();
            }
        }

        if (count($users) > 0) {
            Mail::to(auth()->user())->send(new AvailabilityDateDeleted($this->availability_date, $users));
        }

        $availability = $this->availability_date->availability;
        $this->availability_date->times()->delete();
        $this->availability_date->delete();

        return redirect()->route('availabilities.show', $availability->id);
    }

    public function render()
    {
        return view('livewire.partner.pages.availability.modals.delete-availability');
    }
}
