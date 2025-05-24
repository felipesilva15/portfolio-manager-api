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

    public function index(): JsonResponse {
        $projects = $this->projectService->getAll();
        return response()->json($projects, 200);
    }

    public function show(int $id): JsonResponse {
        $project = $this->projectService->getById($id);
        return response()->json($project, 200);
    }

    public function store(ProjectRequest $request): JsonResponse {
        $project = $this->projectService->create($request->all());
        return response()->json($project, 201);
    }

    public function update(int $id, ProjectRequest $request): JsonResponse {
        $project = $this->projectService->update($id, $request->all());
        return response()->json($project, 200);
    }

    public function destroy(int $id): Response {
        $this->projectService->deleteById($id);
        return response()->noContent();
    }

    public function tags(int $id): JsonResponse {
        $tags = $this->projectService->getTagsByProjectId($id);
        return response()->json($tags, 200);
    }
}
