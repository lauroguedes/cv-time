<?php

namespace Database\Factories;

use App\Models\Education;
use Illuminate\Database\Eloquent\Factories\Factory;

class EducationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Education::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $date = now()->parse(rand(1988,2000) . '-' . rand(1,12) . '-' . rand(1,20));
        return [
            'college' => $this->faker->sentence(3),
            'start_date' => $date,
            'end_date' => $date->addYears(2),
            'course' => $this->faker->sentence(2),
            'situation' => $this->faker->numberBetween(0,2),
            'description' => $this->faker->paragraph(),
        ];
    }
}
