<?php

namespace App\Livewire\Partner\Pages\Profile\Modals;

use Livewire\Attributes\On;
use Livewire\Component;

class EditProfileData extends Component
{
    public $partner_type = null;

    public $company_name = '';

    public $business_name = '';

    public $vat_number = '';

    public $head_office_address = '';

    public $pec = '';

    public $sdi = '';

    public $company_link = '';

    public $country_id = null;

    public $currency = '';

    public $contact_first_name = '';

    public $contact_last_name = '';

    public function mount()
    {
        $informations = auth()->user()->informations;
        $this->partner_type = $informations->partner_type;
        $this->company_name = $informations->company_name;
        $this->business_name = $informations->business_name;
        $this->vat_number = $informations->vat_number;
        $this->head_office_address = $informations->head_office_address;
        $this->pec = $informations->pec;
        $this->sdi = $informations->sdi;
        $this->country_id = $informations->country_id;
        $this->currency = $informations->currency;
        $this->contact_first_name = $informations->contact_first_name;
        $this->contact_last_name = $informations->contact_last_name;
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
        return view('livewire.partner.pages.profile.modals.edit-profile-data');
    }

    protected function rules()
    {
        return [
            'partner_type' => ['required'],
            'company_name' => ['required'],
            'business_name' => ['required'],
            'vat_number' => ['required'],
            'head_office_address' => ['required'],
            'pec' => ['required'],
            'sdi' => ['nullable'],
            'company_link' => ['nullable'],
            'country_id' => ['required'],
            'currency' => ['required'],
            'contact_first_name' => ['nullable'],
            'contact_last_name' => ['nullable'],
        ];
    }
}
