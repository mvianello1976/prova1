<?php

namespace App\Livewire\Partner\Pages\Onboarding;

use App\Livewire\Forms\UserInformationForm;
use App\Models\Country;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.blank')]
class Step2 extends Component
{
    public UserInformationForm $form;

    public function mount() {
        if(auth()->user()->onboarding_current_step !== 2) {
            return redirect()->route("partners.onboarding.step-" . auth()->user()->onboarding_current_step);
        }

        $this->form->setUserInformation(auth()->user()->informations);
    }

    public function prev() {
        auth()->user()->decrement('onboarding_current_step');
        return redirect()->route('partners.onboarding.step-' . auth()->user()->onboarding_current_step);
    }

    public function next()
    {
        $this->form->submit();

        auth()->user()->sendEmailVerificationNotification();

        auth()->user()->increment('onboarding_current_step');
        return redirect()->route('partners.onboarding.step-' . auth()->user()->onboarding_current_step);
    }

    public function render()
    {
        return view('livewire.partner.pages.onboarding.step2', [
            'countries' => Country::all()
        ]);
    }
}
