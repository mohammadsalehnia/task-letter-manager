<?php

namespace Modules\Letter\App\Repositories;

use App\Repositories\Repository;
use Illuminate\Pagination\LengthAwarePaginator;
use Modules\Letter\App\Models\Letter;

class LetterRepository extends Repository
{
    public function model(): string
    {
        return Letter::class;
    }

    /**
     * @param int $paginateNumber
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
}
