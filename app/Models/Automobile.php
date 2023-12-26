<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasUnsplashAvatar;

class Automobile extends Model
{
    use HasFactory, HasUnsplashAvatar;

    protected $fillable = [
        'driver_id',
        'make',
        'model',
        'year',
        'number_of_cylinders',
        'automatic',
        'avatar_url'
    ];

    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }
}
