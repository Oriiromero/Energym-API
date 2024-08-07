<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        echo "Seeding 15 + 1 users";

        User::factory()->create([
            'name' => 'Admin user',
            'email' => 'test@example.com',
            'role' => 'admin',
            'password' => 'admin1234'
        ]);

        User::factory()
        ->count(15)
        ->create();

        $count = User::count();
        echo "Total Users in DB: $count\n";
    }
}
