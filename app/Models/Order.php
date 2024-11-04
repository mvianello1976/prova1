<?php

namespace App\Models;

use App\Traits\Searchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory, Searchable, SoftDeletes;

    protected $casts = [
        'data' => 'array',
        'coupon' => 'array',
        'gift_data' => 'array',
        'paid_at' => 'datetime',
        'canceled_at' => 'date',
        'redeemed_at' => 'datetime',
    ];

    public function getTotalPriceAttribute()
    {
        $time = AvailabilityTime::find($this->data['booking']['time_id']);
        $participants_price = $time->getTotalPrice($this->data['booking']['participants']['adults'], $this->data['booking']['participants']['kids'], $this->data['booking']['participants']['children']);
        $participants_count = ($this->data['booking']['participants']['adults'] + $this->data['booking']['participants']['kids'] + $this->data['booking']['participants']['children']);

        $extra_services_price = 0;
        foreach ($this->data['booking']['services'] as $s) {
            $service = Service::find($s['id']);
            $extra_services_price += match ($service->price_per) {
                'person' => $service->price * $participants_count,
                'vehicle' => $service->price,
                default => 0
            };
        }

        return round($participants_price + $extra_services_price);
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

    public function isReceivedGift()
    {
        return $this->is_gift && $this->gift_from !== auth()->id();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function partner()
    {
        return $this->belongsTo(User::class, 'partner_id');
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }

    public function sender()
    {
        return $this->belongsTo(User::class, 'gift_from');
    }
}
