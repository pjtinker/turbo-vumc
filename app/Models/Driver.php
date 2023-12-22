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

    protected $appends = [
        'automobiles_count',
        'currently_driving_string'
    ];
    
    public function automobiles()
    {
        return $this->hasMany(Automobile::class);
    }

    public function getAutomobilesCountAttribute()
    {
        return $this->automobiles()->count();
    }

    public function getCurrentlyDrivingStringAttribute()
    {
        $automobiles = $this->automobiles;
        $currently_driving = [];
        foreach ($automobiles as $automobile) {
            $currently_driving[] = $automobile->make . ' ' . $automobile->model;
        }

        switch (count($currently_driving)) {
            case 0:
                return 'None';
            case 1:
                return $currently_driving[0];
            case 2:
                return implode(' and ', $currently_driving);
            default:
                return $currently_driving[0] + ', ' + $currently_driving[1] + ' and ' + count($currently_driving) - 2 + ' more';
        }
    }
}
