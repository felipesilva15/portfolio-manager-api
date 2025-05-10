<?php

namespace App\Http\Controllers;

use App\Http\Requests\Technology\StoreTechnologyRequest;
use App\Http\Requests\Technology\UpdateTechnologyRequest;
use App\Services\TechnologyService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class TechnologyController extends Controller
{
    protected TechnologyService $technologyService;

    public function __construct(TechnologyService $technologyService) {
        $this->technologyService = $technologyService;
    }

    public function index(): JsonResponse {
        $technologys = $this->technologyService->getAll();
        return response()->json($technologys, 200);
    }

    public function show(int $id): JsonResponse {
        $technology = $this->technologyService->getById($id);
        return response()->json($technology, 200);
    }

    public function store(StoreTechnologyRequest $request): JsonResponse {
        $technology = $this->technologyService->create($request->all());
        return response()->json($technology, 201);
    }

    public function update(int $id, UpdateTechnologyRequest $request): JsonResponse {
        $technology = $this->technologyService->update($id, $request->all());
        return response()->json($technology, 200);
    }

    public function destroy(int $id): Response {
        $this->technologyService->deleteById($id);
        return response()->noContent();
    }
}
