<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;


class TrainerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'speciality' => $this->faker->randomElement(['yoga', 'biking', 'zumba', 'pilates', 'boxing', 'hiit']),
            'availability' => $this->faker->dateTimeBetween('+1 week', '+8 week')
        ];
    }
}
