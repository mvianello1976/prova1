<?php

namespace App\Livewire\Guest\Pages\Profile\Tabs;

use Livewire\Attributes\On;
use Livewire\Component;

class Bookings extends Component
{
    public $currentTab = 'scheduled';

    #[On('set-tab-to-scheduled')]
    public function setTabToScheduled()
    {
        $this->currentTab = 'scheduled';
    }

    #[On('review-writed')]
    #[On('gift-redeemed')]
    public function render()
    {
        $orders = auth()->user()->orders();

        if ($this->currentTab == 'scheduled') {
            $orders = $orders->where('data->booking->date', '>=', now()->toDateString())
                ->where(function ($q) {
                    $q->where('is_gift', false)
                        ->orWhere(function ($subQuery) {
                            $subQuery->where('is_gift', true)
                                ->where('gift_from', '!=', auth()->id());
                        });
                });
        } elseif ($this->currentTab == 'past') {
            $orders = $orders->where('data->booking->date', '<', now()->toDateString());
        } elseif ($this->currentTab == 'gift') {
            $orders = $orders->where('is_gift', true)
                ->where('gift_from', auth()->id())
                ->withTrashed();
        }

        return view('livewire.guest.pages.profile.tabs.bookings', [
            'orders' => $orders->get(),
        ]);
    }
}
