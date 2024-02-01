<?php

namespace Modules\Task\Database\Factories;

use App\Models\Tournament;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Task\App\Enums\TaskStatus;
use Modules\Task\App\Models\Task;

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
                Task::STATUS_TODO,
                Task::STATUS_DOING,
                Task::STATUS_DONE,
            ]),
        ];
    }


    /**
     * Indicate that the model's status should be STATUS_TODO.
     *
     * @return static
     */
    public function todo(): static
    {
        return $this->state(fn(array $attributes) => [
            'status' => Task::STATUS_TODO,
        ]);
    }

    /**
     * Indicate that the model's status should be STATUS_DOING.
     *
     * @return static
     */
    public function doing(): static
    {
        return $this->state(fn(array $attributes) => [
            'status' => Task::STATUS_DOING,
        ]);
    }

    /**
     * Indicate that the model's status should be STATUS_DONE.
     *
     * @return static
     */
    public function done(): static
    {
        return $this->state(fn(array $attributes) => [
            'status' => Task::STATUS_DONE,
        ]);
    }
}

