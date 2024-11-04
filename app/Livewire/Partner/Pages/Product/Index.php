<?php

namespace App\Livewire\Partner\Pages\Product;

use App\Models\AvailabilityTime;
use App\Models\CartItem;
use App\Models\Order;
use App\Models\Product;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class Index extends Component
{
    public function delete(Product $product)
    {
        // Controllo se ci sono biglietti acquistati per questa attività (futuri sia per data che per orario)
        $orders = Order::where('data->product->id', $product->id)->where(function ($query) {
            $query->where('data->booking->date', '>', now()->format('Y-m-d'))
                ->orWhere(function ($query) {
                    $query->where('data->booking->date', now()->format('Y-m-d'))
                        ->where('data->booking->time', '>', now()->format('H:i:s'));
                });
        })->get();

        // Se ci sono risultati
        $users = [];
        foreach ($orders as $order) {
            // Mando una mail informativa a chi ha acquistato l'attività
            // TODO: Invio email di cancellazione
            $users[] = $order->user->email;
        }

        // Controllo se ci sono carrelli contenenti l'attività eliminata
        $cart_items = CartItem::where('product_id', $product->id)->get();
        if ($cart_items) {
            foreach ($cart_items as $cart_item) {
                $availability_time = AvailabilityTime::find($cart_item->availability_time_id);
                if ($cart_item->product->isRental()) {
                    $availability_time->decrement('booked');
                } else {
                    $availability_time->decrement('booked', $cart_item->participants);
                }

                $cart_item->delete();

                if ($cart_item->cart->items->count() === 0) {
                    $cart_item->cart->delete();
                }
            }
        }

        if ($users) {
            dd('Avvisare i seguenti clienti:', $users);
        }

        // Cancello l'attività
        $product->delete();
    }

    public function restore($id)
    {
        $product = Product::withTrashed()->find($id);
        $product->restore();
    }

    public function render()
    {
        return view('livewire.partner.pages.product.index', [
            'published' => auth()->user()->products()->published()->withTrashed()->latest()->get(),
        ]);
    }
}
