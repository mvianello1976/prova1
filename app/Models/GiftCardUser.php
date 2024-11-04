<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class GiftCardUser extends Pivot
{
    protected $casts = [
        'redeemed_at' => 'datetime',
        'activation_deadline' => 'date',
    ];

    public function card()
    {
        return $this->belongsTo(GiftCard::class, 'gift_card_id');
    }

    public function sender()
    {
        return $this->belongsTo(User::class, 'gift_from');
    }
}
