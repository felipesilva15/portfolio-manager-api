<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Services\AuthService;

class AuthController extends Controller
{
    protected AuthService $authService;

    public function __construct(AuthService $authService) {
        $this->authService = $authService;
    }

    public function login(LoginRequest $request) {
        return $this->authService->login($request->all());
    }
    
    public function me() {
        return response()->json($this->authService->getLoggedInUser(), 200);
    }
    
    public function logout() {
        $this->authService->logout();

        return response()->json(['message' => 'Successful Logout!'], 200);
    }
    
    public function refresh() {
        return response()->json($this->authService->refreshToken(), 200);
    }
}
