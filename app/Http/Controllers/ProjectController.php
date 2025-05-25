<?php

namespace App\Http\Controllers;

use App\Http\Requests\Project\ProjectRequest;
use App\Services\ProjectService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class ProjectController
{
    protected ProjectService $projectService;

    public function __construct(ProjectService $projectService) {
        $this->projectService = $projectService;
    }

    /**
     * @OA\Get(
     *      path="/api/project",
     *      tags={"Project"},
     *      summary="List all projects",
     *      @OA\Response(
     *          response="200", 
     *          description="Project list",
     *          @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/Project")
     *         )
     *      )
     * )
     */
    public function index(): JsonResponse {
        $projects = $this->projectService->getAll();
        return response()->json($projects, 200);
    }

    /**
     * @OA\Get(
     *      path="/api/project/{id}",
     *      tags={"Project"},
     *      summary="List a project by ID",
     *      @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Project ID",
     *         @OA\Schema(type="integer")
     *      ),
     *      @OA\Response(
     *          response="200", 
     *          description="Project data",
     *          @OA\JsonContent(ref="#/components/schemas/Project")
     *      ),
     *      @OA\Response(
     *          response="404", 
     *          description="Record not found",
     *          @OA\JsonContent(ref="#/components/schemas/ApiErrorDTO")
     *      )
     * )
     */
    public function show(int $id): JsonResponse {
        $project = $this->projectService->getById($id);
        return response()->json($project, 200);
    }

    /**
     * @OA\Post(
     *      path="/api/project",
     *      tags={"Project"},
     *      summary="Registers a project",
     *      @OA\RequestBody(
     *         required=true,
     *         description="Data for creating a new project",
     *         @OA\JsonContent(ref="#/components/schemas/ProjectRequest")
     *      ),
     *      @OA\Response(
     *          response="201", 
     *          description="Registered project data",
     *          @OA\JsonContent(ref="#/components/schemas/Project")
     *      ),
     *      @OA\Response(
     *          response="401", 
     *          description="Unauthorized",
     *          @OA\JsonContent(ref="#/components/schemas/ApiErrorDTO")
     *      )
     * )
     */
    public function store(ProjectRequest $request): JsonResponse {
        $project = $this->projectService->create($request->all());
        return response()->json($project, 201);
    }

    /**
     * @OA\Put(
     *      path="/api/project/{id}",
     *      tags={"Project"},
     *      summary="Update a project",
     *      @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Project ID",
     *         @OA\Schema(type="integer")
     *      ),
     *      @OA\RequestBody(
     *         required=true,
     *         description="Data for update project",
     *         @OA\JsonContent(ref="#/components/schemas/ProjectRequest")
     *      ),
     *      @OA\Response(
     *          response="200", 
     *          description="Updated project data",
     *          @OA\JsonContent(ref="#/components/schemas/Project")
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
    public function update(int $id, ProjectRequest $request): JsonResponse {
        $project = $this->projectService->update($id, $request->all());
        return response()->json($project, 200);
    }

    /**
     * @OA\Delete(
     *      path="/api/project/{id}",
     *      tags={"Project"},
     *      summary="Delete a project",
     *      @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Project ID",
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
        $this->projectService->deleteById($id);
        return response()->noContent();
    }

    public function tags(int $id): JsonResponse {
        $tags = $this->projectService->getTagsByProjectId($id);
        return response()->json($tags, 200);
    }
}
