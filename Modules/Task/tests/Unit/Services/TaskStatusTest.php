<?php

namespace Modules\Task\tests\Unit\Services;

use Modules\Task\App\Models\Task;
use Tests\TestCase;

class TaskStatusTest extends TestCase
{
    public function testTransitionTodoStatusToDoing(): void
    {
        $task = Task::factory()->todo()->create();
        $task->doing();
        $this->assertEquals($task->status, Task::STATUS_DOING);
    }

    public function testTransitionTodoStatusToDone(): void
    {
        $task = Task::factory()->todo()->create();
        $task->done();
        $this->assertEquals($task->status, Task::STATUS_DONE);
    }

    public function testTransitionDoingStatusToTodo(): void
    {
        $task = Task::factory()->doing()->create();
        $task->todo();
        $this->assertEquals($task->status, Task::STATUS_TODO);
    }

    public function testTransitionDoingStatusToDone(): void
    {
        $task = Task::factory()->doing()->create();
        $task->done();
        $this->assertEquals($task->status, Task::STATUS_DONE);
    }

    public function testTransitionDoneStatusToDoing(): void
    {
        $task = Task::factory()->done()->create();
        $task->doing();
        $this->assertEquals($task->status, Task::STATUS_DOING);
    }

    public function testTransitionDoneStatusToTodo(): void
    {
        $task = Task::factory()->done()->create();
        $task->todo();
        $this->assertEquals($task->status, Task::STATUS_TODO);
    }
}
