<?php
namespace App\Repositories;

use App\Models\Automobile;
use App\Models\Driver;
use App\Interfaces\AutomobileRepositoryInterface;
use Illuminate\Support\Collection;

class AutomobileRepository implements AutomobileRepositoryInterface
{
    public static function create(array $data): Automobile
    {
        return Automobile::create($data);
    }

    public static function update(Automobile $automobile, array $data): Array
    {
        $automobile->update($data);
        $driverUnassignedNotice = $automobile->unassignedDriverDueToTransmissionType() ? __('Driver unassigned due to transmission type.') : '';

        return [
            'automobile' => $automobile,
            'driverUnassignedNotice' => $driverUnassignedNotice
        ];
    }

    public static function assignDriver(Automobile $automobile, string $driver_id): bool
    {
        $driver = Driver::find($driver_id);
        return $automobile->driver()->associate($driver)->save();
    }

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