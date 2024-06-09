<?php

namespace App\UseCases\CreateUser;

use App\Domain\Entities\User;
use App\Domain\Repositories\UserRepository;
use App\Exceptions\UserCreationException;
use Exception;

class CreateUser
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function execute(CreateUserRequest $request): CreateUserResponse
    {
        try {
            $user = new User(null, $request->getName(), $request->getEmail());
            $savedUser = $this->userRepository->save($user);

            return new CreateUserResponse($savedUser);
        } catch (Exception $e) {
            throw new UserCreationException('Failed to create user: '.$e->getMessage());
        }
    }
}
