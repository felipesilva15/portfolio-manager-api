<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class UserController
{
    protected UserService $userService;

    public function __construct(UserService $userService) {
        $this->userService = $userService;
    }

    public function index(): JsonResponse {
        $users = $this->userService->getAll();
        return response()->json($users, 200);
    }

    public function show(int $id): JsonResponse {
        $user = $this->userService->getById($id);
        return response()->json($user, 200);
    }

    public function update(UpdateUserRequest $request, int $id): JsonResponse {
        $user = $this->userService->update($id, $request->validated());
        return response()->json($user, 200);
    }

    public function destroy(int $id): Response {
        $this->userService->deleteById($id);
        return response()->noContent();
    }
}
