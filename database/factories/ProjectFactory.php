<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'place' => fake()->city(),
            'start_date' => fake()->dateTimeBetween($startDate = 'now', $endDate = '+1 week')->format('Y-m-d'),
            'due_date' => fake()->dateTimeBetween($startDate = 'now', $endDate = '+1 week')->format('Y-m-d'),
            'total_value' => fake()->randomFloat(2, 5, 150),

            'user_id' => fake()->numberBetween(1, 5)
        ];
    }
}
