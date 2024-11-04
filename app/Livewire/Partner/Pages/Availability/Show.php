<?php

namespace App\Livewire\Partner\Pages\Availability;

use App\Models\Availability;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;

#[Layout('layouts.app')]
class Show extends Component
{
    public Availability $availability;

    #[On('availability_added')]
    #[On('availability_updated')]
    #[On('availability_deleted')]
    public function render()
    {
        return view('livewire.partner.pages.availability.show', [
            'dates' => $this->availability->dates()
                ->orderBy('date_start')
                ->orderBy('date_end')
                ->orderBy('time_start')
                ->orderBy('time_end')
                ->get(),
        ]);
    }
}
