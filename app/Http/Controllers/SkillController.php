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

    public function index(): JsonResponse {
        $skills = $this->skillService->getAll();
        return response()->json($skills, 200);
    }

    public function show(int $id): JsonResponse {
        $skill = $this->skillService->getById($id);
        return response()->json($skill, 200);
    }

    public function store(SkillRequest $request): JsonResponse {
        $skill = $this->skillService->create($request->all());
        return response()->json($skill, 201);
    }

    public function update(int $id, SkillRequest $request): JsonResponse {
        $skill = $this->skillService->update($id, $request->all());
        return response()->json($skill, 200);
    }

    public function destroy(int $id): Response {
        $this->skillService->deleteById($id);
        return response()->noContent();
    }
}
