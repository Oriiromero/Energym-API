<?php

namespace Database\Factories;

use App\Models\Trainer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Activity>
 */
class ActivityFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'description' => $this->faker->text,
            'schedule' => $this->faker->dateTime(),
            'capacity' => $this->faker->randomNumber(2, true),
            'trainer_id' => Trainer::inRandomOrder()->first()->id,
        ];
    }
}
