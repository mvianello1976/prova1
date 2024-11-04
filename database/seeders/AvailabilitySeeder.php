<?php

namespace Database\Seeders;

use App\Models\Availability;
use Illuminate\Database\Seeder;

class AvailabilitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $normal_availability = Availability::factory()->create([
            'product_id' => 1,
        ]);

        $rental_availability = Availability::factory()->create([
            'product_id' => 2,
            'participants' => null,
        ]);
    }
}
