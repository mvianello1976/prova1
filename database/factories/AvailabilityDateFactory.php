<?php

namespace Database\Factories;

use App\Models\Availability;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AvailabilityDate>
 */
class AvailabilityDateFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'availability_id' => Availability::all()->shuffle()->first()->id,
            'adults_price' => fake()->randomFloat(0, 1, 50),
            'kids_price' => fake()->randomFloat(0, 1, 30),
            'children_price' => fake()->randomFloat(0, 1, 10),
            'date_start' => Carbon::now()->startOfDay()->format('Y-m-d'),
            'date_end' => Carbon::now()->addDays(2)->startOfDay()->format('Y-m-d'),
            'time_start' => Carbon::createFromTime(8)->format('H:i:s'),
            'time_end' => Carbon::createFromTime(12)->format('H:i:s'),
            'step' => fake()->randomElement(config('tripsytour.product.availabilities.steps')),
        ];
    }
}
