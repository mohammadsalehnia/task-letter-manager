<?php

namespace Modules\Task\App\Services;

use Illuminate\Database\Eloquent\Model;
use Modules\Task\App\Repositories\TaskRepository;

class TaskService
{
    protected TaskRepository $taskRepository;

    public function __construct(TaskRepository $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }

    public function save($data): Model
    {
        return $this->taskRepository->create($data);
    }

    public function update(int $taskId, array $data): bool
    {
        $task = $this->taskRepository->findById($taskId);
        return $this->taskRepository->update($task, $data);
    }

    public function updateStatus(int $taskId, int $status): bool
    {
        $task = $this->taskRepository->findById($taskId);
        if (!$task) {
            return false;
        }

        $task->update(['status' => $status]);

        return true;
    }


}
