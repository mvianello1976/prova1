<?php

namespace App\Livewire\Guest\Pages\Profile\Tabs;

use App\Livewire\Forms\ClientForm;
use Livewire\Attributes\On;
use Livewire\Component;

class Security extends Component
{
    public ClientForm $form;

    #[On('partner-data-updated')]
    public function mount()
    {
        $this->form->setUser(auth()->user());
    }

    public function update()
    {
        $this->form->update('security');
    }

    public function delete()
    {
        $this->form->delete();
    }

    public function render()
    {
        return view('livewire.guest.pages.profile.tabs.security');
    }
}
