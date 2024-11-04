<?php

namespace App\Livewire\Partner\Pages\Onboarding;

use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;

#[Layout('layouts.blank')]
class Step3 extends Component
{
    public $resendEmail = false;

    public function mount() {
        if(auth()->user()->onboarding_current_step !== 3) {
            return redirect()->route("partners.onboarding.step-" . auth()->user()->onboarding_current_step);
        }
        if(auth()->user()->onboarding_current_step === 3 && auth()->user()->hasVerifiedEmail()) {
            return redirect()->route('dashboard');
        }
    }

    #[On('sent')]
    public function resendEmail() {
        auth()->user()->sendEmailVerificationNotification();
        $this->resendEmail = true;
    }

    public function render()
    {
        return view('livewire.partner.pages.onboarding.step3');
    }
}
