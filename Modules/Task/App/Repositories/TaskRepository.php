<?php

namespace Modules\Task\App\Repositories;

use App\Repositories\Repository;
use Illuminate\Pagination\LengthAwarePaginator;
use Modules\Task\App\Models\Task;

class TaskRepository extends Repository
{
    public function model(): string
    {
        return Task::class;
    }

    /**
     * @param int $paginateNumber
     * @return mixed
     */
    public function paginate(int $paginateNumber = 10): LengthAwarePaginator
    {
        return $this->model->latest()->paginate($paginateNumber);
    }

    public function update(Task $task, array $data): bool
    {
        return $task->update($data);
    }
}
