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
        Schema::create('user_informations', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\User::class);
            $table->enum('partner_type', array_keys(config('tripsytour.partner.onboarding.partner_type')))->nullable();
            $table->enum('company_employees', array_keys(config('tripsytour.partner.onboarding.company_employees')))->nullable();
            $table->enum('activities_provided', array_keys(config('tripsytour.partner.onboarding.activities_provided')))->nullable();
            $table->json('activities_locations')->nullable();
            $table->boolean('activities_use_external_cms')->default(false);
            $table->enum('activities_external_cms', array_keys(config('tripsytour.partner.onboarding.activities_external_cms')))->nullable();

            $table->string('company_name')->nullable();
            $table->string('business_name')->nullable();
            $table->string('vat_number')->nullable();
            $table->string('head_office_address')->nullable();
            $table->string('pec')->nullable();
            $table->string('sdi')->nullable();
            $table->string('company_link')->nullable();
            $table->foreignIdFor(\App\Models\Country::class)->nullable();
            $table->string('currency')->nullable();
            $table->string('contact_first_name')->nullable();
            $table->string('contact_last_name')->nullable();
            $table->boolean('terms')->default(false);

            $table->string('registration_number')->nullable();
            $table->string('liability_insurance')->nullable();
            $table->string('company_logo')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('bank_account_holder')->nullable();
            $table->string('bank_iban')->nullable();
            $table->string('bank_bic')->nullable();

            $table->boolean('customer_questions_notifications')->default(false);
            $table->boolean('bookings_notifications')->default(false);
            $table->boolean('accountings_notifications')->default(false);
            $table->boolean('reviews_notifications')->default(false);

            $table->enum('payment_frequencies', array_keys(config('tripsytour.partner.onboarding.activities_external_cms')))->nullable();
            $table->double('commission_percentage')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_informations');
    }
};
