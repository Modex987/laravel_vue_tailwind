<?php

namespace Database\Factories;

use Carbon\Carbon;
use App\Models\Contact;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContactFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Contact::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'fname' => $this->faker->firstName(),
            'lname' => $this->faker->lastName(),
            'dob' => $this->faker->date('d-m-Y', Carbon::create(1999, 12, 28)),
            'address' => $this->faker->address,
            'phone' => strval($this->faker->numberBetween(100000000, 999999999))
        ];
    }
}