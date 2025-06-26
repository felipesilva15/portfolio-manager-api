<?php

namespace App\Http\Controllers;

use App\Http\Requests\Education\EducationRequest;
use App\Services\EducationService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class EducationController
{
    protected EducationService $educationService;

    public function __construct(EducationService $educationService) {
        $this->educationService = $educationService;
    }

    /**
     * @OA\Get(
     *      path="/api/education",
     *      tags={"Education"},
     *      summary="List all educations",
     *      @OA\Response(
     *          response="200", 
     *          description="Education list",
     *          @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/Education")
     *         )
     *      )
     * )
     */
    public function index(): JsonResponse {
        $educations = $this->educationService->getAll();
        return response()->json($educations, 200);
    }

    /**
     * @OA\Get(
     *      path="/api/education/{id}",
     *      tags={"Education"},
     *      summary="List a education by ID",
     *      @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Education ID",
     *         @OA\Schema(type="integer")
     *      ),
     *      @OA\Response(
     *          response="200", 
     *          description="Education data",
     *          @OA\JsonContent(ref="#/components/schemas/Education")
     *      ),
     *      @OA\Response(
     *          response="404", 
     *          description="Record not found",
     *          @OA\JsonContent(ref="#/components/schemas/ApiErrorDTO")
     *      )
     * )
     */
    public function show(int $id): JsonResponse {
        $education = $this->educationService->getById($id);
        return response()->json($education, 200);
    }

    /**
     * @OA\Post(
     *      path="/api/education",
     *      tags={"Education"},
     *      summary="Registers a education",
     *      @OA\RequestBody(
     *         required=true,
     *         description="Data for creating a new education",
     *         @OA\JsonContent(ref="#/components/schemas/EducationRequest")
     *      ),
     *      @OA\Response(
     *          response="201", 
     *          description="Registered education data",
     *          @OA\JsonContent(ref="#/components/schemas/Education")
     *      ),
     *      @OA\Response(
     *          response="401", 
     *          description="Unauthorized",
     *          @OA\JsonContent(ref="#/components/schemas/ApiErrorDTO")
     *      ),
     *      security={{"bearerAuth":{}}}
     * )
     */
    public function store(EducationRequest $request): JsonResponse {
        $education = $this->educationService->create($request->all());
        return response()->json($education, 201);
    }

    /**
     * @OA\Put(
     *      path="/api/education/{id}",
     *      tags={"Education"},
     *      summary="Update a education",
     *      @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Education ID",
     *         @OA\Schema(type="integer")
     *      ),
     *      @OA\RequestBody(
     *         required=true,
     *         description="Data for update education",
     *         @OA\JsonContent(ref="#/components/schemas/EducationRequest")
     *      ),
     *      @OA\Response(
     *          response="200", 
     *          description="Updated education data",
     *          @OA\JsonContent(ref="#/components/schemas/Education")
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
     *      ),
     *      security={{"bearerAuth":{}}}
     * )
     */
    public function update(int $id, EducationRequest $request): JsonResponse {
        $education = $this->educationService->update($id, $request->all());
        return response()->json($education, 200);
    }

    /**
     * @OA\Delete(
     *      path="/api/education/{id}",
     *      tags={"Education"},
     *      summary="Delete a education",
     *      @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Education ID",
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
     *      ),
     *      security={{"bearerAuth":{}}}
     * )
     */
    public function destroy(int $id): Response {
        $this->educationService->deleteById($id);
        return response()->noContent();
    }
}
