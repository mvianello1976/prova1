<?php

namespace App\Livewire\Guest\Pages\Profile\Modals;

use App\Livewire\Guest\Pages\Profile\Tabs\Bookings;
use App\Models\Order;
use Livewire\Attributes\Validate;
use LivewireUI\Modal\ModalComponent;

class RedeemGift extends ModalComponent
{
    #[Validate('required')]
    public $code = null;

    public function confirm()
    {
        $this->validate();
        $order = Order::where('redeem_code', $this->code)->first();
        if (!$order) {
            dd('Il codice non è valido o l\'ordine è inesistente, riprovare.');
        }

        if ($order->gift_from === auth()->id()) {
            dd('Non puoi riscattare un tuo regalo');
        }

        $new_order = $order->replicate();

        // Modifico dati vecchio ordine
        $order->update([
            'redeemed' => true,
            'redeemed_at' => now()
        ]);

        // Salvo il nuovo ordine
        $new_order->save();

        // Modifico dati nuovo ordine
        $new_order->update([
            'cart_id' => null,
            'user_id' => auth()->id(),
            'redeem_code' => null,
            'approval_deadline' => now()->addHours(env('APPROVAL_DEADLINE_HOURS', 24))
        ]);

        // Modifico order_id dei ticket
        $order->tickets()->update([
            'order_id' => $new_order->id
        ]);

        // Cancello il vecchio ordine
        $order->delete();

        $this->dispatch('gift-redeemed');
        $this->dispatch('set-tab-to-scheduled')->to(Bookings::class);
        $this->closeModal();
    }

    public function render()
    {
        return view('livewire.guest.pages.profile.modals.redeem-gift');
    }
}
