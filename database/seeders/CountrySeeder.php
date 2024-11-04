<?php

namespace Database\Seeders;

use App\Models\Country;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /**
         * Retrive a complete dataset of world countries
         * Filters: name, cca2 (alpha iso 2), cca3 (alpha iso 3), ccn3 (numeric iso), currencies
         *
         * Example:
         *
         *   {
         *       "name": {
         *           "common": "Italy",
         *           "official": "Italian Republic",
         *           "nativeName": {
         *               "ita": {
         *                   "official": "Repubblica italiana",
         *                   "common": "Italia"
         *               }
         *           }
         *       },
         *       "cca2": "IT",
         *       "ccn3": "380",
         *       "cca3": "ITA",
         *       "currencies": {
         *           "EUR": {
         *              "name": "Euro",
         *               "symbol": "€"
         *           }
         *       },
         *   }
         *
         * @link  https://restcountries.com/
        */
        //$countriesData = Http::get('https://restcountries.com/v3.1/all?fields=name,cca2,cca3,ccn3,currencies')->collect();

        // fallback data
        $countriesData = json_decode(file_get_contents(__DIR__ . '/countries.json'), true);

        $insertData = [];
        foreach ($countriesData as $country) {
            $insertData[] = [
                'name'            => $country['name']['common'],
                'iso2_code'       => $country['cca2'],
                'iso3_code'       => $country['cca3'],
                'numeric_code'    => str_pad($country['ccn3'], 3, '0', STR_PAD_LEFT),
                'currency_code'   => $country['currencies'] ? array_key_first($country['currencies']) : 'EUR',
                'currency_name'   => $country['currencies'] ? $country['currencies'][array_key_first($country['currencies'])]['name'] : 'Euro',
                'currency_symbol' => $country['currencies'] ? $country['currencies'][array_key_first($country['currencies'])]['symbol'] : '€',
            ];
        }

        usort($insertData, function($a, $b) {
            return strcmp($a['name'], $b['name']);
        });

        DB::table('countries')->insert($insertData);
    }
}
