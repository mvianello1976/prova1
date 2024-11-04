<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GiftCard extends Model
{
    use HasFactory;

    public function recipients()
    {
        return $this->belongsToMany(User::class, 'gift_card_user')
            ->withPivot('gift_from', 'redeem_code', 'redeemed', 'redeemed_at')
            ->withTimestamps();
    }
}
