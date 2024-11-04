<?php

namespace App\Livewire\Common\Modals\Auth;

use App\Livewire\Forms\UserForm;
use LivewireUI\Modal\ModalComponent;

class Register extends ModalComponent
{
    public UserForm $form;
    public $tabs = [
        'client' => 'Registrati come client',
        'partner' => 'Registrati come partner',
    ];
    public $currentTab = 'client';

    public static function modalMaxWidth(): string
    {
        return 'xl';
    }

    public function submit() {
        if($this->form->register($this->currentTab)){
            $this->closeModal();
            if(in_array(auth()->user()->role->name, ['administrator', 'partner'])) {
                return redirect()->route('partners.onboarding.step-1');
            } else {
                $this->dispatch('user-logged-in');
            }
        }
    }

    public function render()
    {
        return view('livewire.common.modals.auth.register');
    }
}
