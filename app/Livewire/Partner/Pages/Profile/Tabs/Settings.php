<?php

namespace App\Livewire\Partner\Pages\Profile\Tabs;

use Livewire\Attributes\On;
use Livewire\Component;

class Settings extends Component
{
    public $customer_questions_notifications = null;

    public $bookings_notifications = null;

    public $accountings_notifications = null;

    public $reviews_notifications = null;

    #[On('partner-data-updated')]
    public function mount()
    {
        $informations = auth()->user()->informations;
        $this->customer_questions_notifications = $informations->customer_questions_notifications;
        $this->bookings_notifications = $informations->bookings_notifications;
        $this->accountings_notifications = $informations->accountings_notifications;
        $this->reviews_notifications = $informations->reviews_notifications;
    }

    public function updateNotification($notification)
    {
        auth()->user()->informations()->update([
            $notification => ! $this->{$notification},
        ]);
        $this->dispatch('partner-data-updated');
    }

    public function render()
    {
        return view('livewire.partner.pages.profile.tabs.settings');
    }
}
