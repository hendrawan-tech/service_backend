<?php

namespace Database\Factories;

use App\Models\Orderitems;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderitemsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Orderitems::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'quantity' => $this->faker->randomNumber,
            'orders_id' => \App\Models\Orders::factory(),
            'product_id' => \App\Models\Product::factory(),
        ];
    }
}
