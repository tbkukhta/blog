<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class TagFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = fake()->words(2, true);
        $slug = Str::slug($title, '-');
        return [
            'title' => $title,
            'slug' => $slug,
            'created_at' => fake()->dateTime(),
            'updated_at' => fake()->dateTime(),
        ];
    }
}
