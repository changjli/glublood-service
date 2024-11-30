<?php

namespace Database\Seeders;

use App\Models\ExerciseLog;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ExerciseLogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ExerciseLog::factory()
            ->count(100)
            ->create();
    }
}
