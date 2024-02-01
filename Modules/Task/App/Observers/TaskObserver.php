<?php

namespace Modules\Task\App\Observers;

use Modules\Task\App\Models\Task;
use Modules\Task\App\Services\statues\DoingStatus;
use Modules\Task\App\Services\statues\DoneStatus;
use Modules\Task\App\Services\statues\TodoStatus;

class TaskObserver
{
    /**
     * Handle the Task "created" event.
     */
    public function created(Task $task): void
    {
        if ($task->status === Task::STATUS_TODO) {
            $task->transitionTo(new TodoStatus());
        } elseif ($task->status === Task::STATUS_DOING) {
            $task->transitionTo(new DoingStatus());
        } elseif ($task->status === Task::STATUS_DONE) {
            $task->transitionTo(new DoneStatus());
        }
    }

    /**
     * Handle the Task "updated" event.
     */
    public function updated(Task $task): void
    {
        if ($task->status === Task::STATUS_TODO) {
            $task->transitionTo(new TodoStatus());
        } elseif ($task->status === Task::STATUS_DOING) {
            $task->transitionTo(new DoingStatus());
        } elseif ($task->status === Task::STATUS_DONE) {
            $task->transitionTo(new DoneStatus());
        }
    }

    public function retrieved(Task $task): void
    {
        if ($task->status === Task::STATUS_TODO) {
            $task->transitionTo(new TodoStatus());
        } elseif ($task->status === Task::STATUS_DOING) {
            $task->transitionTo(new DoingStatus());
        } elseif ($task->status === Task::STATUS_DONE) {
            $task->transitionTo(new DoneStatus());
        }
    }

    /**
     * Handle the Task "deleted" event.
     */
    public function deleted(Task $task): void
    {
        //
    }

    /**
     * Handle the Task "restored" event.
     */
    public function restored(Task $task): void
    {
        //
    }

    /**
     * Handle the Task "force deleted" event.
     */
    public function forceDeleted(Task $task): void
    {
        //
    }
}
