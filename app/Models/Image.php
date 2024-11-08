<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function imageable() {
        return $this->morphTo();
    }

    public function product() {
        return $this->belongsTo(Product::class);
    }
}
