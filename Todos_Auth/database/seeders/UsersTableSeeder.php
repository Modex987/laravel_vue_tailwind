<?php

namespace Database\Seeders;

use App\Models\Todo;
use App\Models\User;
use App\Models\Contact;
use App\Models\Country;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Country::limit(7)->get()->each(function ($country) {
            Todo::factory()->count(3)->for(
                User::factory()->for($country)->create()
            )->create();
        });


        User::limit(7)->get()->each(function ($user) {
            Contact::factory()->count(2)->for($user)->create();
        });
    }
}