<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
         \App\Models\User::factory()->create([
             'name' => 'admin',
             'email' => 'admin@mail.com',
             'password' => bcrypt('123Admin'),
             'is_admin' => 1,
         ]);

        $this->call(CategorySeeder::class);
        $this->call(TagSeeder::class);
        $this->call(PostSeeder::class);

        $tags = \App\Models\Tag::all();
        \App\Models\Post::all()->each(function ($post) use ($tags) {
            $post->tags()->attach(
                $tags->random(rand(1, 4))->pluck('id')->toArray()
            );
        });

        for($i = 1; $i < 4; $i++) {
            \App\Models\Advert::factory()->create([
                'title' => fake()->words(1, true),
                'description' => fake()->words(3, true),
                'link' => $i == 3 ? null : fake()->url(),
                'block' => $i,
                'status' => 1,
                'created_at' => fake()->dateTime(),
                'updated_at' => fake()->dateTime(),
            ]);
        }

        for($i = 1; $i < 5; $i++) {
            \App\Models\Comment::factory()->create([
                'content' => fake()->paragraph(1),
                'post_id' => $i < 4 ? 1 : 2,
                'user_id' => 1,
                'status' => 1,
                'created_at' => fake()->dateTime(),
                'updated_at' => fake()->dateTime(),
            ]);
        }
    }
}
