<?php
namespace App\Repositories;

use App\Models\Automobile;
use App\Models\Driver;
use App\Interfaces\AutomobileRepositoryInterface;
use Illuminate\Support\Collection;

class AutomobileRepository implements AutomobileRepositoryInterface
{
    /**
     * Create a new automobile.
     * 
     * @param array $data
     * @return Automobile
     */
    public static function create(array $data): Automobile
    {
        return Automobile::create($data);
    }

    /**
     * Update an automobile and unassign the driver if the driver can no longer drive manual.
     * 
     * @param Automobile $automobile
     * @param array $data
     * @return array
     */
    public static function update(Automobile $automobile, array $data): Array
    {
        $automobile->update($data);
        $driverUnassignedNotice = $automobile->unassignedDriverDueToTransmissionType() ? __('Driver unassigned due to transmission type.') : '';

        return [
            'automobile' => $automobile,
            'driverUnassignedNotice' => $driverUnassignedNotice
        ];
    }

    /**
     * Assign a driver to an automobile.
     * 
     * @param Automobile $automobile
     * @param string $driver_id
     * @return bool
     */
    public static function assignDriver(Automobile $automobile, string $driver_id): bool
    {
        $driver = Driver::find($driver_id);
        return $automobile->driver()->associate($driver)->save();
    }

    /**
     * Get all automobiles that are available for a driver to drive.
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
}