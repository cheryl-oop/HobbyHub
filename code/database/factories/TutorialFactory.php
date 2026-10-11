<?php

namespace Database\Factories;
use App\Models\Category;

use App\Models\Tutorial;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Tutorial>
 */
class TutorialFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title'       => fake()->sentence(4),
            'description' => fake()->paragraph(2),
            'video_url'   => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
            'difficulty'  => fake()->randomElement(['beginner', 'intermediate', 'advanced']),
            'category_id' => Category::inRandomOrder()->first()->id,
        ];
    }
}
