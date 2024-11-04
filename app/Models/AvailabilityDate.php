<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AvailabilityDate extends Model
{
    use HasFactory;

    protected $casts = [
        'date_start' => 'datetime:d-m-Y',
        'date_end' => 'datetime:d-m-Y',
        'time_start' => 'datetime:H:i',
        'time_end' => 'datetime:H:i',
    ];

    public function getParticipantsPerTimeAttribute()
    {
        $time = match ($this->step) {
            '5' => __('5 minuti'),
            '10' => __('10 minuti'),
            '15' => __('15 minuti'),
            '20' => __('20 minuti'),
            '25' => __('25 minuti'),
            '30' => __('30 minuti'),
            '60' => __('ora')
        };

        if ($this->availability->product->isRental()) {
            return trans_choice('{1} :count persona|[2,*] :count persone', $this->participants_per_vehicle).'/mezzo';
        }

        return trans_choice('{1} :count persona|[2,*] :count persone', $this->availability->participants).'/'.trans_choice(':count', $time);
    }

    public function availability()
    {
        return $this->belongsTo(Availability::class);
    }

    public function times()
    {
        return $this->hasMany(AvailabilityTime::class);
    }
}
