<?php

namespace App\Livewire\Guest\Pages;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\GiftCard;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;

#[Layout('layouts.guest')]
class GiftCards extends Component
{
    #[On('add-to-cart')]
    public function addToCart(GiftCard $gift_card)
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
            'gift_card_id' => $gift_card->id,
            'gift' => true
        ]);

        session()->flash('added-to-cart', $cart_item);
        $this->dispatch('added-to-cart');
    }

    public function render()
    {
        return view('livewire.guest.pages.gift-cards', [
            'gift_cards' => GiftCard::all(),
        ]);
    }
}
