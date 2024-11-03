<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\FoodLog>
 */
class FoodLogFactory extends Factory
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
            'type' => fake()->randomElement(['manual', 'auto', 'barcode']),
            'user_id' => 1,
            'food_name' => fake()->randomElement([
                'Ketoprak',
                'Telur Rebus',
                'Nasi Goreng',
                'Sate Ayam',
                'Mie Ayam',
                'Soto Betawi',
                'Gado-Gado',
                'Kentang Goreng',
                'Burger',
                'Salad',
            ]),
            'calories' => fake()->randomFloat(2, 1, 1000),
            'protein' => fake()->randomFloat(2, 1, 500),
            'carbohydrate' => fake()->randomFloat(2, 1, 500),
            'fat' => fake()->randomFloat(2, 1, 500),
            'serving_qty' => fake()->numberBetween(1, 5),
            'serving_size' => fake()->randomElement([
                'Piring',
                'Porsi',
            ]),
        ];
    }
}
