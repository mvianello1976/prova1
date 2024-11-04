<?php

namespace App\Livewire\Guest\Pages;

use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;

#[Layout('layouts.guest')]
class Favorites extends Component
{
    public $favorites;

    #[On('favorite-toggled')]
    public function mount()
    {
        if (! auth()->user()) {
            return redirect()->route('login');
        }
    }

    public function render()
    {
        return view('livewire.guest.pages.favorites');
    }
}
