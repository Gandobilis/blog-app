<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Post;
use App\Models\User;

class PostFactory extends Factory
{
    protected $model = Post::class;

    public function definition(): array
    {
        $user = User::inRandomOrder()->first() ?? User::create();

        return [
            'title' => $this->faker->sentence,
            'content' => $this->faker->paragraphs(3, true),
            'excerpt' => $this->faker->sentence,
            'user_id' => $user->id,
        ];
    }
}
