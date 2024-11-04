<?php

namespace App\Livewire\Partner\Pages\Profile;

use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;

#[Layout('layouts.app')]
class Show extends Component
{
    public $currentTab = 'profile';

    #[On('partner-data-updated')]
    public function render()
    {
        return view('livewire.partner.pages.profile.show');
    }
}
