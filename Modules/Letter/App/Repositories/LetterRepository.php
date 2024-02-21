<?php

namespace Modules\Letter\App\Repositories;

use App\Repositories\Repository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Modules\Letter\App\Models\Letter;

class LetterRepository extends Repository
{
    public function model(): string
    {
        return Letter::class;
    }

    /**
     * @return mixed
     */
    public function paginate(int $paginateNumber = 10): LengthAwarePaginator
    {
        return $this->model->latest()->paginate($paginateNumber);
    }

    public function update(Letter $letter, array $data): bool
    {
        return $letter->update($data);
    }

    public function filter(array $data): Builder
    {
        return $this->model->latest()
            ->when(isset($data['title']), function ($query) use ($data) {
                $query->where('title', $data['title']);
            })
            ->when(isset($data['body']), function ($query) use ($data) {
                $query->where('body', $data['body']);
            })
            ->when(isset($data['user_id']), function ($query) use ($data) {
                $query->where('user_id', $data['user_id']);
            })
            ->when(isset($data['tasks']), function ($query) use ($data) {
                $query->whereHas('tasks', function (Builder $query) use ($data) {
                    $query->whereIn('id', $data['tasks']);
                });
            });

    }
}
