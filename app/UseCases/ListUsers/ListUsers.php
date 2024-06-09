<?php

namespace App\UseCases\ListUsers;

use App\Domain\Repositories\UserRepository;
use Exception;

class ListUsers
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function execute(): ListUsersResponse
    {
        try {
            $users = $this->userRepository->findAll();

            return new ListUsersResponse($users);
        } catch (Exception $e) {
            throw new Exception('Failed to list users: '.$e->getMessage());
        }
    }
}
