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

    public function index(): JsonResponse {
        $experiences = $this->experienceService->getAll();
        return response()->json($experiences, 200);
    }

    public function show(int $id): JsonResponse {
        $experience = $this->experienceService->getById($id);
        return response()->json($experience, 200);
    }

    public function store(ExperienceRequest $request): JsonResponse {
        $experience = $this->experienceService->create($request->all());
        return response()->json($experience, 201);
    }

    public function update(int $id, ExperienceRequest $request): JsonResponse {
        $experience = $this->experienceService->update($id, $request->all());
        return response()->json($experience, 200);
    }

    public function destroy(int $id): Response {
        $this->experienceService->deleteById($id);
        return response()->noContent();
    }
}
