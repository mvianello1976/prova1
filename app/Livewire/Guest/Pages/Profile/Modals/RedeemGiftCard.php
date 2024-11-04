<?php

namespace App\Livewire\Guest\Pages\Profile\Modals;

use App\Models\GiftCardUser;
use Livewire\Attributes\Validate;
use LivewireUI\Modal\ModalComponent;

class RedeemGiftCard extends ModalComponent
{
    #[Validate('required')]
    public $code = null;

    public function confirm()
    {
        $this->validate();
        $gift_card = GiftCardUser::where('redeem_code', $this->code)->first();
        if (!$gift_card) {
            dd('Il codice non è valido, riprovare.');
        }
        if ($gift_card->redeemed) {
            dd('Gift Card già riscossa');
        }

        $gift_card->update([
            'user_id' => auth()->id(),
            'redeemed' => true,
            'redeemed_at' => now()
        ]);

        auth()->user()->addBalance($gift_card->card->value);

        $this->dispatch('gift-card-redeemed');
        $this->closeModal();
    }

    public function render()
    {
        return view('livewire.guest.pages.profile.modals.redeem-gift-card');
    }
}
