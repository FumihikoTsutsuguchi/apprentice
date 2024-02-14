<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'article_id' => \App\Models\Article::factory(),
            'body' => fake()->unique()->realText(50),
            'user_id' => \App\Models\User::factory(), // ランダムなユーザーを関連付ける
        ];
    }
}
