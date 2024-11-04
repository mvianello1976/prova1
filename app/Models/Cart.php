<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    public function splitPayment($item)
    {
        $to_pay = 0;
        match ($item->product->payment_type) {
            'online' => call_user_func(function () use ($item, &$to_pay) {
                $total = $item->showPriceAfterDiscount();
                $proportion = $total / $this->total_price;

                if (auth()->user()->hasSufficientBalance($this->total_price)) {
                    $balance = $this->total_price;
                } else {
                    $balance = auth()->user()->balance;
                }

                $to_pay = round($balance * $proportion, 2);
            }),
            'cash' => call_user_func(function () use ($item, &$to_pay) {
                $total = $item->calculateDeposit($item->showPriceAfterDiscount());
                $proportion = $total / $this->total_price;

                if (auth()->user()->hasSufficientBalance($this->total_price)) {
                    $balance = $this->total_price;
                } else {
                    $balance = auth()->user()->balance;
                }

                $to_pay = round($balance * $proportion, 2);
            }),
        };

        return $to_pay;
    }

    public function getTotalPriceAttribute()
    {
        $total = 0;
        $items = $this->items()->get();

        foreach ($items as $item) {
            match ($item->type) {
                'product' => call_user_func(function () use ($item, &$total) {
                    $priceAfterDiscount = $item->showPriceAfterDiscount();
                    if ($item->product->payment_type === 'online') {
                        // Se il pagamento è online, aggiungi il prezzo totale dell'item direttamente al totale
                        $total += $priceAfterDiscount;
                    } elseif ($item->product->payment_type === 'cash') {
                        // Se il pagamento è in contanti, calcola la caparra dopo aver applicato lo sconto
                        $depositAmount = $item->calculateDeposit($priceAfterDiscount);
                        $total += $depositAmount;
                    }
                }),
                'gift-card' => call_user_func(function () use ($item, &$total) {
                    $total += $item->gift_card->value;
                })
            };
        }

        return max($total, 0);
    }

    public function getTotalPriceAfterDiscountAttribute()
    {
        if (auth()->user()->hasSufficientBalance($this->total_price)) {
            return 0;
        } else {
            return auth()->user()->remainingBalance($this->total_price);
        }
    }

    public function items()
    {
        return $this->hasMany(CartItem::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
