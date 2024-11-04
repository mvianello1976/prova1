<?php

namespace App\Livewire\Partner\Pages\Coupons;

use App\Models\Coupon;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class Index extends Component
{
    public $search = '';

    public function deleteCoupon(Coupon $coupon)
    {
        $coupon->delete();
    }

    public function render()
    {
        $coupons = auth()->user()->coupons()
            ->with('product')
            ->where('code', 'like', '%'.$this->search.'%')
            ->orWhereHas('product', function ($query) {
                $query->where('user_id', auth()->id());
                $query->where('name', 'like', '%'.$this->search.'%');
            })
            ->orderBy('date_start')
            ->orderBy('date_end');

        return view('livewire.partner.pages.coupons.index', [
            'coupons' => $coupons->paginate(10),
        ]);
    }
}
