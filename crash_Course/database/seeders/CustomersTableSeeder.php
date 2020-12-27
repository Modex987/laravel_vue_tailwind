<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\Company;
use Illuminate\Database\Seeder;

class CustomersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Customer::factory()
        //     ->count(7)
        //     ->for(Company::factory()->create())
        //     ->create();

        Company::all()->each(function ($company) {
            Customer::factory()
                ->count(5)
                ->for($company)
                ->create();
        });
    }
}