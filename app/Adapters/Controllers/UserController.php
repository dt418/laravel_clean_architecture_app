<?php

namespace App\Adapters\Controllers;

use App\Exceptions\MethodNotAllowedException;
use App\Exceptions\UserCreationException;
use App\Exceptions\UserNotFoundException;
use App\Http\Controllers\Controller;
use App\UseCases\CreateUser\CreateUser;
use App\UseCases\CreateUser\CreateUserRequest;
use App\UseCases\DeleteUser\DeleteUser;
use App\UseCases\DeleteUser\DeleteUserRequest;
use App\UseCases\ListUsers\ListUsers;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private CreateUser $createUser;

    private ListUsers $listUsers;

    private DeleteUser $deleteUser;

    public function __construct(CreateUser $createUser, ListUsers $listUsers, DeleteUser $deleteUser)
    {
        $this->createUser = $createUser;
        $this->listUsers = $listUsers;
        $this->deleteUser = $deleteUser;
    }

    public function index(): JsonResponse
    {
        try {
            $response = $this->listUsers->execute();

            return response()->json(['users' => $response->getUsers()]);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function store(Request $request): JsonResponse
    {
        try {
            $createUserRequest = new CreateUserRequest($request->name, $request->email);
            $response = $this->createUser->execute($createUserRequest);

            return response()->json(['user' => $response->getUser()], 201);
        } catch (UserCreationException $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function destroy(Request $request, $id): JsonResponse
    {
        try {
            if ($request->method() !== 'DELETE') {
                throw new MethodNotAllowedException('Invalid method: '.$request->method());
            }
            $this->deleteUser->execute(new DeleteUserRequest($id));

            return response()->json(['message' => 'User deleted successfully']);
        } catch (UserNotFoundException $e) {
            return response()->json(['error' => $e->getMessage()], 404);
        } catch (MethodNotAllowedException $e) {
            return response()->json(['error' => $e->getMessage()], 405);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
