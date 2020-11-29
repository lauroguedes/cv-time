<?php

namespace Database\Factories;

use App\Models\Profile;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProfileFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Profile::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'city_uf' => $this->faker->city . ' - ' . $this->faker->state,
            'phone' => $this->faker->tollFreePhoneNumber,
            'date_birth' => now()->parse(rand(1988,2000) . '-' . rand(1,12) . '-' . rand(1,20)),
            'about_me' => $this->faker->sentence(),
            'hobbies' => $this->faker->words(3, true),
        ];
    }
}
