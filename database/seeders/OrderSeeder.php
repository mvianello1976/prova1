<?php

namespace Database\Seeders;

use App\Models\AvailabilityTime;
use App\Models\Order;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $availability_time = AvailabilityTime::all()->shuffle()->first();
        $order = Order::factory()->create([
            'user_id' => User::find(2)->id,
            'partner_id' => User::find(3)->id,
            'data->booking->date' => $availability_time->date,
            'data->booking->time' => $availability_time->time,
            'data->booking->availability_time_id' => $availability_time->id,
        ]);
        $availability_time->increment('sold');
    }
}
