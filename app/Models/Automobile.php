<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Automobile extends Model
{
    use HasFactory;

    protected $fillable = [
        'driver_id',
        'make',
        'model',
        'year',
        'number_of_cylinders',
        'automatic'
    ];

    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }
}
