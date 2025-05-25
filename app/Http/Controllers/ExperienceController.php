<?php

namespace App\Http\Controllers;

use App\Http\Requests\Experience\ExperienceRequest;
use App\Services\ExperienceService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class ExperienceController
{
    protected ExperienceService $experienceService;

    public function __construct(ExperienceService $experienceService) {
        $this->experienceService = $experienceService;
    }

    /**
     * @OA\Get(
     *      path="/api/experience",
     *      tags={"Experience"},
     *      summary="List all experiences",
     *      @OA\Response(
     *          response="200", 
     *          description="Experience list",
     *          @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/Experience")
     *         )
     *      )
     * )
     */
    public function index(): JsonResponse {
        $experiences = $this->experienceService->getAll();
        return response()->json($experiences, 200);
    }

    /**
     * @OA\Get(
     *      path="/api/experience/{id}",
     *      tags={"Experience"},
     *      summary="List a experience by ID",
     *      @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Experience ID",
     *         @OA\Schema(type="integer")
     *      ),
     *      @OA\Response(
     *          response="200", 
     *          description="Experience data",
     *          @OA\JsonContent(ref="#/components/schemas/Experience")
     *      ),
     *      @OA\Response(
     *          response="404", 
     *          description="Record not found",
     *          @OA\JsonContent(ref="#/components/schemas/ApiErrorDTO")
     *      )
     * )
     */
    public function show(int $id): JsonResponse {
        $experience = $this->experienceService->getById($id);
        return response()->json($experience, 200);
    }

    /**
     * @OA\Post(
     *      path="/api/experience",
     *      tags={"Experience"},
     *      summary="Registers a experience",
     *      @OA\RequestBody(
     *         required=true,
     *         description="Data for creating a new experience",
     *         @OA\JsonContent(ref="#/components/schemas/ExperienceRequest")
     *      ),
     *      @OA\Response(
     *          response="201", 
     *          description="Registered experience data",
     *          @OA\JsonContent(ref="#/components/schemas/Experience")
     *      ),
     *      @OA\Response(
     *          response="401", 
     *          description="Unauthorized",
     *          @OA\JsonContent(ref="#/components/schemas/ApiErrorDTO")
     *      )
     * )
     */
    public function store(ExperienceRequest $request): JsonResponse {
        $experience = $this->experienceService->create($request->all());
        return response()->json($experience, 201);
    }

    /**
     * @OA\Put(
     *      path="/api/experience/{id}",
     *      tags={"Experience"},
     *      summary="Update a experience",
     *      @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Experience ID",
     *         @OA\Schema(type="integer")
     *      ),
     *      @OA\RequestBody(
     *         required=true,
     *         description="Data for update experience",
     *         @OA\JsonContent(ref="#/components/schemas/ExperienceRequest")
     *      ),
     *      @OA\Response(
     *          response="200", 
     *          description="Updated experience data",
     *          @OA\JsonContent(ref="#/components/schemas/Experience")
     *      ),
     *      @OA\Response(
     *          response="401", 
     *          description="Unauthorized",
     *          @OA\JsonContent(ref="#/components/schemas/ApiErrorDTO")
     *      ),
     *      @OA\Response(
     *          response="404", 
     *          description="Record not found",
     *          @OA\JsonContent(ref="#/components/schemas/ApiErrorDTO")
     *      )
     * )
     */
    public function update(int $id, ExperienceRequest $request): JsonResponse {
        $experience = $this->experienceService->update($id, $request->all());
        return response()->json($experience, 200);
    }

    /**
     * @OA\Delete(
     *      path="/api/experience/{id}",
     *      tags={"Experience"},
     *      summary="Delete a experience",
     *      @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Experience ID",
     *         @OA\Schema(type="integer")
     *      ),
     *      @OA\Response(
     *          response="204", 
     *          description="No content"
     *      ),
     *      @OA\Response(
     *          response="401", 
     *          description="Unauthorized",
     *          @OA\JsonContent(ref="#/components/schemas/ApiErrorDTO")
     *      ),
     *      @OA\Response(
     *          response="404", 
     *          description="Record not found",
     *          @OA\JsonContent(ref="#/components/schemas/ApiErrorDTO")
     *      )
     * )
     */
    public function destroy(int $id): Response {
        $this->experienceService->deleteById($id);
        return response()->noContent();
    }
}
