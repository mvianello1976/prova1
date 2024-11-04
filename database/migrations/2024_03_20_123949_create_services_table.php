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
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Product::class);
            $table->string('type');
            $table->string('item');
            $table->json('restrictions')->nullable();
            $table->json('languages')->nullable();
            $table->double('price')->nullable();
            $table->enum('price_per', array_keys(config('tripsytour.services.price_per')))->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
