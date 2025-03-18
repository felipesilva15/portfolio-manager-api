<?php

namespace App\Http\Controllers;

use App\Exceptions\InvalidCredentialException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    public function login(Request $request) {
        $credentials = [
            'email' => $request->email,
            'password' =>$request->password,
        ];
    
        if (!$token = JWTAuth::attempt($credentials)) {
            throw new InvalidCredentialException();
        }
    
        return $this->respondWithToken($token);
    }
    
    public function me() {
        return response()->json(Auth::user(), 200);
    }
    
    public function logout() {
        Auth::logout();
    
        return response()->json([
            'message' => 'Successful Logout!'
        ], 200);
    }
    
    public function refresh() {
        return $this->respondWithToken(Auth::refresh());
    }
    
    protected function respondWithToken($token) {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => Auth::factory()->getTTL() * 60
        ], 200);
    }
}
