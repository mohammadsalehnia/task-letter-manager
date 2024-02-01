<?php

namespace Modules\Task\App\Services\statues;

use Illuminate\Support\Facades\Log;
use Modules\Task\App\Models\Task;
use Modules\Task\App\Services\TaskStatus;

class DoingStatus extends TaskStatus
{

    public function todo(): void
    {
        if ($this->task !== null) {
            Log::info('DoingStatus: doing to todo');
            $this->task->update(['status' => Task::STATUS_TODO]);
        }
    }

    public function doing(): void
    {
        if ($this->task !== null) {
            Log::info('DoingStatus: doing to doing');
            $this->task->update(['status' => Task::STATUS_DOING]);
        }
    }

    public function done(): void
    {
        if ($this->task !== null) {
            Log::info('DoingStatus: doing to done');
            $this->task->update(['status' => Task::STATUS_DONE]);
        }
    }

    public function getStatus(): int
    {
        return Task::STATUS_DOING;
    }
}
