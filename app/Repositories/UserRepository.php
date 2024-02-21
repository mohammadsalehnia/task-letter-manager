<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository extends Repository
{
    public function model(): string
    {
        return User::class;
    }

    public function findByEmail(string $email): ?User
    {
        return $this->model->whereEmail($email)->first();
    }

    public function existsByEmail(string $email): bool
    {
        return $this->model->whereEmail($email)->exists();
    }
}
