<?php

namespace App\Livewire\Partner\Pages\Booking;

use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class History extends Component
{
    public function render()
    {
        return view('livewire.partner.pages.booking.history');
    }
}
