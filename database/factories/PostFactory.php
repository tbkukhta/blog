<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = fake()->words(3, true);
        $slug = Str::slug($title, '-');
        return [
            'title' => $title,
            'slug' => $slug,
            'description' => '<p>' . fake()->paragraph(1) . '</p>',
            'content' => '<p>' . fake()->paragraph(3) . '</p>',
            'category_id' => fake()->numberBetween(1, 4),
            'views' => fake()->numberBetween(0, 10),
            'status' => 1,
            'created_at' => fake()->dateTime(),
            'updated_at' => fake()->dateTime(),
        ];
    }
}
