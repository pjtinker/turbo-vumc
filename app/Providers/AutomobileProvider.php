<?php

namespace App\Providers;

use Faker\Provider\Base;

/**
 * Used when generating fake data for automobiles.
 * 
 * This could be refactored to use as a validation tool for creation and updating of automobiles.
 */

class AutomobileProvider extends Base
{
    protected static $carMakes = [
        'Toyota', 'Honda', 'Ford', 'Chevrolet', 'Nissan', 'Hyundai', 'Volkswagen', 'BMW', 'Mercedes-Benz',
    ];

    protected static $carModels = [
        'Camry', 'Civic', 'Accord', 'F-150', 'Corolla', 'Sentra', 'Elantra', 'Jetta', '3 Series', 'C-Class',
    ];

    public function carMake()
    {
        return static::randomElement(self::$carMakes);
    }

    public function carModel()
    {
        return static::randomElement(self::$carModels);
    }

    public function numberOfCylinders()
    {
        return static::randomElement([4, 6, 8]);
    }
}
