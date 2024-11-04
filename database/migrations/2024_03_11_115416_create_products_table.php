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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\User::class);
            $table->foreignIdFor(\App\Models\Destination::class)->nullable();
            $table->foreignIdFor(\App\Models\Category::class)->nullable();
            $table->foreignIdFor(\App\Models\Typology::class)->nullable();
            $table->string('name')->nullable();
            $table->string('slug')->nullable();
            $table->text('description')->nullable();
            $table->enum('cancellation', array_keys(config('tripsytour.cancellations')))->nullable();
            $table->integer('duration')->nullable();
            $table->enum('difficulty', array_keys(config('tripsytour.difficulties')))->nullable();
            $table->boolean('pets_allowed')->nullable();
            $table->boolean('accessibility')->nullable();
            $table->json('reception_staff')->nullable();
            $table->text('meeting_point')->nullable();
            $table->json('meeting_point_coords')->nullable();
            $table->json('keywords')->nullable();
            $table->json('not_suitable')->nullable();
            $table->json('not_allowed')->nullable();
            $table->json('mandatory_items')->nullable();
            $table->text('preliminary_informations')->nullable();
            $table->string('contact')->nullable();
            $table->enum('booking_type', array_keys(config('tripsytour.product.booking_types')))->nullable();
            $table->string('payment_type')->nullable();
            $table->enum('status', array_keys(config('tripsytour.product.statuses')))->default('draft');
            $table->integer('current_step')->default(1);
            $table->integer('temporary_step')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
