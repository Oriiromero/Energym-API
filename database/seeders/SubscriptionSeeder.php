<?php

namespace Database\Seeders;

use App\Models\Subscription;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubscriptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        echo "Seeding 10 subscriptions\n";

        Subscription::factory()
        ->count(10)
        ->create();

        $count = Subscription::count();
        echo "Total subscriptions in DB: $count\n";
    }
}
