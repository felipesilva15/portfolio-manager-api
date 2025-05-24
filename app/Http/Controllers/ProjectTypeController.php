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

    public function index(): JsonResponse {
        $projectTypes = $this->projectTypeService->getAll();
        return response()->json($projectTypes, 200);
    }

    public function show(int $id): JsonResponse {
        $projectType = $this->projectTypeService->getById($id);
        return response()->json($projectType, 200);
    }

    public function store(ProjectTypeRequest $request): JsonResponse {
        $projectType = $this->projectTypeService->create($request->all());
        return response()->json($projectType, 201);
    }

    public function update(int $id, ProjectTypeRequest $request): JsonResponse {
        $projectType = $this->projectTypeService->update($id, $request->all());
        return response()->json($projectType, 200);
    }

    public function destroy(int $id): Response {
        $this->projectTypeService->deleteById($id);
        return response()->noContent();
    }
}
