<?php

namespace App\Livewire\Partner\Pages\Profile\Modals;

use App\Models\Country;
use Livewire\Attributes\On;
use Livewire\Component;

class EditPaymentsData extends Component
{
    public $bank_name = null;

    public $bank_account_holder = null;

    public $bank_iban = null;

    public $bank_bic = null;

    public $country_id = null;

    public $currency = null;

    public $vat_number = null;

    public function mount()
    {
        $informations = auth()->user()->informations;
        $this->bank_name = $informations->bank_name;
        $this->bank_account_holder = $informations->bank_account_holder;
        $this->bank_iban = $informations->bank_iban;
        $this->bank_bic = $informations->bank_bic;
        $this->country_id = $informations->country_id;
        $this->currency = $informations->currency;
        $this->vat_number = $informations->vat_number;
    }

    #[On('submit-profile-data')]
    public function submit()
    {
        $validated = $this->validate();

        auth()->user()->informations()->update($validated);
        $this->dispatch('partner-data-updated');
        $this->dispatch('close-slide-over');
    }

    public function render()
    {
        return view('livewire.partner.pages.profile.modals.edit-payments-data', [
            'countries' => Country::all(),
        ]);
    }

    protected function rules()
    {
        return [
            'bank_name' => ['required'],
            'bank_account_holder' => ['required'],
            'bank_iban' => ['required'],
            'bank_bic' => ['required'],
            'country_id' => ['required', 'exists:countries,id'],
            'currency' => ['required'],
            'vat_number' => ['required'],
        ];
    }
}
