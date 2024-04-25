<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Assignment>
 */
class AssignmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'process_id' => fake()->numberBetween(1, 5),
            'activity_id' => fake()->numberBetween(1, 5),
            'user_id' => fake()->numberBetween(1, 5)
        ];
    }
}
