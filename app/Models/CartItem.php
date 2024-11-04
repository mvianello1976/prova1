<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory;

    protected $casts = [
        'services' => 'array',
        'coupon' => 'array',
    ];

    public function getTypeAttribute()
    {
        if ($this->product_id) {
            return 'product';
        }
        if ($this->gift_card_id) {
            return 'gift-card';
        }
    }

    public function getParticipantsAttribute()
    {
        return $this->adults + $this->kids + $this->children;
    }

    public function getTotalPriceAttribute()
    {
        $total_price = 0;

        match ($this->type) {
            'product' => call_user_func(function () use (&$total_price) {
                $time = $this->time;
                $participants_price = $time->getTotalPrice($this->adults, $this->kids, $this->children);
                $participants_count = $this->getParticipantsAttribute();

                $extra_services_price = 0;
                foreach (json_decode($this->services) as $s) {
                    $service = Service::find($s);
                    $extra_services_price += match ($service->price_per) {
                        'person' => $service->price * $participants_count,
                        'vehicle' => $service->price,
                        'unatantum' => $service->price,
                        default => 0
                    };
                }

                $total_price = round($participants_price + $extra_services_price);
            }),
            'gift-card' => call_user_func(function () use (&$total_price) {
                $total_price = $this->gift_card->value;
            })
        };
        return $total_price;
    }

    // TODO: Inserire la caparra dinamica
    public function calculateDeposit($total_price)
    {
        return $total_price * 0.10;
    }

    public function showPriceAfterDiscount()
    {
        if ($this->coupon) {
            $total = match ($this->coupon['type']) {
                'percentage' => $this->total_price - $this->calculateDiscount($this->total_price),
                'cash' => $this->total_price - $this->coupon['value'],
            };

            return max($total, 0);
        }

        return $this->total_price;
    }

    public function calculateDiscount($total_price)
    {
        $discount = 0;
        if ($this->coupon) {
            if ($this->coupon['type'] === 'percentage') {
                $discount = $total_price * ($this->coupon['value'] / 100);
            }
            if ($this->coupon['type'] === 'cash') {
                $discount = $this->coupon['value'];
            }
        }

        return $discount;
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function gift_card()
    {
        return $this->belongsTo(GiftCard::class);
    }

    public function time()
    {
        return $this->belongsTo(AvailabilityTime::class, 'availability_time_id');
    }

    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }
}
