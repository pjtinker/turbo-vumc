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

    public function unassignedDriverDueToTransmissionType()
    {
        return false;
        if ($this->wasChanged('automatic') && !$this->automatic && $this->wasChanged('driver_id')) {
           $this->driver_id = null;
           $this->save();
           return true;
        }
        return false;
    }
}
