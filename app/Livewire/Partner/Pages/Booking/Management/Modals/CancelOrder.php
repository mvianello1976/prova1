<?php

namespace App\Livewire\Partner\Pages\Booking\Management\Modals;

use App\Livewire\Partner\Pages\Booking\Management\Show;
use App\Models\Order;
use Livewire\Attributes\Validate;
use LivewireUI\Modal\ModalComponent;

class CancelOrder extends ModalComponent
{
    public Order $order;

    #[Validate('required')]
    public $reason = '';

    public function confirm()
    {
        $this->validate();

        // TODO: Invio email di cancellazione dell'esperienza a tutti quelli che l'hanno acquistata
        // TODO: Invio email al B2B per ricordare il rimborso (se necessario)?

        // Modifica status ordine in "canceled"
        $this->order->update([
            'canceled_at' => now(),
            'canceled_reason' => $this->reason,
            'status' => 'canceled',
        ]);

        $this->closeModal();
        $this->dispatch('order-canceled')->to(Show::class);
    }

    public function render()
    {
        return view('livewire.partner.pages.booking.management.modals.cancel-order');
    }
}
