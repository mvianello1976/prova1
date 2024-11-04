<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Review>
 */
class ReviewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => fake()->randomElement(User::role('client')->pluck('id')->toArray()),
            'product_id' => fake()->randomElement(Product::pluck('id')->toArray()),
            'title' => fake()->word(),
            'content' => fake()->text(),
            'rating' => fake()->numberBetween(1, 5),
        ];
    }
}
