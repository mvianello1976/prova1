<?php

namespace App\Livewire\Guest\Pages\Profile\Tabs;

use Livewire\Attributes\On;
use Livewire\Component;

class GiftCards extends Component
{
    #[On('gift-card-redeemed')]
    public function render()
    {
        $gift_cards = auth()->user()->received_gift_cards();

        return view('livewire.guest.pages.profile.tabs.gift-cards', [
            'gift_cards' => $gift_cards->latest('redeemed_at')->get(),
        ]);
    }
}
