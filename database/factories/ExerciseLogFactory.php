<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ExerciseLog>
 */
class ExerciseLogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'exercise_name' => fake()->randomElement([
                'Running',
                'Badminton',
                'Cycling',
                'Swimming',
                'Basketball',
                'Soccer',
            ]),
            'date' => fake()->dateTimeBetween('-1 month', 'now')->format('Y-m-d'),
            'start_time' => fake()->dateTimeBetween('today 06:00', 'today 12:00')->format('H:i:s'),
            'end_time' => fake()->dateTimeBetween('today 13:00', 'today 19:00')->format('H:i:s'),
            'burned_calories' => fake()->randomFloat(2, 1, 1000),
            'user_id' => 1,
        ];
    }
}
