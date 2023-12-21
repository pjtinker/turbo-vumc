<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Services\UnsplashService;


class DriverFactory extends Factory
{

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = fake()->firstName();
        $last_name = fake()->lastName();

        $unsplashService = new UnsplashService();
        $randomImage = $unsplashService->getRandomImageThumbnail("Race car driver");
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'years_of_experience' => fake()->numberBetween(0, 20),
            'can_drive_manual' => fake()->boolean(),
            'avatar_url' => $randomImage
        ];
    }
}