<?php

namespace App\Interfaces;

use App\Models\Driver;
use Illuminate\Support\Collection;

interface DriverRepositoryInterface
{
    public static function create(array $data);

    public static function update(Driver $driver, array $data): Array;

    public static function assignAutomobiles(Driver $driver, array $automobileId): Driver;

    public static function getDriverSelect(array $data): Array;
}

