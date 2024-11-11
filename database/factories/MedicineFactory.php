<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Medicine>
 */
class MedicineFactory extends Factory
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
            'user_id' => 1,
            'name' => fake()->randomElement([
                'Panadol',
                'Promaag',
                'Insulin',
            ]),
            'amount' => fake()->numberBetween(1, 3),
            'type' => fake()->randomElement([
                'Kapsul',
                'Pil',
                'Dosis',
            ]),
            'notes' => 'note',
        ];
    }
}
