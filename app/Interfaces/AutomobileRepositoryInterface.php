<?php
namespace App\Interfaces;

use App\Models\Automobile;
use App\Models\Driver;
use Illuminate\Support\Collection;

interface AutomobileRepositoryInterface {
    public static function create(array $data): Automobile;
    public static function update(Automobile $automobile, array $data): Array;
    public static function assignDriver(Automobile $automobile, string $driver_id): bool;
    public static function getAvailableAutomobiles(Driver $driver): Collection;
}