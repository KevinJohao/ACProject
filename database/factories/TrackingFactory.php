<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tracking>
 */
class TrackingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'date' => fake()->dateTimeBetween($startDate = 'now', $endDate = '+1 week')->format('Y-m-d'),
            'observation' => fake()->sentence(10),
            
            'assignment_id' => fake()->numberBetween(1, 5),
            'user_id' => fake()->numberBetween(1, 5)
        ];
    }
}
