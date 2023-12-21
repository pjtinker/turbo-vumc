<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\Driver;
use Faker\Factory as Faker;
use App\Providers\AutomobileProvider;
use App\Services\UnsplashService;


class AutomobileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $faker = Faker::create();
        $faker->addProvider(new AutomobileProvider($faker));
        $make = $faker->carMake();
        $model = $faker->carModel();

        $unsplashService = new UnsplashService();
        $randomImage = $unsplashService->getRandomImageThumbnail("{$make} {$model}");

        return [
            'make' => $make,
            'model' => $model,
            'year' => $faker->numberBetween(1960, 2023),
            'number_of_cylinders' => $faker->numberOfCylinders(),
            'automatic' => $faker->boolean(),
            'avatar_url' => $randomImage
        ];
    }
}