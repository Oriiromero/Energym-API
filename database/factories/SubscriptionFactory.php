<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Subscription>
 */
class SubscriptionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'price' => $this->faker->randomElement([23, 47, 168]),
            'name' => $this->faker->randomElement(['Basic', 'Plus', 'My big goal!']),
            'member_id' => User::inRandomOrder()->first()->id,
            'sub_type' => $this->faker->randomElement(['month', 'year']),
            'start_date' => $this->faker->dateTime(),
            'end_date' => $this->faker->dateTime(),
            'status' => $this->faker->randomElement(['active', 'cancelled', 'expired']),
        ];
    }
}
