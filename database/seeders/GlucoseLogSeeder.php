<?php

namespace Database\Seeders;

use App\Models\GlucoseLog;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GlucoseLogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        GlucoseLog::factory()
            ->count(100)
            ->create();
    }
}
