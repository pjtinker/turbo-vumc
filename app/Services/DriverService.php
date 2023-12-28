<?php
namespace App\Services;

use App\Repositories\DriverRepository;
use App\Models\Driver;

/**
 * DriverService
 * 
 * Service layer responsible for handling business logic related to drivers.
 */
class DriverService
{
    protected $driverRepository;

    public function __construct(DriverRepository $driverRepository)
    {
        $this->driverRepository = $driverRepository;
    }

    public function createDriver(array $data): Driver
    {
        $driver = $this->driverRepository::create($data);
        $driver->setRandomUnsplashAvatar();
        return $driver;
    }

    public function updateDriver(Driver $driver, array $data): Array
    {
        $updateResult = $this->driverRepository::update($driver, $data);
        $autoChangeNotice = $this->generateAutoChangeNotice($updateResult['count']);
        
        return [
            'driver'            => $updateResult['driver'],
            'autoChangeNotice'  => $autoChangeNotice
        ];
    }


    public function generateAutoChangeNotice(int $count): string
    {
        return $count > 0
            ? __('Driver can no longer drive manual - :count manual :vehicle unassigned.', [
                'count' => $count,
                'vehicle' => $count > 1 ? 'vehicles were' : 'vehicle was'
            ])
            : '';
    }
}