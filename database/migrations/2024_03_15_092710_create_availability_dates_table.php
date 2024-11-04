<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('availability_dates', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Availability::class);
            $table->double('adults_price')->nullable();
            $table->double('kids_price')->nullable();
            $table->double('children_price')->nullable();
            $table->date('date_start');
            $table->date('date_end');
            $table->time('time_start');
            $table->time('time_end');
            $table->enum('step', config('tripsytour.product.availabilities.steps'));
            $table->integer('vehicles_per_slot')->nullable();
            $table->integer('participants_per_vehicle')->nullable();
            $table->double('rental_total_price')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('availability_dates');
    }
};
