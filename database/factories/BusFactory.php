<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Bus>
 */
class BusFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'plate_number' => fake()->unique()->numerify('####') . '-' . fake()->randomLetter() . '-' . fake()->numerify('##'),
            'model' => fake()->randomElement(['Mercedes', 'Volvo', 'Isuzu', 'Ford', 'Renault', 'Scania']),
            'capacity' => fake()->numberBetween(40, 60),
            'status' => fake()->randomElement(['active', 'maintenance', 'out_of_service']),
        ];
    }
}