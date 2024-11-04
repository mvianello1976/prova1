<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $included_services = Service::factory(3)->included()->create([
            'product_id' => 1
        ]);
        $extra_services = Service::factory(2)->extra()->create([
            'product_id' => 1
        ]);
    }
}
