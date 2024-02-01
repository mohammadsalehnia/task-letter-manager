<?php

namespace Modules\Task\App\Services\statues;

use Illuminate\Support\Facades\Log;
use Modules\Task\App\Models\Task;
use Modules\Task\App\Services\TaskStatus;

class TodoStatus extends TaskStatus
{

    public function todo(): void
    {
        if ($this->task !== null) {
            Log::info('TodoStatus: todo to todo');
            $this->task->update(['status' => Task::STATUS_TODO]);
        }
    }

    public function doing(): void
    {
        if ($this->task !== null) {
            Log::info('TodoStatus: todo to doing');
            $this->task->update(['status' => Task::STATUS_DOING]);
        }
    }

    public function done(): void
    {
        if ($this->task !== null) {
            Log::info('TodoStatus: todo to done');
            $this->task->update(['status' => Task::STATUS_DONE]);
        }
    }

    public function getStatus(): int
    {
        return Task::STATUS_TODO;
    }
}
