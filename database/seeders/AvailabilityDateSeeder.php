<?php

namespace Database\Seeders;

use App\Models\AvailabilityDate;
use Carbon\CarbonPeriod;
use Illuminate\Database\Seeder;

class AvailabilityDateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Normal Availability
        $availability_date = AvailabilityDate::factory()->create([
            'availability_id' => 1,
            'step' => '60',
        ]);

        $date_period = CarbonPeriod::create($availability_date->date_start, '1 day', $availability_date->date_end);
        foreach ($date_period as $date) {
            $time_period = CarbonPeriod::create($availability_date->time_start, "$availability_date->step minutes", $availability_date->time_end);
            foreach ($time_period as $time) {
                $availability_date->times()->create([
                    'date' => $date->format('Y-m-d'),
                    'time' => $time->format('H:i'),
                    'max' => $availability_date->availability->participants,
                ]);
            }
        }

        // Rental Availability
        $availability_date = AvailabilityDate::factory()->create([
            'availability_id' => 2,
            'adults_price' => null,
            'kids_price' => null,
            'children_price' => null,
            'step' => '60',
            'vehicles_per_slot' => 4,
            'participants_per_vehicle' => 10,
            'rental_total_price' => 1000,
        ]);

        $date_period = CarbonPeriod::create($availability_date->date_start, '1 day', $availability_date->date_end);
        foreach ($date_period as $date) {
            $time_period = CarbonPeriod::create($availability_date->time_start, "$availability_date->step minutes", $availability_date->time_end);
            foreach ($time_period as $time) {
                $availability_date->times()->create([
                    'date' => $date->format('Y-m-d'),
                    'time' => $time->format('H:i'),
                    'max' => $availability_date->vehicles_per_slot,
                ]);
            }
        }
    }
}
