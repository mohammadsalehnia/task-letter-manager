<?php

namespace Modules\Task\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Task\App\Enums\TaskStatus;

class TaskFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = \Modules\Task\App\Models\Task::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'title' => fake()->name,
            'description' => fake()->text,
            'status' => fake()->randomElement([
                1,
                2,
                3,
            ]),
        ];
    }
}

