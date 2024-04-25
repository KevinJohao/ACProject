<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Process>
 */
class ProcessFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'vsm' => 'vsm' . substr($this->faker->randomLetter, 0, 5),
            'next_review' => fake()->dateTimeBetween($startDate = 'now', $endDate = '+1 week')->format('Y-m-d'),

            'project_id' => fake()->numberBetween(1, 5),
            'type_process_id' => fake()->numberBetween(1, 5)
        ];
    }
}
