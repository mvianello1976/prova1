<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserInformation extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $casts = [
        'activities_locations' => 'array',
        'activities_use_external_cms' => 'boolean',
        'terms' => 'boolean',
    ];

    protected $table = 'user_informations';

    public function getCompanyCountryAttribute()
    {
        $country = Country::find($this->country_id);

        return $country;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
