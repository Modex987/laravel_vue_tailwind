<?php

use App\Models\Company;
use App\Models\Customer;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');




Artisan::command('contact:company-clean', function () {

    $this->info('Cleaning Unused Companies...');

    Company::whereDoesntHave('customers')
        ->get()
        ->each(function ($company) {
            $company->delete();
            $this->warn($company->name . ' Company Has Been Deleted');
        });
})->describe('cleans\'up unused Companies');



Artisan::command('customers:populate', function () {
    $this->info('Customers Are Being created');

    Company::all()->each(function ($company) {
        Customer::factory()
            ->count(3)
            ->for($company)
            ->create();
    });
})->describe('create randome customers');