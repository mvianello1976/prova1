<?php

namespace App\Livewire\Components\Checkout;

use App\Models\CartItem;
use Livewire\Attributes\On;
use Livewire\Component;

class OrderSummaryItem extends Component
{
    public CartItem $item;

    public $editCoupon = true;

    public function removeCoupon()
    {
        $this->item->update([
            'coupon' => null,
        ]);

        $this->dispatch('coupon-removed');
    }

    #[On('coupon-removed')]
    #[On('coupon-applied')]
    public function render()
    {
        return view('livewire.components.checkout.order-summary-item');
    }
}
