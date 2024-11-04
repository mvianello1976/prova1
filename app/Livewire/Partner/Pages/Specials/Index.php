<?php

namespace App\Livewire\Partner\Pages\Specials;

use App\Models\Special;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class Index extends Component
{
    public $search = '';

    public function deleteSpecial(Special $special)
    {
        $special->delete();
    }

    public function render()
    {
        $specials = auth()->user()->specials()
            ->with('product')
            ->where('name', 'like', '%'.$this->search.'%')
            ->orWhereHas('product', function ($query) {
                $query->where('user_id', auth()->id());
                $query->where('name', 'like', '%'.$this->search.'%');
            })
            ->orderBy('date_start')
            ->orderBy('date_end');

        return view('livewire.partner.pages.specials.index', [
            'specials' => $specials->paginate(10),
        ]);
    }
}
