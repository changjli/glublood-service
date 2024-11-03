<?php

namespace Database\Seeders;

use App\Models\FoodLog;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FoodLogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        FoodLog::factory()
            ->count(100)
            ->create();
    }
}
