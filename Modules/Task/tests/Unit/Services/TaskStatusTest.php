<?php

namespace Modules\Task\tests\Unit\Services;

use Modules\Task\App\Models\Task;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TaskStatusTest extends TestCase
{
    /**
     *
     * @return void
     */
    public function testTransitionTodoStatusToDoing(): void
    {
        $task = Task::factory()->todo()->create();
        $task->doing();
        $this->assertEquals($task->status, Task::STATUS_DOING);
    }

    /**
     *
     * @return void
     */
    public function testTransitionTodoStatusToDone(): void
    {
        $task = Task::factory()->todo()->create();
        $task->done();
        $this->assertEquals($task->status, Task::STATUS_DONE);
    }

    /**
     *
     * @return void
     */
    public function testTransitionDoingStatusToTodo(): void
    {
        $task = Task::factory()->doing()->create();
        $task->todo();
        $this->assertEquals($task->status, Task::STATUS_TODO);
    }

    /**
     *
     * @return void
     */
    public function testTransitionDoingStatusToDone(): void
    {
        $task = Task::factory()->doing()->create();
        $task->done();
        $this->assertEquals($task->status, Task::STATUS_DONE);
    }

    /**
     *
     * @return void
     */
    public function testTransitionDoneStatusToDoing(): void
    {
        $task = Task::factory()->done()->create();
        $task->doing();
        $this->assertEquals($task->status, Task::STATUS_DOING);
    }


    /**
     *
     * @return void
     */
    public function testTransitionDoneStatusToTodo(): void
    {
        $task = Task::factory()->done()->create();
        $task->todo();
        $this->assertEquals($task->status, Task::STATUS_TODO);
    }
}
