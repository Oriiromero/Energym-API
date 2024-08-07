<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AuditLog>
 */
class AuditLogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::inRandomOrder()->first()->id,
            'action' => $this->faker->randomElement(['create', 'update', 'delete']),
            'target_table' => $this->faker->randomElement(['users', 'trainers', 'bookings', 'payments', 'subscriptions', 'activities']),
            'target_id' => $this->faker->randomNumber(),
        ];
    }
}
