<?php

namespace Database\Factories;

use App\Models\Company;
use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;

class CustomerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Customer::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            // 'company_id' => Company::factory()->create(),
            // 'company_id' => 10,
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'status' => $this->faker->numberBetween(0, 2),
        ];
    }
}