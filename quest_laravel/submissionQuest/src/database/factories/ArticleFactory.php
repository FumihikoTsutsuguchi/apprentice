<?php

namespace Database\Factories;

use App\Models\Article;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => fake()->title(),
            'description' => fake()->unique()->realText(15),
            'body' => fake()->unique()->realText(100),
            'user_id' => \App\Models\User::factory(), // ランダムなユーザーを関連付ける
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Article $article) {
            $tags = Tag::factory(rand(1, 3))->create();
            $article->tags()->attach($tags);
        });
    }
}
