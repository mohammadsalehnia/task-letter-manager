<?php

namespace Modules\Letter\Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class LetterFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = \Modules\Letter\App\Models\Letter::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'title' => fake()->title,
            'body' => fake()->text,
            'user_id' => User::factory()->create(),
        ];
    }
}
