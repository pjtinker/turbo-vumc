<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'years_of_experience',
        'can_drive_manual'
    ];

    protected $casts = [
        'can_drive_manual' => 'boolean',
    ];
    
    public function automobiles()
    {
        return $this->hasMany(Automobile::class);
    }
}
