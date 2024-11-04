<?php

namespace App\Livewire\Guest\Pages;

use Carbon\Carbon;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.guest')]
class Index extends Component
{
    public function mount() {
        session()->remove('destination_id');
        session()->put('date', Carbon::now()->format('Y/m/d'));
        session()->remove('adults');
        session()->remove('kids');
        session()->remove('children');
    }

    public function render()
    {
        return view('livewire.guest.pages.index');
    }
}
