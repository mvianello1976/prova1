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
        Schema::create('cart_items', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Cart::class);
            $table->foreignIdFor(\App\Models\Product::class)->nullable();
            $table->foreignIdFor(\App\Models\GiftCard::class)->nullable();
            $table->foreignIdFor(\App\Models\AvailabilityTime::class)->nullable();
            $table->integer('adults')->default(0);
            $table->integer('kids')->default(0);
            $table->integer('children')->default(0);
            $table->json('services')->nullable();
            $table->json('coupon')->nullable();
            $table->boolean('gift')->default(false);
            $table->string('receiver_name')->nullable();
            $table->string('receiver_email')->nullable();
            $table->string('receiver_message')->nullable();
            $table->double('to_pay')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cart_items');
    }
};
