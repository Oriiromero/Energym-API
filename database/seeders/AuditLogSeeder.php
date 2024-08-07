<?php

namespace Database\Seeders;

use App\Models\AuditLog;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AuditLogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        echo "Seeding 10 auditlogs\n";

        AuditLog::factory()
        ->count(10)
        ->create();

        $count = AuditLog::count();
        echo "Total auditlogs in DB: $count\n";
    }

}
