<?php

namespace App\Livewire\Partner\Pages\Booking\Modals;

use App\Livewire\Partner\Pages\Booking\Scanner;
use App\Models\Ticket;
use Livewire\Attributes\Validate;
use LivewireUI\Modal\ModalComponent;

class InsertCodeManually extends ModalComponent
{
    #[Validate('required')]
    public $code = null;

    public function confirm()
    {
        $this->validate();
        $ticket = Ticket::where('uuid', $this->code)->first();
        if (! $ticket) {
            dd('Il codice del Ticket non è valido o inesistente, riprovare.');
        }

        $this->dispatch('confirm', $ticket->encrypted)->to(Scanner::class);
        $this->closeModal();
    }

    public function render()
    {
        return view('livewire.partner.pages.booking.modals.insert-code-manually');
    }
}
