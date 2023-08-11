<?php

namespace Database\Factories;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
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
    public function definition(): array
    {
        $randomUser = User::all()->random();
        $randomPost = $randomUser->posts()->inRandomOrder()->first();

        return [
            'user_id' => $randomUser->id,
            'post_id' => $randomPost->id,
            'content' => $this->faker->paragraph,
        ];
    }
}
