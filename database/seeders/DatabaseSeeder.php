<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        echo "Running DatabaseSeeder\n";


        $this->call([
            UserSeeder::class,
            TrainerSeeder::class,
            SubscriptionSeeder::class,
            PaymentSeeder::class,
            AuditLogSeeder::class,
            ActivitySeeder::class,
            BookingSeeder::class,
        ]);

        echo "DatabaseSeeder completed\n";
    }

}
