<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AvailabilityTime extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function getRealAvailabilityAttribute()
    {
        return $this->max - ($this->booked + $this->sold);
    }

    public function getAdultsPrice()
    {
        $special_offer = $this->hasSpecialOffer();

        if ($special_offer) {
            if ($special_offer->type === 'cash') {
                return $special_offer->adults_price;
            } else {
                return $this->availability_date?->adults_price * ((100 - $special_offer->percentage) / 100);
            }
        } else {
            return $this->availability_date->adults_price;
        }
    }

    protected function hasSpecialOffer()
    {
        return $this->availability->product->specials()->whereDate('date_start', '<=', $this->date)->whereDate('date_end', '>=', $this->date)->first();
    }

    public function getKidsPrice()
    {
        $special_offer = $this->hasSpecialOffer();

        if ($special_offer) {
            if ($special_offer->type === 'cash') {
                return $special_offer->kids_price;
            } else {
                return $this->availability_date?->kids_price * ((100 - $special_offer->percentage) / 100);
            }
        } else {
            return $this->availability_date->kids_price;
        }
    }

    public function getChildrenPrice()
    {
        $special_offer = $this->hasSpecialOffer();

        if ($special_offer) {
            if ($special_offer->type === 'cash') {
                return $special_offer->children_price;
            } else {
                return $this->availability_date?->children_price * ((100 - $special_offer->percentage) / 100);
            }
        } else {
            return $this->availability_date->children_price;
        }
    }

    public function getTotalPrice($adults = 0, $kids = 0, $children = 0)
    {
        $special_offer = $this->hasSpecialOffer();

        if ($special_offer) {
            if ($special_offer->type === 'cash') {
                if ($this->availability->product->isRental()) {
                    return $special_offer->rental_total_price;
                } else {
                    return ($special_offer?->adults_price * $adults) + ($special_offer?->kids_price * $kids) + ($special_offer?->children_price * $children);
                }
            } else {
                if ($this->availability->product->isRental()) {
                    return $this->availability_date->rental_total_price * ((100 - $special_offer->percentage)) / 100;
                } else {
                    $ap = $this->availability_date?->adults_price * ((100 - $special_offer->percentage) / 100);
                    $kp = $this->availability_date?->kids_price * ((100 - $special_offer->percentage) / 100);
                    $cp = $this->availability_date?->children_price * ((100 - $special_offer->percentage) / 100);

                    return ($ap * $adults) + ($kp * $kids) + ($cp * $children);
                }
            }
        } else {
            if ($this->availability->product->isRental()) {
                return $this->availability_date->rental_total_price;
            } else {
                return ($this->availability_date?->adults_price * $adults) + ($this->availability_date?->kids_price * $kids) + ($this->availability_date?->children_price * $children);
            }
        }
    }

    public function availability_date()
    {
        return $this->belongsTo(AvailabilityDate::class);
    }

    public function availability()
    {
        return $this->hasOneThrough(Availability::class, AvailabilityDate::class, 'id', 'id', 'availability_date_id', 'availability_id');
    }
}
