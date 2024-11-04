<?php

namespace App\Livewire\Common;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Destination;
use Livewire\Attributes\On;
use Livewire\Component;

class Header extends Component
{
    #[On('added-to-cart')]
    #[On('user-logged-in')]
    public function refreshCart()
    {
        $this->dispatch('$refresh');
    }

    #[On('added-to-cart')]
    #[On('removed-from-cart')]
    #[On('client-data-updated')]
    public function render()
    {
        $cart = auth()->user()->cart ?? Cart::where('user_id', session('guest_id'))->first();

        return view('livewire.common.header', [
            'destinations' => Destination::all(),
            'categories' => Category::all(),
            'cart_items' => $cart?->items->count() ?? 0,
        ]);
    }
}
