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

        Country::limit(5)->get()->each(function ($country) {

            $user = User::factory()->create();

            Todo::factory()->count(3)->for($user)->create();

            Contact::factory()->for($user)->for($country)->create();
        });
    }
}