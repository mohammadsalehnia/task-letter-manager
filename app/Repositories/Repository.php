<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Pagination\LengthAwarePaginator;
use Modules\Task\App\Models\Task;

abstract class Repository
{
    protected $model;

    public function __construct()
    {
        $this->model = app($this->model());
    }

    abstract public function model(): string;

    /**
     * @return Collection
     */
    public function all(): Collection
    {
        return $this->model->latest()->get();
    }

    public function create(array $data): Model
    {
        return $this->model->create($data);
    }

    public function delete($id): bool
    {
        return $this->model->whereId($id)->delete();
    }

    public function exists($id): bool
    {
        return $this->model->whereId($id)->exists();
    }


    /**
     * @param int $id
     * @return Model|null
     */
    public function findById(int $id): ?Task
    {
        try {
            return $this->model->findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return null;
        }
    }

}
