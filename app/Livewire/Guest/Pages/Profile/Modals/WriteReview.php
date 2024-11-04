<?php

namespace App\Livewire\Guest\Pages\Profile\Modals;

use App\Livewire\Guest\Pages\Profile\Tabs\Bookings;
use App\Models\Product;
use LivewireUI\Modal\ModalComponent;

class WriteReview extends ModalComponent
{
    public Product $product;

    public $title = '';

    public $content = '';

    public $rating = null;

    public function submit()
    {
        $this->validate();
        auth()->user()->reviews()->create([
            'product_id' => $this->product->id,
            'title' => $this->title,
            'content' => $this->content,
            'rating' => $this->rating,
        ]);

        $this->closeModal();
        $this->dispatch('review-writed')->to(Bookings::class);
    }

    public function render()
    {
        return view('livewire.guest.pages.profile.modals.write-review');
    }

    protected function rules()
    {
        return [
            'title' => 'required',
            'content' => 'required',
            'rating' => 'required',
        ];
    }
}
