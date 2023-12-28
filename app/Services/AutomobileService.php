<?php
namespace App\Services;

use App\Repositories\AutomobileRepository;
use App\Models\Driver;
use App\Models\Automobile;

class AutomobileService
{
    protected $automobileRepository;

    public function __construct(AutomobileRepository $automobileRepository)
    {
        $this->automobileRepository = $automobileRepository;
    }

    public function createAutomobile(array $data): Automobile
    {
        $automobile = $this->automobileRepository::create($data);
        $automobile->setRandomUnsplashAvatar();
        return $automobile;
    }

    public function updateAutomobile(Automobile $automobile, array $data): Array
    {
        $updateResult = $this->automobileRepository::update($automobile, $data);
        $driverUnassignedNotice = $this->generateDriverUnassignedNotice($automobile);

        return [
            'automobile' => $updateResult['automobile'],
            'driverUnassignedNotice' => $driverUnassignedNotice
        ];
    }

    public function generateDriverUnassignedNotice(Automobile $automobile): string
    {
        return $automobile->unassignedDriverDueToTransmissionType()
            ? __('Driver unassigned due to transmission type.')
            : '';
    }
}