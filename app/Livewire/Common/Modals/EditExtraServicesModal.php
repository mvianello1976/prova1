<?php

namespace App\Livewire\Common\Modals;

use App\Livewire\Guest\Pages\Cart;
use App\Livewire\Guest\Pages\Product\Show;
use App\Models\CartItem;
use App\Models\Product;
use LivewireUI\Modal\ModalComponent;

class EditExtraServicesModal extends ModalComponent
{
    public Product $product;
    public CartItem $cartItem;
    public $services = [];

    public static function modalMaxWidth(): string
    {
        return '2xl';
    }

    public static function closeModalOnEscape(): bool
    {
        return false;
    }

    public static function closeModalOnClickAway(): bool
    {
        return false;
    }

    public function mount() {
        $this->services = json_decode($this->cartItem->services);
    }

    public function addService($id) {
        $this->services[] = $id;
    }

    public function removeService($id) {
        $k = array_search($id, $this->services);
        if($k !== false) {
            unset($this->services[$k]);
        }
    }

    public function confirm() {
        $this->cartItem->update([
            'services' => json_encode($this->services)
        ]);
        $this->dispatch('extra-services-edited')->to(Cart::class);
        $this->closeModal();
    }

    public function render()
    {
        return view('livewire.common.modals.edit-extra-services-modal');
    }
}
