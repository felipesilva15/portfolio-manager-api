<?php

namespace App\Http\Controllers;

use App\Http\Requests\Skill\SkillRequest;
use App\Services\SkillService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class SkillController
{
    protected SkillService $skillService;

    public function __construct(SkillService $skillService) {
        $this->skillService = $skillService;
    }

    /**
     * @OA\Get(
     *      path="/api/skill",
     *      tags={"Skill"},
     *      summary="List all skills",
     *      @OA\Response(
     *          response="200", 
     *          description="Skill list",
     *          @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/Skill")
     *         )
     *      )
     * )
     */
    public function index(): JsonResponse {
        $skills = $this->skillService->getAll();
        return response()->json($skills, 200);
    }

    /**
     * @OA\Get(
     *      path="/api/skill/{id}",
     *      tags={"Skill"},
     *      summary="List a skill by ID",
     *      @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Skill ID",
     *         @OA\Schema(type="integer")
     *      ),
     *      @OA\Response(
     *          response="200", 
     *          description="Skill data",
     *          @OA\JsonContent(ref="#/components/schemas/Skill")
     *      ),
     *      @OA\Response(
     *          response="404", 
     *          description="Record not found",
     *          @OA\JsonContent(ref="#/components/schemas/ApiErrorDTO")
     *      )
     * )
     */
    public function show(int $id): JsonResponse {
        $skill = $this->skillService->getById($id);
        return response()->json($skill, 200);
    }

    /**
     * @OA\Post(
     *      path="/api/skill",
     *      tags={"Skill"},
     *      summary="Registers a skill",
     *      @OA\RequestBody(
     *         required=true,
     *         description="Data for creating a new skill",
     *         @OA\JsonContent(ref="#/components/schemas/SkillRequest")
     *      ),
     *      @OA\Response(
     *          response="201", 
     *          description="Registered skill data",
     *          @OA\JsonContent(ref="#/components/schemas/Skill")
     *      ),
     *      @OA\Response(
     *          response="401", 
     *          description="Unauthorized",
     *          @OA\JsonContent(ref="#/components/schemas/ApiErrorDTO")
     *      ),
     *      security={{"bearerAuth":{}}}
     * )
     */
    public function store(SkillRequest $request): JsonResponse {
        $skill = $this->skillService->create($request->all());
        return response()->json($skill, 201);
    }

    /**
     * @OA\Put(
     *      path="/api/skill/{id}",
     *      tags={"Skill"},
     *      summary="Update a skill",
     *      @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Skill ID",
     *         @OA\Schema(type="integer")
     *      ),
     *      @OA\RequestBody(
     *         required=true,
     *         description="Data for update skill",
     *         @OA\JsonContent(ref="#/components/schemas/SkillRequest")
     *      ),
     *      @OA\Response(
     *          response="200", 
     *          description="Updated skill data",
     *          @OA\JsonContent(ref="#/components/schemas/Skill")
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
    public function update(int $id, SkillRequest $request): JsonResponse {
        $skill = $this->skillService->update($id, $request->all());
        return response()->json($skill, 200);
    }

    /**
     * @OA\Delete(
     *      path="/api/skill/{id}",
     *      tags={"Skill"},
     *      summary="Delete a skill",
     *      @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Skill ID",
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
        $this->skillService->deleteById($id);
        return response()->noContent();
    }
}
