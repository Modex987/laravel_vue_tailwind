<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Seeder;

class CountriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $countries = file_get_contents('https://restcountries.eu/rest/v2/all');

        $countries = collect(json_decode($countries));

        $countries->each(function ($country) {

            $name = $country->name;
            $countryCode = $country->alpha3Code;
            $callingCode1 = $country->callingCodes[0];
            $callingCode2 = array_key_exists(1, $country->callingCodes) ? $country->callingCodes[1] : null;

            Country::create(compact('name', 'callingCode1', 'callingCode2', 'countryCode'));
        });
    }
}