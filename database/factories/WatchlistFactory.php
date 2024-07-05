<?php

namespace Database\Factories;

use App\Models\{User, MediaType};
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Watchlist>
 */
class WatchlistFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'link' => fake()->url(),
            'rate' => fake()->numberBetween(1, 10),
            'image' => fake()->imageUrl(),
            'watched' => fake()->boolean(),
            'tmdb_id' => fake()->randomDigit(),
            'user_id' => User::factory()->create(),
            'media_type_id' => MediaType::factory()->create(),
        ];
    }
}
