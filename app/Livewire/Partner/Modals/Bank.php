<?php

namespace App\Livewire\Partner\Modals;

use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Validate;
use LivewireUI\Modal\ModalComponent;

class Bank extends ModalComponent
{
    #[Validate('required')]
    public $bank_name = '';
    #[Validate('required')]
    public $bank_account_holder = '';
    #[Validate('required')]
    public $bank_iban = '';
    #[Validate('required')]
    public $bank_bic = '';

    public function mount()
    {
        $this->bank_name = auth()->user()->informations->bank_name;
        $this->bank_account_holder = auth()->user()->informations->bank_account_holder;
        $this->bank_iban = auth()->user()->informations->bank_iban;
        $this->bank_bic = auth()->user()->informations->bank_bic;
    }

    public function submit()
    {
        $this->validate();
        auth()->user()->informations()->update([
            'bank_name' => $this->bank_name,
            'bank_account_holder' => $this->bank_account_holder,
            'bank_iban' => $this->bank_iban,
            'bank_bic' => $this->bank_bic,
        ]);

        $this->closeModal();
        $this->dispatch('partner-missing-data-updated');
    }

    public function render()
    {
        return view('livewire.partner.modals.bank');
    }
}
