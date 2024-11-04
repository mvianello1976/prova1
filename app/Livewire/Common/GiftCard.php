<?php

namespace App\Livewire\Common;

use App\Livewire\Guest\Pages\GiftCards;
use Livewire\Component;

class GiftCard extends Component
{
    public \App\Models\GiftCard $gift_card;

    public function addToCart()
    {
        $this->dispatch('add-to-cart', $this->gift_card->id)->to(GiftCards::class);
    }

    public function render()
    {
        return view('livewire.common.gift-card');
    }
}
