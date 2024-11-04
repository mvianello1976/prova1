<?php

namespace App\Livewire\Partner\Pages\Availability;

use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class Index extends Component
{
    public $search = '';

    public function render()
    {
        $products = auth()->user()->products()->with('availabilities')->whereHas('availabilities');

        if ($this->search) {
            $products = $products->where('name', 'like', '%' . $this->search . '%');
        }

        return view('livewire.partner.pages.availability.index', [
            'products' => $products->paginate(10),
        ]);
    }
}
