<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Service>
 */
class ServiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'product_id' => Product::all()->shuffle()->first()->id
        ];
    }

    public function included()
    {
        return $this->state(function ($attributes) {
            $type = fake()->randomElement(['food', 'staff']);
            $restrictions = match ($type) {
                'food' => fake()->randomElements(array_keys(config('tripsytour.services.restrictions')), 2),
                'staff' => null
            };
            $languages = match ($type) {
                'staff' => fake()->randomElements(array_keys(config('tripsytour.services.languages')), 2),
                'food' => null
            };

            return [
                'type' => $type,
                'item' => fake()->randomElement(array_keys(config('tripsytour.services.'.$type))),
                'restrictions' => $restrictions,
                'languages' => $languages
            ];
        });
    }

    public function extra()
    {
        return $this->state(function ($attributes) {
            $type = fake()->randomElement(['food', 'staff']);
            $restrictions = match ($type) {
                'food' => fake()->randomElements(array_keys(config('tripsytour.services.restrictions')), 2),
                'staff' => null
            };
            $price_per = match ($type) {
                'food' => 'person',
                'staff' => fake()->randomElement(['vehicle', 'unatantum'])
            };
            $languages = match ($type) {
                'staff' => fake()->randomElements(array_keys(config('tripsytour.services.languages')), 2),
                'food' => null
            };

            return [
                'type' => $type,
                'item' => fake()->randomElement(array_keys(config('tripsytour.services.'.$type))),
                'restrictions' => $restrictions,
                'languages' => $languages,
                'price' => fake()->randomFloat(0, 1, 30),
                'price_per' => $price_per
            ];
        });
    }
}
