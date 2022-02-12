<?php

namespace Database\Factories;

use App\Models\Timeline;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class TimelineFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Timeline::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'message' => $this->faker->text(255),
            'service_id' => \App\Models\Service::factory(),
        ];
    }
}
