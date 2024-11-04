<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use HasRoles;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public function getFullnameAttribute()
    {
        return "$this->first_name $this->last_name";
    }

    public function hasSufficientBalance($amount)
    {
        return $this->balance >= $amount;
    }

    public function remainingBalance($amount)
    {
        return $amount - auth()->user()->balance;
    }

    public function removeBalance($amount)
    {
        $this->balance -= $amount;
        $this->save();
    }

    public function addBalance($amount)
    {
        $this->balance += $amount;
        $this->save();
    }

    public function partnerMissingData()
    {
        $steps = 4;
        $total = 100;

        if ($this->checkInsurance()) {
            $steps--;
            $total -= 25;
        }
        if ($this->checkCompanyLogo()) {
            $steps--;
            $total -= 25;
        }
        if ($this->checkBankData()) {
            $steps--;
            $total -= 25;
        }
        if ($this->check2FA()) {
            $steps--;
            $total -= 25;
        }

        return [
            'total' => $total,
            'steps' => $steps,
        ];
    }

    public function checkInsurance()
    {
        return !$this->informations->registration_number || !$this->informations->liability_insurance;
    }

    public function checkCompanyLogo()
    {
        return !$this->informations->company_logo;
    }

    public function checkBankData()
    {
        return !$this->informations->bank_name || !$this->informations->bank_account_holder || !$this->informations->bank_iban || !$this->informations->bank_bic;
    }

    public function check2FA()
    {
        return !$this->hasEnabledTwoFactorAuthentication();
    }

    public function getRoleAttribute()
    {
        return $this->roles()->first();
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function specials()
    {
        return $this->hasMany(Special::class);
    }

    public function informations()
    {
        return $this->hasOne(UserInformation::class);
    }

    public function cart()
    {
        return $this->hasOne(Cart::class);
    }

    public function orders()
    {
        return match (auth()->user()->role->name) {
            'partner' => $this->hasMany(Order::class, 'partner_id', 'id'),
            'client' => $this->hasMany(Order::class)
        };
    }

    public function has_reviewed_product($product_id)
    {
        return $this->reviews()->where('product_id', $product_id)->first() ?? false;
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function favorites()
    {
        return $this->belongsToMany(Product::class, 'favorites');
    }

    public function coupons()
    {
        return $this->hasMany(Coupon::class);
    }

    public function received_gift_cards()
    {
        return $this->hasMany(GiftCardUser::class);
    }

    public function sent_gift_cards()
    {
        return $this->hasManyThrough(
            GiftCard::class,
            GiftCardUser::class,
            'gift_from',
            'id',
            'id',
            'gift_card_id'
        );
    }
}
