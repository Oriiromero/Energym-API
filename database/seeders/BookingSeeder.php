<?php

namespace Database\Seeders;

use App\Models\Booking;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        echo "Seeding 10 bookings\n";

        Booking::factory()
        ->count(10)
        ->create();

        $count = Booking::count();
        echo "Total bookings in DB: $count\n";
    }
}
