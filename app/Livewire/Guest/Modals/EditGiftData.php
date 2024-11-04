<?php

namespace App\Livewire\Guest\Modals;

use App\Livewire\Forms\CartItemForm;
use App\Models\CartItem;
use Livewire\Attributes\On;
use LivewireUI\Modal\ModalComponent;

class EditGiftData extends ModalComponent
{
    public CartItemForm $form;

    public static function modalMaxWidth(): string
    {
        return 'xl';
    }

    public function mount(CartItem $cart_item)
    {
        $this->form->setCartItem($cart_item);
    }

    public function save()
    {
        $this->form->updateGiftData();
    }

    #[On('cart-item-updated')]
    public function cartItemUpdated()
    {
        $this->closeModal();
    }

    public function render()
    {
        return view('livewire.guest.modals.edit-gift-data');
    }
}
