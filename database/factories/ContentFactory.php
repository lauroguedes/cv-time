<?php

namespace Database\Factories;

use App\Models\Content;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Content::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $date = now()->parse(rand(1988,2000) . '-' . rand(1,12) . '-' . rand(1,20));
        return [
            'title' => $this->faker->sentence(3),
            'start_date' => $date,
            'end_date' => $date->addYears(2),
            'description' => $this->faker->paragraph()
        ];
    }
}
