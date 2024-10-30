<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('user_profiles')->insert([
            'user_id' => 1,
            'firstname' => 'Admin',
            'lastname' => 'Gacor',
            'weight' => 75.5,
            'height' => 180,
            'age' => 36,
            'DOB' => '1987-05-10',
            'gender' => 'male',
            'is_descendant_diabetes' => false,
            'is_diabetes' => false,
            'medical_history' => 'No major illnesses',
            'diabetes_type' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
