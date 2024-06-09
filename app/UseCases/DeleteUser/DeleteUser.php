<?php

namespace App\UseCases\DeleteUser;

use App\Domain\Repositories\UserRepository;
use App\Exceptions\UserNotFoundException;
use Exception;

class DeleteUser
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function execute(DeleteUserRequest $request): void
    {
        try {
            $user = $this->userRepository->findById($request->getId());
            if (! $user) {
                throw new UserNotFoundException('User with ID '.$request->getId().' not found');
            }
            $this->userRepository->delete($user);
        } catch (Exception $e) {
            throw $e instanceof UserNotFoundException ? $e : new Exception('Failed to delete user: '.$e->getMessage());
        }
    }
}
