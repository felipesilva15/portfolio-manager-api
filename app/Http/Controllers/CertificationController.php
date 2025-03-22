<?php

namespace App\Http\Controllers;

use App\Http\Requests\Certification\StoreCertificationRequest;
use App\Http\Requests\Certification\UpdateCertificationRequest;
use App\Services\CertificationService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class CertificationController
{
    protected CertificationService $certificationService;

    public function __construct(CertificationService $certificationService) {
        $this->certificationService = $certificationService;
    }

    public function index(): JsonResponse {
        $certifications = $this->certificationService->getAll();
        return response()->json($certifications, 200);
    }

    public function show($id): JsonResponse {
        $certification = $this->certificationService->getById($id);
        return response()->json($certification, 200);
    }

    public function store(StoreCertificationRequest $request): JsonResponse {
        $certification = $this->certificationService->create($request->all());
        return response()->json($certification, 201);
    }

    public function update(int $id, UpdateCertificationRequest $request): JsonResponse {
        $certification = $this->certificationService->update($id, $request->all());
        return response()->json($certification, 200);
    }

    public function destroy(int $id): Response {
        $this->certificationService->deleteById($id);
        return response()->noContent();
    }
}
