<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class Service extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $casts = [
        'restrictions' => 'array',
        'languages' => 'array'
    ];

    public function getNameAttribute()
    {
        return config("tripsytour.services.$this->type.$this->item.label");
    }

    public function getDescriptionAttribute()
    {
        if ($this->restrictions) {
            $restrictions = [];
            foreach ($this->restrictions as $restriction) {
                $restrictions[] = config("tripsytour.services.restrictions.$restriction.for");
            }
            $restrictions_text = Arr::join($restrictions, ', ', __(' e '));
        }
        if ($this->languages) {
            $languages = [];
            foreach ($this->languages as $language) {
                $languages[] = config("tripsytour.services.languages.$language");
            }
            $languages_text = Arr::join($languages, ', ', __(' e '));
        }
        return match ($this->type) {
            'food' => $this->restrictions ? __('Disponibile anche per ').$restrictions_text : null,
            'staff' => $this->languages ? __('Disponibile anche in ').$languages_text : null,
            default => config("tripsytour.services.$this->type.$this->item.description") ? config("tripsytour.services.$this->type.$this->item.description") : null
        };
    }

    public function getPriceTypeAttribute()
    {
        return match ($this->price_per) {
            'person' => __('a persona'),
            'vehicle' => __('a mezzo'),
            'unatantum' => __('una tantum'),
            default => null
        };
    }
}
