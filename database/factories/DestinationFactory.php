<?php

namespace Database\Factories;

use Adrianorosa\GeoLocation\GeoLocation;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Destination>
 */
class DestinationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = fake()->word();

        $ip = '101.56.208.248';
        $details = GeoLocation::lookup($ip);

        $latitude = $details->getLatitude();
        $longitude = $details->getLongitude();

        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'latitude' => fake()->latitude(($latitude * 10000 - rand(0, 50)) / 10000, ($latitude * 10000 + rand(0, 50)) / 10000),
            'longitude' => fake()->longitude(($longitude * 10000 - rand(0, 50)) / 10000, ($longitude * 10000 + rand(0, 50)) / 10000),
        ];
    }
}
