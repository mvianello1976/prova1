<?php

namespace App\Livewire\Partner\Pages\Profile\Tabs;

use App\Models\UserInformation;
use Livewire\Attributes\On;
use Livewire\Component;

class Profile extends Component
{
    public UserInformation $informations;

    #[On('partner-data-updated')]
    public function mount()
    {
        $this->informations = auth()->user()->informations;
    }

    public function render()
    {
        return view('livewire.partner.pages.profile.tabs.profile');
    }
}
