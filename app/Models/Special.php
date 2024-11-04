<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Special extends Model
{
    use HasFactory;

    protected $casts = [
        'date_start' => 'datetime:d-m-Y',
        'date_end' => 'datetime:d-m-Y',
    ];

    public function getStatusAttribute()
    {
        $start = $this->date_start->startOfDay();
        $end = $this->date_end->endOfDay();

        //        if (Carbon::now()->startOfDay()->lt($start)) {
        //            return 'programmed';
        //        }
        if (Carbon::now()->startOfDay()->lt($start) || Carbon::now()->betweenIncluded($start, $end)) {
            return 'active';
        }
        if (Carbon::now()->startOfDay()->gte($start)) {
            return 'not_active';
        }
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
