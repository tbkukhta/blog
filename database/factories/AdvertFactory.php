<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class AdvertFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->words(1, true),
            'description' => fake()->words(3, true),
            'link' => fake()->url(),
            'block' => fake()->numberBetween(1, 3),
            'status' => fake()->numberBetween(0, 1),
            'created_at' => fake()->dateTime(),
            'updated_at' => fake()->dateTime(),
        ];
    }
}
