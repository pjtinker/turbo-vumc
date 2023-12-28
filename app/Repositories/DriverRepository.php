<?php 
namespace App\Repositories;

use App\Models\Driver;
use App\Models\Automobile;
use App\Interfaces\DriverRepositoryInterface;
use Illuminate\Support\Collection;

class DriverRepository implements DriverRepositoryInterface
{
    /**
     * Create a new driver.
     * @param array $data
     * @return Driver
     */
    public static function create(array $data): Driver
    {
        return Driver::create($data);
    }

    /**
     * Update a driver and unassign all automobiles if the driver can no longer drive manual.  
     * @param Driver $driver
     * @param array $data
     * @return array
     */
    public static function update(Driver $driver, array $data): Array
    {
        $driver->update($data);
        $count = $driver->unassignManualAutomobiles();

        return ['count' => $count, 'driver' => $driver];
    }

    /**
     * Assign automobiles to a driver.
     * 
     * @param Driver $driver
     * @param array $automobileIds
     * @return Driver
     */
    public static function assignAutomobiles(Driver $driver, array $automobileIds): Driver
    {
        if ($driver->automobiles()->exists()) {
            $driver->automobiles()->update(['driver_id' => null]);
        }
        
        if (!empty($automobileIds)) {
            // I'm using Laravel methods here, but you could also use a foreach loop
            // and manually assign each automobile to the driver. e.g.
            // foreach (Automobile::whereIn('id', $automobileIds) as $automobile) {
            //     $automobile->driver()->associate($driver)->save();
            // }
            $driver->automobileIds()->saveMany(Automobile::findMany($automobiles));
        }

        return $automobile->driver()->associate($driver)->save();
    }

    /**
     * Get all automobiles that are available to be assigned to a driver.
     * 
     * @param Driver $driver
     * @return Collection
     */
    public static function getAvailableAutomobiles(Driver $driver): Collection
    {
        $builder = Automobile::where(function ($query) use ($driver) {
            $query->whereNull('driver_id')
                ->orWhere('driver_id', $driver->id);
        });

        if (!$driver->can_drive_manual) {
            $builder->where('automatic', true);
        }

        return $builder->get();
    }

    public static function getDriverSelect(array $data): Array
    {
        $builder = Driver::query();
        // I would convert this to an actual boolean upstream, but I'm leaving it for now.
        $isManual = $data['isManual'] === 'true';
        $currentDriverId = $data['currentDriverId'] ?? '';
        
        if ($isManual == true) {
            $builder->where('can_drive_manual', true);
        }

        return ['drivers' => $builder->get(), 'currentDriverId' => $currentDriverId];
    }
}