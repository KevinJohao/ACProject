<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => substr(fake()->sentence(3), 0, -1),
            'description' => fake()->sentence(10),
            'long_description' => fake()->text(50),
            'price' => fake()->randomFloat(2, 5, 150),

            'category_id' => fake()->numberBetween(1, 5)
        ];
    }
}
