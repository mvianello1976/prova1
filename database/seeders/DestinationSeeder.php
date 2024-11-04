<?php

namespace Database\Seeders;

use App\Models\Destination;
use Illuminate\Database\Seeder;

class DestinationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Destination::factory()->create([
            'name' => 'Venezia',
            'slug' => 'venezia',
            'province' => 'VE',
            'country' => 'IT',
            'latitude' => '45.4408474',
            'longitude' => '12.3155151',
        ]);
        //        $destinations = Destination::factory(10)->create();
    }
}
