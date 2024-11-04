<?php

namespace App\Livewire\Common\Modals;

use App\Livewire\Common\Header;
use App\Livewire\Guest\Pages\Product\Show;
use App\Models\Product;
use LivewireUI\Modal\ModalComponent;

class AddExtraServicesModal extends ModalComponent
{
    public Product $product;
    public $services = [];
    public $is_gift = false;

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
        $this->dispatch('add-to-cart', $this->services, $this->is_gift)->to(Show::class);
        $this->dispatch('add-to-cart')->to(Header::class);
        $this->closeModal();
    }

    public function render()
    {
        return view('livewire.common.modals.add-extra-services-modal');
    }
}
