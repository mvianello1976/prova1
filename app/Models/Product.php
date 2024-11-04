<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $casts = [
        'pets_allowed' => 'boolean',
        'accessibility' => 'boolean',
        'reception_staff' => 'array',
        'meeting_point_coords' => 'array',
        'keywords' => 'array',
        'not_suitable' => 'array',
        'not_allowed' => 'array',
        'mandatory_items' => 'array',
        'photos' => 'array',
        'payment_types' => 'array',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($product) {
            $product->slug = Str::slug($product->name);
        });

        static::updating(function ($product) {
            $product->slug = Str::slug($product->name);
        });
    }

    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    public function scopeDrafts($query)
    {
        return $query->where('status', 'draft');
    }

    public function isRental()
    {
        return $this->typology_id === 6;
    }

    public function getGoogleMapsLink()
    {
        if ($this->meeting_point_coords) {
            return "https://www.google.com/maps/place/{$this->meeting_point_coords[0]},{$this->meeting_point_coords[1]}";
        }
    }

    // Verifica se il prodotto è in offerta in una data specifica
    public function isInSpecialOffer($date)
    {
        if($date) {
            return $this->specials()
                ->whereDate('date_start', '<=', $date)
                ->whereDate('date_end', '>=', $date)
                ->exists();
        }
    }

    public function getBasePriceAttribute()
    {
        $date = Carbon::parse(session('date', now()));

        if ($this->isRental()) {
            // Trovo il prezzo speciale più basso per la data specificata
            $specialPrice = Special::where('product_id', $this->id)
                ->whereDate('date_start', '<=', $date)
                ->whereDate('date_end', '>=', $date)
                ->min('rental_total_price');

            // Trovo tutti i prezzi standard disponibili per tutte le date
            $standardPrices = $this->availabilities()
                ->whereHas('dates', function ($query) use ($date) {
                    $query->whereDate('date_start', '<=', $date)
                        ->whereDate('date_end', '>=', $date);
                })
                ->with(['dates' => function ($query) use ($date) {
                    $query->whereDate('date_start', '<=', $date)
                        ->whereDate('date_end', '>=', $date)
                        ->orderBy('rental_total_price', 'asc');
                }])
                ->get()
                ->pluck('dates.0.rental_total_price')
                ->filter();

            // Se non ci sono prezzi standard disponibili per la data specificata, cerco il prezzo più basso tra tutte le disponibilità
            if ($standardPrices->isEmpty()) {
                $standardPrice = $this->availabilities()
                    ->with(['dates' => function ($query) {
                        $query->orderBy('rental_total_price', 'asc');
                    }])
                    ->get()
                    ->pluck('dates.0.rental_total_price')
                    ->filter()
                    ->min();
            } else {
                // Prendo il prezzo standard più basso tra quelli disponibili per la data specificata
                $standardPrice = $standardPrices->min();
            }

        } else {
            // Non è un noleggio, quindi considero i prezzi per adulti

            // Trovo il prezzo speciale più basso per la data specificata
            $specialPrice = Special::where('product_id', $this->id)
                ->whereDate('date_start', '<=', $date)
                ->whereDate('date_end', '>=', $date)
                ->min('adults_price');

            // Trovo tutti i prezzi standard disponibili per tutte le date
            $standardPrices = $this->availabilities()
                ->whereHas('dates', function ($query) use ($date) {
                    $query->whereDate('date_start', '<=', $date)
                        ->whereDate('date_end', '>=', $date);
                })
                ->with(['dates' => function ($query) use ($date) {
                    $query->whereDate('date_start', '<=', $date)
                        ->whereDate('date_end', '>=', $date)
                        ->orderBy('adults_price', 'asc');
                }])
                ->get()
                ->pluck('dates.0.adults_price')
                ->filter();

            // Se non ci sono prezzi standard disponibili per la data specificata, cerco il prezzo più basso tra tutte le disponibilità
            if ($standardPrices->isEmpty()) {
                $standardPrice = $this->availabilities()
                    ->with(['dates' => function ($query) {
                        $query->orderBy('adults_price', 'asc');
                    }])
                    ->get()
                    ->pluck('dates.0.adults_price')
                    ->filter()
                    ->min();
            } else {
                // Prendo il prezzo standard più basso tra quelli disponibili per la data specificata
                $standardPrice = $standardPrices->min();
            }
        }

        // Confronto il prezzo speciale e quello standard, prendendo il più basso
        if ($specialPrice !== null && $standardPrice !== null) {
            $lowest_price = min($specialPrice, $standardPrice);
        } elseif ($specialPrice !== null) {
            $lowest_price = $specialPrice;
        } elseif ($standardPrice !== null) {
            $lowest_price = $standardPrice;
        } else {
            $lowest_price = 0; // Nessun prezzo disponibile
        }

        return $lowest_price;
    }


    public function availabilities()
    {
        return $this->hasMany(Availability::class);
    }

    public function getStepsPercentageAttribute()
    {
        $steps = 12;

        $step = $this->temporary_step ?? $this->current_step;

        return ($step / $steps) * 100;
    }

    public function getDraftStepsPercentageAttribute()
    {
        $steps = 14;

        return ($this->current_step / $steps) * 100;
    }

    public function getReceptionStaffLanguagesAttribute()
    {
        $languages = [];
        foreach ($this->reception_staff as $language) {
            $languages[] = config("tripsytour.services.languages.$language");
        }

        return Arr::join($languages, ', ', __(' e '));
    }

    public function getKeywordsListAttribute()
    {
        return Arr::join($this->keywords, ', ', __(' e '));
    }

    public function getIncludedServicesListAttribute()
    {
        $services = [];
        foreach ($this->included_services as $service) {
            $services[] = config("tripsytour.services.{$service->type}.{$service->item}.label");
        }

        return Arr::join($services, ', ', __(' e '));
    }

    public function getMainImageAttribute()
    {
        return $this->images()->first();
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function getSecondaryImagesAttribute()
    {
        return $this->images->skip(1);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function destination()
    {
        return $this->belongsTo(Destination::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function typology()
    {
        return $this->belongsTo(Typology::class);
    }

    public function included_services()
    {
        return $this->hasMany(Service::class)->whereNull('price');
    }

    public function extra_services()
    {
        return $this->hasMany(Service::class)->whereNotNull('price');
    }

    public function specials()
    {
        return $this->hasMany(Special::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function faqs()
    {
        return $this->hasMany(Faq::class);
    }

    public function favoritedBy()
    {
        return $this->belongsToMany(User::class, 'favorites');
    }

    public function coupons()
    {
        return $this->hasMany(Coupon::class);
    }
}
