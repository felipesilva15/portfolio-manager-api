<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectType\ProjectTypeRequest;
use App\Services\ProjectTypeService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class ProjectTypeController extends Controller
{
    protected ProjectTypeService $projectTypeService;

    public function __construct(ProjectTypeService $projectTypeService) {
        $this->projectTypeService = $projectTypeService;
    }

    /**
     * @OA\Get(
     *      path="/api/project-type",
     *      tags={"ProjectType"},
     *      summary="List all project types",
     *      @OA\Response(
     *          response="200", 
     *          description="Project Type list",
     *          @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/ProjectType")
     *         )
     *      )
     * )
     */
    public function index(): JsonResponse {
        $projectTypes = $this->projectTypeService->getAll();
        return response()->json($projectTypes, 200);
    }

    /**
     * @OA\Get(
     *      path="/api/project-type/{id}",
     *      tags={"ProjectType"},
     *      summary="List a project type by ID",
     *      @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Project Type ID",
     *         @OA\Schema(type="integer")
     *      ),
     *      @OA\Response(
     *          response="200", 
     *          description="Project Type data",
     *          @OA\JsonContent(ref="#/components/schemas/ProjectType")
     *      ),
     *      @OA\Response(
     *          response="404", 
     *          description="Record not found",
     *          @OA\JsonContent(ref="#/components/schemas/ApiErrorDTO")
     *      )
     * )
     */
    public function show(int $id): JsonResponse {
        $projectType = $this->projectTypeService->getById($id);
        return response()->json($projectType, 200);
    }

    /**
     * @OA\Post(
     *      path="/api/project-type",
     *      tags={"ProjectType"},
     *      summary="Registers a project type",
     *      @OA\RequestBody(
     *         required=true,
     *         description="Data for creating a new project type",
     *         @OA\JsonContent(ref="#/components/schemas/ProjectTypeRequest")
     *      ),
     *      @OA\Response(
     *          response="201", 
     *          description="Registered project type data",
     *          @OA\JsonContent(ref="#/components/schemas/ProjectType")
     *      ),
     *      @OA\Response(
     *          response="401", 
     *          description="Unauthorized",
     *          @OA\JsonContent(ref="#/components/schemas/ApiErrorDTO")
     *      ),
     *      security={{"bearerAuth":{}}}
     * )
     */
    public function store(ProjectTypeRequest $request): JsonResponse {
        $projectType = $this->projectTypeService->create($request->all());
        return response()->json($projectType, 201);
    }

    /**
     * @OA\Put(
     *      path="/api/project-type/{id}",
     *      tags={"ProjectType"},
     *      summary="Update a project type",
     *      @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Project Type ID",
     *         @OA\Schema(type="integer")
     *      ),
     *      @OA\RequestBody(
     *         required=true,
     *         description="Data for update project type",
     *         @OA\JsonContent(ref="#/components/schemas/ProjectTypeRequest")
     *      ),
     *      @OA\Response(
     *          response="200", 
     *          description="Updated project type data",
     *          @OA\JsonContent(ref="#/components/schemas/ProjectType")
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
    public function update(int $id, ProjectTypeRequest $request): JsonResponse {
        $projectType = $this->projectTypeService->update($id, $request->all());
        return response()->json($projectType, 200);
    }

    /**
     * @OA\Delete(
     *      path="/api/project-type/{id}",
     *      tags={"ProjectType"},
     *      summary="Delete a project type",
     *      @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Project Type ID",
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
        $this->projectTypeService->deleteById($id);
        return response()->noContent();
    }
}
