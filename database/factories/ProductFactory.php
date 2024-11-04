<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Destination;
use App\Models\Typology;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = fake()->word();

        return [
            'user_id' => fake()->randomElement(User::role('partner')->pluck('id')->toArray()),
            'destination_id' => fake()->randomElement(Destination::all()->pluck('id')->toArray()),
            'category_id' => fake()->randomElement(Category::all()->pluck('id')->toArray()),
            'typology_id' => fake()->randomElement(Typology::all()->pluck('id')->toArray()),
            'name' => $name,
            'slug' => Str::slug($name),
            'description' => fake()->sentence(),
            'cancellation' => fake()->randomElement(array_keys(config('tripsytour.cancellations'))),
            'duration' => fake()->numberBetween(1, 6),
            'difficulty' => fake()->randomElement(array_keys(config('tripsytour.difficulties'))),
            'pets_allowed' => fake()->boolean(),
            'accessibility' => fake()->boolean(),
            'reception_staff' => fake()->randomElements(array_keys(config('tripsytour.reception_staff')), 2),
            'keywords' => fake()->words(5),
            'not_suitable' => [],
            'not_allowed' => [],
            'mandatory_items' => [],
            'preliminary_informations' => fake()->sentence(),
            'contact' => null,
            'payment_type' => null,
        ];
    }
}
