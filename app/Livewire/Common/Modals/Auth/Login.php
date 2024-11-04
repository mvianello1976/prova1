<?php

namespace App\Livewire\Common\Modals\Auth;

use App\Livewire\Forms\UserForm;
use LivewireUI\Modal\ModalComponent;

class Login extends ModalComponent
{
    public UserForm $form;
    public $tabs = [
        'client' => 'Accedi come client',
        'partner' => 'Accedi come partner',
    ];
    public $currentTab = 'client';

    public static function modalMaxWidth(): string
    {
        return 'lg';
    }

    public function submit()
    {
        if ($this->form->login()) {
            $this->closeModal();
            if (in_array(auth()->user()->role->name, [
                'administrator',
                'partner'
            ])) {
                return redirect()->route('dashboard');
            } else {
                $this->dispatch('user-logged-in');
            }
        } else {
            $this->addError('invalid_credentials', __('Credenziali non valide'));
        }
    }

    public function render()
    {
        return view('livewire.common.modals.auth.login');
    }
}
