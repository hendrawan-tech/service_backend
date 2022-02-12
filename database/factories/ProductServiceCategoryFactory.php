<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\ProductServiceCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductServiceCategoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ProductServiceCategory::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
        ];
    }
}
