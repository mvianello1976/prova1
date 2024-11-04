<?php

namespace App\Livewire\Partner\Pages;

use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class Dashboard extends Component
{
    protected $listeners = [
        'partner-missing-data-updated' => '$refresh'
    ];

    public function render()
    {
        return view('livewire.partner.pages.dashboard', [
            'published' => auth()->user()->products()->published()->get(),
            'drafts' => auth()->user()->products()->drafts()->get(),
        ]);
    }
}
