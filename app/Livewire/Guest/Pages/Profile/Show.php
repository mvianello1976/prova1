<?php

namespace App\Livewire\Guest\Pages\Profile;

use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;

#[Layout('layouts.guest')]
class Show extends Component
{
    public $currentTab = 'profile';

    #[On('client-data-updated')]
    #[On('gift-redeemed')]
    public function render()
    {
        return view('livewire.guest.pages.profile.show');
    }
}
