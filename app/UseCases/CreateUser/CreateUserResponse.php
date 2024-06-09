<?php

namespace App\UseCases\CreateUser;

use App\Domain\Entities\User;

class CreateUserResponse
{
    private User $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function getUser(): User
    {
        return $this->user;
    }
}
