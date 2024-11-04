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
        Schema::create('specials', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\User::class)->nullable();
            $table->foreignIdFor(\App\Models\Product::class)->nullable();
            $table->string('name')->nullable();
            $table->enum('type', [
                'percentage',
                'cash',
            ])->nullable();
            $table->double('percentage')->nullable();
            $table->double('adults_price')->nullable();
            $table->double('kids_price')->nullable();
            $table->double('children_price')->nullable();
            $table->double('rental_total_price')->nullable();
            $table->date('date_start')->nullable();
            $table->date('date_end')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('specials');
    }
};
