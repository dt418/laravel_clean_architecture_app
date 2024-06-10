<?php

namespace App\Framework\Eloquent;

use App\Domain\Entities\User;
use App\Domain\Repositories\UserRepository;

class EloquentUserRepository implements UserRepository
{
    public function save(User $user): User
    {
        EloquentUser::updateOrCreate(
            ['id' => $user->getId()],
            ['name' => $user->getName(), 'email' => $user->getEmail()]
        );

        return $user;
    }

    public function findById(string $id): ?User
    {
        $eloquentUser = EloquentUser::find($id);
        if (! $eloquentUser) {
            return null;
        }

        return new User($eloquentUser->id, $eloquentUser->name, $eloquentUser->email);
    }

    public function findAll(): array
    {
        return EloquentUser::all()->map(function ($eloquentUser) {
            return new User($eloquentUser->id, $eloquentUser->name, $eloquentUser->email);
        })->toArray();
    }

    public function delete(User $user): void
    {
        $eloquentUser = EloquentUser::find($user->getId());
        if ($eloquentUser) {
            $eloquentUser->delete();
        }
    }
}
