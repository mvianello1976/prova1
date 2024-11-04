<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $product = Product::factory()->create([
            'current_step' => 13,
            'status' => 'published'
        ]);
        $user = User::factory()->create();
        $partner = User::factory()->create();
        $payment_method = $this->faker->randomElement(['online', 'cash']);
        $total = $this->faker->randomFloat(2, 10, 100);

        return [
            'uuid' => Str::random(),
            'user_id' => $user,
            'partner_id' => $partner,
            'data' => [
                'booking' => [
                    'date' => $this->faker->date(),
                    'time' => $this->faker->time(),
                    'duration' => $product->duration,
                    'participants' => [
                        'total' => 1,
                        'adults' => 1,
                    ],
                    'services' => [],
                    'total' => $total,
                ],
                'product' => [
                    'id' => $product->id,
                    'name' => $product->name,
                    'destination' => $product->destination->name,
                    'category' => $product->category->name,
                    'typology' => $product->typology->name,
                ],
            ],
            'payment_method' => $payment_method,
            'payment_status' => $payment_method === 'online' ? 'paid' : 'unpaid',
            'paid_at' => $payment_method === 'online' ? now() : null,
            'total' => $total,
            'status' => 'to_approve',
            'approval_deadline' => now()->addHours(env('APPROVAL_DEADLINE_HOURS', 24))
        ];
    }
}
