<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('availability_times', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\AvailabilityDate::class);
            $table->date('date');
            $table->time('time');
            $table->integer('max');
            $table->integer('booked')->default(0);
            $table->integer('sold')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('availability_times');
    }
};
