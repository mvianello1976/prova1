<?php

namespace App\Livewire\Common;

use App\Models\Product;
use Livewire\Component;

class ProductCard extends Component
{
    public $recommended;

    public $capacity;

    public $theme = 'dark';

    public Product $product;

    public function toggleFavorite()
    {
        $user = auth()->user();

        if ($user->favorites()->where('product_id', $this->product->id)->exists()) {
            $user->favorites()->detach($this->product->id);
        } else {
            $user->favorites()->attach($this->product->id);
        }

        $this->dispatch('favorite-toggled');
    }

    public function render()
    {
        return view('livewire.common.product-card', [
            'isFavorited' => auth()->user() && auth()->user()->favorites->contains($this->product->id),
        ]);
    }
}
