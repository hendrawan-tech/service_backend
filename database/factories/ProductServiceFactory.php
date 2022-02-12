<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\ProductService;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductServiceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ProductService::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'code' => $this->faker->text(8),
            'name' => $this->faker->name,
            'brand' => $this->faker->text(30),
            'condition' => $this->faker->text(255),
            'attribute' => $this->faker->text(255),
            'problem' => $this->faker->text(255),
            'specification' => $this->faker->text,
            'status' => '',
            'product_category_id' => \App\Models\ProductServiceCategory::factory(),
            'user_id' => \App\Models\User::factory(),
        ];
    }
}
