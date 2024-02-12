<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'content' => fake()->paragraph(1),
            'post_id' => fake()->numberBetween(1, 4),
            'user_id' => fake()->numberBetween(1, 3),
            'status' => fake()->numberBetween(0, 2),
            'created_at' => fake()->dateTime(),
            'updated_at' => fake()->dateTime(),
        ];
    }
}
