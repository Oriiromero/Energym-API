<?php

namespace Database\Seeders;

use App\Models\Payment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        echo "Seeding 10 payments\n";

        Payment::factory()
        ->count(10)
        ->create();

        $count = Payment::count();
        echo "Total payments in DB: $count\n";
    }
}
