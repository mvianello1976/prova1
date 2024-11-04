<?php

namespace App\Livewire\Guest\Modals;

use App\Livewire\Forms\CartItemForm;
use App\Models\CartItem;
use Livewire\Attributes\On;
use LivewireUI\Modal\ModalComponent;

class EditCartItem extends ModalComponent
{
    public CartItemForm $form;

    public static function modalMaxWidth(): string
    {
        return 'md';
    }

    public function mount(CartItem $cart_item)
    {
        $this->form->setCartItem($cart_item);
    }

    public function increment($what)
    {
        $this->form->increment($what);
    }

    public function decrement($what)
    {
        $this->form->decrement($what);
    }

    public function updatedFormTime()
    {
        $this->form->updatedTime();
    }

    public function updatedFormDate($newDate)
    {
        $this->form->updatedDate($newDate);
    }

    public function checkAvailability()
    {
        $this->form->checkAvailability();
    }

    #[On('cart-item-updated')]
    public function cartItemUpdated()
    {
        $this->closeModal();
    }

    public function render()
    {
        return view('livewire.guest.modals.edit-cart-item');
    }
}
