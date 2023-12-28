<?php
namespace App\Services;

use App\Repositories\AutomobileRepository;
use App\Models\Driver;
use App\Models\Automobile;

class AutomobileService
{
    protected $automobileRepository;

    /**
     * Create a new service instance.  I like to use dependency injection here, but you could also use the new keyword.
     */
    public function __construct(AutomobileRepository $automobileRepository)
    {
        $this->automobileRepository = $automobileRepository;
    }

    /**
     * Create a new automobile.
     * 
     * @param array $data
     * @return Automobile
     */
    public function createAutomobile(array $data): Automobile
    {
        $automobile = $this->automobileRepository::create($data);
        $automobile->setRandomUnsplashAvatar();
        return $automobile;
    }

    /**
     * Update an automobile and unassign the driver if the driver can no longer drive manual.
     * 
     * @param Automobile $automobile
     * @param array $data
     * @return array
     */
    public function updateAutomobile(Automobile $automobile, array $data): Array
    {
        $updateResult = $this->automobileRepository::update($automobile, $data);
        $driverUnassignedNotice = $this->generateDriverUnassignedNotice($automobile);

        return [
            'automobile' => $updateResult['automobile'],
            'driverUnassignedNotice' => $driverUnassignedNotice
        ];
    }

    /**
     * Generate a driver unassigned notice if the driver can no longer drive due to transmission type.
     * 
     * @param Automobile $automobile
     * @return string 
     */
    public function generateDriverUnassignedNotice(Automobile $automobile): string
    {
        return $automobile->unassignedDriverDueToTransmissionType()
            ? __('Driver unassigned due to transmission type.')
            : '';
    }
}