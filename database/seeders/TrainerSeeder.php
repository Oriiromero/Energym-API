<?php

namespace Database\Seeders;

use App\Models\Trainer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TrainerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        echo "Seeding 6 trainers\n";

        Trainer::factory()
        ->count(6)
        ->create();

        $count = Trainer::count();
        echo "Total trainers in DB: $count\n";
    }
}
