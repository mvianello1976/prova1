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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->uuid();
            $table->foreignIdFor(\App\Models\Cart::class)->nullable();
            $table->foreignIdFor(\App\Models\User::class);
            $table->foreignIdFor(\App\Models\User::class, 'partner_id');
            $table->json('data');
            $table->string('payment_method');
            $table->string('payment_status');
            $table->timestamp('paid_at')->nullable();
            $table->date('canceled_at')->nullable();
            $table->text('canceled_reason')->nullable();
            $table->double('total');
            $table->double('used_balance')->default(0);
            $table->boolean('has_deposit')->default(false);
            $table->double('deposit')->default(0);
            $table->json('coupon')->nullable();
            $table->double('coupon_value')->nullable();
            $table->string('status')->default('to_approve');
            $table->timestamp('approval_deadline')->nullable();
            $table->boolean('is_gift')->default(false);
            $table->foreignIdFor(\App\Models\User::class, 'gift_from')->nullable();
            $table->json('gift_data')->nullable();
            $table->uuid('redeem_code')->nullable();
            $table->boolean('redeemed')->default(false);
            $table->date('redeemed_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
