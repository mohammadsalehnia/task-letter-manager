<?php

namespace Modules\Task\tests\Unit\Repositories;

use Illuminate\Pagination\LengthAwarePaginator;
use Modules\Task\App\Models\Task;
use Modules\Task\App\Repositories\TaskRepository;
use Tests\TestCase;

class TaskRepositoryTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function testCreateMethod(): void
    {
        $repository = $this->app->make(TaskRepository::class);
        $data = [
            'title' => 'title',
            'description' => 'description',
        ];

        $result = $repository->create($data);

        $this->assertSame($data['title'], $result->title);
    }

    public function testUpdateMethod(): void
    {
        $repository = $this->app->make(TaskRepository::class);
        $task = Task::factory()->create();
        $data = [
            'title' => 'new title',
            'description' => 'new description',
        ];

        $repository->update($task, $data);

        $this->assertSame($data['title'], Task::find($task->id)->title);
    }

    public function testDeleteMethod(): void
    {
        $repository = $this->app->make(TaskRepository::class);
        $task = Task::factory()->create();

        $repository->delete($task->id);

        $this->assertDatabaseMissing('tasks', $task->toArray());
    }

    public function testPaginateMethod(): void
    {
        $repository = $this->app->make(TaskRepository::class);
        $count = rand(1, 50);
        Task::factory()->count($count)->create();

        $result = $repository->paginate(10);

        $this->assertInstanceOf(LengthAwarePaginator::class, $result);
        $this->assertEquals(10, $result->perPage());
    }
}
