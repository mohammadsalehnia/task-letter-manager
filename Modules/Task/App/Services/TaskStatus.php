<?php

namespace Modules\Task\App\Services;

use Modules\Task\App\Models\Task;

abstract class TaskStatus
{
    protected ?Task $task = null;

    public function setTask(Task $task): void
    {
        $this->task = $task;
    }

    abstract public function todo(): void;

    abstract public function doing(): void;

    abstract public function done(): void;

    public function getStatus(): int
    {
        return Task::STATUS_TODO;
    }
}
