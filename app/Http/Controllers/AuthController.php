<?php

namespace App\Http\Controllers;

use App\Exceptions\InvalidCredentialException;
use Illuminate\Http\Request;
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
        return response()->json(auth()->user(), 200);
    }
    
    public function logout() {
        auth()->logout();
    
        return response()->json([
            'message' => 'Successful Logout!'
        ], 200);
    }
    
    public function refresh() {
        return $this->respondWithToken(auth()->refresh());
    }
    
    protected function respondWithToken($token) {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ], 200);
    }
}
