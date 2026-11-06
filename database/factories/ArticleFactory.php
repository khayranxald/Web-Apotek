<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ArticleFactory extends Factory
{
    public function definition(): array
    {
        $title = ucfirst($this->faker->sentence(6));

        return [
            'title' => $title,
            'slug' => Str::slug($title) . '-' . Str::random(5),
            'excerpt' => $this->faker->sentence(20),
            'content' => collect($this->faker->paragraphs(5))->map(fn ($p) => "<p>{$p}</p>")->implode(''),
            'cover_image' => null,
            'author_id' => User::role(['pharmacist', 'admin', 'super_admin'])->inRandomOrder()->first()?->id,
            'status' => 'published',
            'published_at' => now()->subDays(rand(0, 30)),
        ];
    }
}