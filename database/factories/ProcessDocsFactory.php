<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProcessDocs>
 */
class ProcessDocsFactory extends Factory
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
            'value' => fake()->randomFloat(2, 5, 150),
            'url' => fake()->imageUrl(250, 250),

            'process_id' => fake()->numberBetween(1, 5),
            'type_docs_id' => fake()->numberBetween(1, 5)
        ];
    }
}
