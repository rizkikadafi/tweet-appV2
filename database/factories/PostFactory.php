<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
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

        $parentPostId = null;

        if (Post::count() > 0 && $this->faker->boolean(50)) {
            $parentPostId = Post::inRandomOrder()->first()->id;
        }
        return [
            'user_id' => User::factory(),
            'parent_id' => $parentPostId,
            'title' => fake()->sentence(),
            'content' => fake()->text(),
        ];
    }
}
