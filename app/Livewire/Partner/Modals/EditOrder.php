<?php

namespace App\Livewire\Partner\Modals;

use App\Livewire\Forms\OrderForm;
use App\Models\Order;
use Livewire\Attributes\On;
use LivewireUI\Modal\ModalComponent;

class EditOrder extends ModalComponent
{
    public OrderForm $form;

    public static function modalMaxWidth(): string
    {
        return 'md';
    }

    public function mount(Order $order)
    {
        $this->form->setOrder($order);
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

    #[On('order-updated')]
    public function orderUpdated()
    {
        $this->closeModal();
    }

    public function render()
    {
        return view('livewire.partner.modals.edit-order');
    }
}
