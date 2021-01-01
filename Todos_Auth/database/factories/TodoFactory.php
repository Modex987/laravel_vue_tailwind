<?php

namespace Database\Factories;

use Carbon\Carbon;
use App\Models\Todo;
use Illuminate\Database\Eloquent\Factories\Factory;

class TodoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Todo::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->text(98),
            'body' => $this->faker->text(400),
            'status' => $this->faker->boolean(70),
            'date_limit' => $this->faker->date('d-m-Y', Carbon::create(2020, 12, 28)),
        ];
    }
}