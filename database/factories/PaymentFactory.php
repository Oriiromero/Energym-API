<?php

namespace Database\Factories;

use App\Models\Subscription;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Payment>
 */
class PaymentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'member_id' => User::inRandomOrder()->first()->id,
            'subscription_id' => Subscription::inRandomOrder()->first()->id,
            'amount' => $this->faker->randomElement([23, 47, 168]),
            'payment_method' => $this->faker->creditCardType(),
            'payment_status' => $this->faker->randomElement(['completed', 'cancelled', 'pending'])
        ];
    }
}
