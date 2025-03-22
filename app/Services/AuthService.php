<?php

namespace App\Services;

use App\Exceptions\InvalidCredentialsException;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthService {
    public function login(array $credentials): array {
        $token = JWTAuth::attempt($credentials);

        if (!$token) {
            throw new InvalidCredentialsException();
        }
    
        return $this->tokenResponse($token);
    }

    public function getLoggedInUser(): User {
        return Auth::user();
    }

    public function logout(): void {
        Auth::logout();
    }

    public function refreshToken(): array {
        $token = Auth::refresh();
        return $this->tokenResponse($token);
    }

    protected function tokenResponse(string $token): array {
        return [
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => Auth::factory()->getTTL() * 60
        ];
    }
}