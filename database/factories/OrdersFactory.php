<?php

namespace Database\Factories;

use App\Models\Orders;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrdersFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Orders::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'price' => $this->faker->randomFloat(2, 0, 9999),
            'status' => $this->faker->word,
            'user_id' => \App\Models\User::factory(),
        ];
    }
}
