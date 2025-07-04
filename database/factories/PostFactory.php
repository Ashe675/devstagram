<?php

namespace Database\Factories;

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
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(),
            'description' => $this->faker->paragraph(),
            'image' => $this->faker->uuid() . '.jpg',
            // 'user_id' => \App\Models\User::factory()->create()->id,
            'user_id' => $this->faker->numberBetween(1, 10), // Assuming user IDs are between 1 and 10
        ];
    }
}
