<?php

namespace App\Domain\Repositories;

use App\Domain\Entities\User;

interface UserRepository
{
    public function save(User $user);

    public function findById(string $id): ?User;

    public function findAll(): array;

    public function delete(User $id): void;
}
