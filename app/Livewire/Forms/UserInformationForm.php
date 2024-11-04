<?php

namespace App\Livewire\Forms;

use App\Models\UserInformation;
use Livewire\Attributes\Validate;
use Livewire\Form;

class UserInformationForm extends Form
{
    public ?UserInformation $informations;

    // Step 1
    #[Validate]
    public $partner_type = null;
    #[Validate]
    public $company_employees = null;
    #[Validate]
    public $activities_provided = null;
    #[Validate]
    public $activities_locations = [];
    #[Validate]
    public $activities_use_external_cms = false;
    #[Validate]
    public $activities_external_cms = null;

    // Step 2
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
    public $terms = false;

    public function setUserInformation(UserInformation|null $informations)
    {
        if ($informations) {
            $this->informations = $informations;

            // Step 1
            $this->partner_type = $informations->partner_type;
            $this->company_employees = $informations->company_employees;
            $this->activities_provided = $informations->activities_provided;
            $this->activities_locations = $informations->activities_locations;
            $this->activities_use_external_cms = $informations->activities_use_external_cms;
            $this->activities_external_cms = $informations->activities_external_cms;

            // Step 2
            $this->company_name = $informations->company_name;
            $this->business_name = $informations->business_name;
            $this->vat_number = $informations->vat_number;
            $this->head_office_address = $informations->head_office_address;
            $this->pec = $informations->pec;
            $this->sdi = $informations->sdi;
            $this->company_link = $informations->company_link;
            $this->country_id = $informations->country_id;
            $this->currency = $informations->currency;
            $this->contact_first_name = $informations->contact_first_name;
            $this->contact_last_name = $informations->contact_last_name;
            $this->terms = $informations->terms;
        } else {
            $this->informations = new UserInformation();
        }
    }

    protected function rules()
    {
        return match (auth()->user()->onboarding_current_step) {
            1 => [
                'partner_type' => ['required'],
                'company_employees' => $this->partner_type === 'company' ? ['required'] : ['nullable'],
                'activities_provided' => ['required'],
                'activities_locations' => ['required'],
                'activities_use_external_cms' => ['required'],
                'activities_external_cms' => $this->activities_use_external_cms ? ['required'] : ['nullable'],
            ],
            2 => [
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
                'terms' => ['accepted'],
            ]
        };
    }

    public function submit()
    {
        $validated = $this->validate();
        $this->informations->updateOrCreate([
            'user_id' => auth()->id()
        ], $validated);
    }
}
