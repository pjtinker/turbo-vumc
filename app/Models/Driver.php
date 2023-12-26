<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasUnsplashAvatar;

class Driver extends Model
{
    use HasFactory, HasUnsplashAvatar;

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

        return match (count($currently_driving)) {
            0 => 'None',
            1 => $currently_driving[0],
            2 => implode(' and ', $currently_driving),
            default => $currently_driving[0] . ', ' . $currently_driving[1] . ', and ' . (count($currently_driving) - 2) . ' more',
        };
    }

    public function unassignManualAutomobiles()
    {
        if ($this->wasChanged('can_drive_manual') && !$this->can_drive_manual) {
            $count = $this->automobiles()->where('automatic', false)->count();
            $this->automobiles()->where('automatic', false)->update(['driver_id' => null]);
            return $count;
        }
        return 0;
    }
}
