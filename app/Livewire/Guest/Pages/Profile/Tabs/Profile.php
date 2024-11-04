<?php

namespace App\Livewire\Guest\Pages\Profile\Tabs;

use App\Livewire\Forms\ClientForm;
use App\Models\Country;
use Livewire\Attributes\On;
use Livewire\Component;

class Profile extends Component
{
    public ClientForm $form;

    #[On('partner-data-updated')]
    public function mount()
    {
        $this->form->setUser(auth()->user());
    }

    public function update()
    {
        $this->form->update('profile');
    }

    public function render()
    {
        return view('livewire.guest.pages.profile.tabs.profile', [
            'countries' => Country::all(),
        ]);
    }
}
