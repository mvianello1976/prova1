<?php

namespace App\Livewire\Partner\Pages\Onboarding;

use App\Livewire\Forms\UserInformationForm;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.blank')]
class Step1 extends Component
{
    public UserInformationForm $form;

    public $company_employees_list = [];
    public $activities_provided_list = [];
    public $activities_external_cms_list = [];

    public function mount()
    {
        if (auth()->user()->onboarding_current_step !== 1) {
            return redirect()->route("partners.onboarding.step-".auth()->user()->onboarding_current_step);
        }

        $this->form->setUserInformation(auth()->user()->informations);

        $this->company_employees_list = config('tripsytour.partner.onboarding.company_employees');
        $this->activities_provided_list = config('tripsytour.partner.onboarding.activities_provided');
        $this->activities_external_cms_list = config('tripsytour.partner.onboarding.activities_external_cms');
    }

    public function updatedFormPartnerType($oldVal, $newVal) {
        $this->form->company_employees = null;
        $this->resetErrorBag();
    }

    public function updatedFormActivitiesUseExternalCms() {
        $this->form->activities_external_cms = null;
        $this->resetErrorBag();
    }

    public function next()
    {
        $this->form->submit();

        auth()->user()->increment('onboarding_current_step');
        return redirect()->route('partners.onboarding.step-' . auth()->user()->onboarding_current_step);
    }

    public function render()
    {
        return view('livewire.partner.pages.onboarding.step1');
    }
}
