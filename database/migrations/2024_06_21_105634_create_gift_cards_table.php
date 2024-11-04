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
        Schema::create('gift_cards', function (Blueprint $table) {
            $table->id();
            $table->integer('value')->unique();
            $table->timestamps();
        });

        Schema::create('gift_card_user', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\GiftCard::class);
            $table->foreignIdFor(\App\Models\User::class)->nullable();
            $table->foreignIdFor(\App\Models\User::class, 'gift_from');
            $table->uuid('redeem_code')->unique();
            $table->boolean('redeemed')->default(false);
            $table->timestamp('redeemed_at')->nullable();
            $table->date('activation_deadline')->nullable();
            //            $table->timestamp('expiration_on')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gift_cards');
        Schema::dropIfExists('gift_card_user');
    }
};
