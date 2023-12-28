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
        'can_drive_manual',
        'avatar_url'
    ];

    protected $casts = [
        'can_drive_manual' => 'boolean',
    ];

    protected $appends = [
        'automobiles_count',
        'currently_driving_string'
    ];
    
    protected static function booted()
    {
        /**
         * I try to be wary of using observers, but in this case it's the best option to ensure
         * that the automobile is unassociated if the driver is deleted.
         * 
         * I could also have added the can_drive_manual check here.
         */
        static::deleted(function ($driver) {
            $driver->automobiles()->update(['driver_id' => null]);
        });
    }

    public function automobiles()
    {
        return $this->hasMany(Automobile::class);
    }

    public function getAutomobilesCountAttribute()
    {
        return $this->automobiles()->count();
    }

    /**
     * Helper method to get a string of the automobiles a driver is currently driving.
     * 
     * @return string The string of automobiles.
     */
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

    /**
     * Helper method unassign any manual automobiles if the driver can no longer drive manual.
     * 
     * @return int The number of automobiles unassigned.
     */
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
