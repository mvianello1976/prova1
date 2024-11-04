<?php

namespace App\Models;

use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Availability extends Model
{
    use HasFactory;

    public function checkOverlap($dates = [])
    {
        $arr = [];
        foreach ($dates as $d) {
            if ($d['dates'] && $d['time_start'] && $d['time_end']) {
                // Formatto le date
                if (Carbon::canBeCreatedFromFormat($d['dates'][0], 'Y-m-d')) {
                    $date_start = Carbon::createFromFormat('Y-m-d', $d['dates'][0])->startOfDay();
                } else {
                    $date_start = Carbon::createFromFormat('d/m/Y', $d['dates'][0])->startOfDay();
                }

                if (Carbon::canBeCreatedFromFormat($d['dates'][1], 'Y-m-d')) {
                    $date_end = Carbon::createFromFormat('Y-m-d', $d['dates'][1])->startOfDay();
                } else {
                    $date_end = Carbon::createFromFormat('d/m/Y', $d['dates'][1])->startOfDay();
                }

                // Creazione times
                $date_period = CarbonPeriod::create($date_start, '1 day', $date_end);
                foreach ($date_period as $date) {
                    $time_period = CarbonPeriod::create($d['time_start'], "{$d['step']} minutes", $d['time_end']);
                    foreach ($time_period as $time) {
                        $arr[] = $date->format('Y-m-d').' '.$time->format('H:i');
                    }
                }
            }
        }

        $valueCounts = array_count_values($arr);

        foreach ($valueCounts as $value) {
            if ($value > 1) {
                return true;
            }
        }

        return false;
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function dates()
    {
        return $this->hasMany(AvailabilityDate::class);
    }

    public function times()
    {
        return $this->hasManyThrough(AvailabilityTime::class, AvailabilityDate::class);
    }
}
