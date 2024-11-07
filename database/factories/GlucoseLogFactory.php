<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\GlucoseLog>
 */
class GlucoseLogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'date' => fake()->dateTimeBetween('-1 month', 'now')->format('Y-m-d'),
            'time' => fake()->dateTimeBetween('today 06:00', 'today 24:00')->format('H:i:s'),
            'glucose_rate' => fake()->numberBetween(1, 200),
            'user_id' => 1,
            'time_selection' => fake()->randomElement([
                'Sebelum makan',
                'Sesudah makan',
                'Sebelum tidur',
                'Sesudah tidur',
            ]),
            'notes' => 'notes',
        ];
    }
}
