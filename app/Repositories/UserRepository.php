<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Collection;

class UserRepository extends Repository
{
    public function model(): string
    {
        return User::class;
    }

    public function findByEmail(string $email): User|null
    {
        return $this->model->whereEmail($email)->first();
    }

    public function existsByEmail(string $email): bool
    {
        return $this->model->whereEmail($email)->exists();
    }
}
