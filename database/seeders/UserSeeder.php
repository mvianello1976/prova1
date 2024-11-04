<?php

namespace Database\Seeders;

use App\Models\Country;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Administrator
        $admin = User::factory()->create([
            'first_name' => 'Administrator',
            'last_name' => null,
            'email' => 'admin@example.test',
        ]);
        $admin->assignRole('administrator');

        // Client
        $client = User::factory()->create([
            'first_name' => 'Client',
            'last_name' => 'Test',
            'email' => 'client@example.test',
            'mobile' => fake()->phoneNumber(),
            'country_id' => Country::where('iso2_code', 'IT')->first(),
        ]);
        $client->assignRole('client');

        // Partner
        $partner = User::factory()->create([
            'first_name' => 'Partner',
            'last_name' => 'Test',
            'email' => 'partner@example.test',
            'email_verified_at' => now(),
            'onboarding_current_step' => 3,
        ]);
        $partner->informations()->create([
            'partner_type' => 'company',
            'company_employees' => '1-3',
            'activities_provided' => '3-6',
            'activities_locations' => ['Roma'],
            'activities_use_external_cms' => false,
            'company_name' => 'ACME Srl',
            'business_name' => 'ACME Srl',
            'vat_number' => fake()->numerify('IT###########'),
            'head_office_address' => fake()->streetAddress(),
            'pec' => fake()->safeEmail(),
            'country_id' => Country::where('iso2_code', 'it')->first()->id,
            'currency' => 'eur',
            'contact_first_name' => fake()->firstName(),
            'contact_last_name' => fake()->lastName(),
            'terms' => true,
        ]);
        $partner->assignRole('partner');

        // Clients
        $clients = User::factory(9)->create();
        $clients->each(function ($client) {
            $client->assignRole('client');
        });
    }
}
