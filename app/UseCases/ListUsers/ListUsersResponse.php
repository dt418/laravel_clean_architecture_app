<?php

namespace App\UseCases\ListUsers;

class ListUsersResponse
{
    private array $users;

    public function __construct(array $users)
    {
        $this->users = $users;
    }

    public function getUsers(): array
    {
        return $this->users;
    }
}
