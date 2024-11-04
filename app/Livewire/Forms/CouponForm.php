<?php

namespace App\Livewire\Forms;

use App\Models\Coupon;
use Carbon\Carbon;
use Livewire\Form;

class CouponForm extends Form
{
    public ?Coupon $coupon;

    public $code = '';

    public $dates = [];

    public $value = null;

    public $product_id = null;

    public $typology_id = null;

    public $types = [
        'percentage' => 'Percentuale',
        'cash' => 'Importo',
    ];

    public $type = null;

    public function setCoupon(?Coupon $coupon)
    {
        if ($coupon) {
            $this->coupon = $coupon;

            $product = $coupon->product ? $coupon->product : null;

            $this->product_id = $product ? $coupon->product->id : null;
            $this->typology_id = $product ? $product->typology_id : null;

            $this->code = $coupon->name;
            $this->type = $coupon->type;
            $this->value = $coupon->value;
            if ($coupon->date_start && $coupon->date_end) {
                $this->dates = [
                    Carbon::parse($coupon->date_start)->startOfDay()->format('d/m/Y'),
                    Carbon::parse($coupon->date_end)->startOfDay()->format('d/m/Y'),
                ];
            }
        } else {
            $this->coupon = new Coupon();
        }
    }

    public function submit()
    {
        $this->validate([
            'product_id' => 'required|exists:products,id',
            'code' => 'required',
            'type' => 'required|in:percentage,cash',
            'value' => 'required',
            'dates' => 'required|array',
        ]);

        $date_start = Carbon::createFromFormat('d/m/Y', $this->dates[0])->startOfDay();
        $date_end = Carbon::createFromFormat('d/m/Y', $this->dates[1])->startOfDay();
        $this->coupon->update([
            'user_id' => auth()->id(),
            'product_id' => $this->product_id,
            'code' => $this->code,
            'type' => $this->type,
            'value' => $this->value,
            'date_start' => $date_start,
            'date_end' => $date_end,
        ]);
    }
}
