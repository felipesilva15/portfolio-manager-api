<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Services\AuthService;
use Illuminate\Http\JsonResponse;

class AuthController extends Controller
{
    protected AuthService $authService;

    public function __construct(AuthService $authService) {
        $this->authService = $authService;
    }

    public function login(LoginRequest $request): JsonResponse {
        $tokenData = $this->authService->login($request->all());
        return response()->json($tokenData, 200);
    }
    
    public function me(): JsonResponse {
        $user = $this->authService->getLoggedInUser();
        return response()->json($user, 200);
    }
    
    public function logout(): JsonResponse {
        $this->authService->logout();

        return response()->json([
            'message' => 'Successful Logout!'
        ], 200);
    }
    
    public function refresh(): JsonResponse {
        $tokenData = $this->authService->refreshToken();
        return response()->json($tokenData, 200);
    }
}
