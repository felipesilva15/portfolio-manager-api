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

    public function index(): JsonResponse {
        $educations = $this->educationService->getAll();
        return response()->json($educations, 200);
    }

    public function show(int $id): JsonResponse {
        $education = $this->educationService->getById($id);
        return response()->json($education, 200);
    }

    public function store(EducationRequest $request): JsonResponse {
        $education = $this->educationService->create($request->all());
        return response()->json($education, 201);
    }

    public function update(int $id, EducationRequest $request): JsonResponse {
        $education = $this->educationService->update($id, $request->all());
        return response()->json($education, 200);
    }

    public function destroy(int $id): Response {
        $this->educationService->deleteById($id);
        return response()->noContent();
    }
}
