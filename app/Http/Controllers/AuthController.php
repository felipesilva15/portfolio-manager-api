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

    /**
     * @OA\Post(
     *      path="/api/login",
     *      tags={"Authentication"},
     *      summary="Log in",
     *      @OA\RequestBody(
     *          required=true,
     *          description="Data for creating a new participant",
     *          @OA\JsonContent(ref="#/components/schemas/LoginRequest")
     *      ),
     *      @OA\Response(
     *          response="200", 
     *          description="Token details",
     *          @OA\JsonContent(ref="#/components/schemas/AccessTokenDTO")
     *      ),
     *      @OA\Response(
     *         response="401", 
     *         description="Unauthorized",
     *         @OA\JsonContent(ref="#/components/schemas/ApiErrorDTO")
     *      )
     *  )
     * )
     */
    public function login(LoginRequest $request): JsonResponse {
        $tokenData = $this->authService->login($request->all());
        return response()->json($tokenData, 200);
    }
    
    /**
     * @OA\Get(
     *     path="/api/me",
     *     tags={"Authentication"},
     *     summary="Logged in user data",
     *     @OA\Response(
     *         response="401", 
     *         description="Unauthorized",
     *         @OA\JsonContent(ref="#/components/schemas/ApiErrorDTO")
     *     ),
     *     security={{"bearerAuth":{}}}
     * )
     */
    public function me(): JsonResponse {
        $user = $this->authService->getLoggedInUser();
        return response()->json($user, 200);
    }
    
    /**
     * @OA\Post(
     *     path="/api/logout",
     *     tags={"Authentication"},
     *     summary="Logout",
     *     @OA\Response(
     *          response="200", 
     *          description="Logout",
     *          @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="message", type="integer", example="Logout efetuado com sucesso.")
     *         )
     *     ),
     *     @OA\Response(
     *          response="401", 
     *          description="Unauthorized",
     *          @OA\JsonContent(ref="#/components/schemas/ApiErrorDTO")
     *     ),
     *     security={{"bearerAuth":{}}}
     * )
     */
    public function logout(): JsonResponse {
        $this->authService->logout();

        return response()->json([
            'message' => 'Successful Logout!'
        ], 200);
    }
    
    /**
     * @OA\Post(
     *     path="/api/refresh-token",
     *     tags={"Authentication"},
     *     summary="Refresh the access token",
     *     @OA\Response(
     *          response="200", 
     *          description="Token details",
     *          @OA\JsonContent(ref="#/components/schemas/AccessTokenDTO")
     *     ),
     *     @OA\Response(
     *          response="401", 
     *          description="Unauthorized",
     *          @OA\JsonContent(ref="#/components/schemas/ApiErrorDTO")
     *     ),
     *     security={{"bearerAuth":{}}}
     * )
     */
    public function refresh(): JsonResponse {
        $tokenData = $this->authService->refreshToken();
        return response()->json($tokenData, 200);
    }
}
