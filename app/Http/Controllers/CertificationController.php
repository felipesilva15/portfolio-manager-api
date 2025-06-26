<?php

namespace App\Http\Controllers;

use App\Http\Requests\Certification\CertificationRequest;
use App\Services\CertificationService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class CertificationController
{
    protected CertificationService $certificationService;

    public function __construct(CertificationService $certificationService) {
        $this->certificationService = $certificationService;
    }

    /**
     * @OA\Get(
     *      path="/api/certification",
     *      tags={"Certification"},
     *      summary="List all certifications",
     *      @OA\Response(
     *          response="200", 
     *          description="Certification list",
     *          @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/Certification")
     *         )
     *      )
     * )
     */
    public function index(): JsonResponse {
        $certifications = $this->certificationService->getAll();
        return response()->json($certifications, 200);
    }

    /**
     * @OA\Get(
     *      path="/api/certification/{id}",
     *      tags={"Certification"},
     *      summary="List a certification by ID",
     *      @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Certification ID",
     *         @OA\Schema(type="integer")
     *      ),
     *      @OA\Response(
     *          response="200", 
     *          description="Certification data",
     *          @OA\JsonContent(ref="#/components/schemas/Certification")
     *      ),
     *      @OA\Response(
     *          response="404", 
     *          description="Record not found",
     *          @OA\JsonContent(ref="#/components/schemas/ApiErrorDTO")
     *      )
     * )
     */
    public function show(int $id): JsonResponse {
        $certification = $this->certificationService->getById($id);
        return response()->json($certification, 200);
    }

    /**
     * @OA\Post(
     *      path="/api/certification",
     *      tags={"Certification"},
     *      summary="Registers a certification",
     *      @OA\RequestBody(
     *         required=true,
     *         description="Data for creating a new certification",
     *         @OA\JsonContent(ref="#/components/schemas/CertificationRequest")
     *      ),
     *      @OA\Response(
     *          response="201", 
     *          description="Registered certification data",
     *          @OA\JsonContent(ref="#/components/schemas/Certification")
     *      ),
     *      @OA\Response(
     *          response="401", 
     *          description="Unauthorized",
     *          @OA\JsonContent(ref="#/components/schemas/ApiErrorDTO")
     *      ),
     *      security={{"bearerAuth":{}}}
     * )
     */
    public function store(CertificationRequest $request): JsonResponse {
        $certification = $this->certificationService->create($request->all());
        return response()->json($certification, 201);
    }

    /**
     * @OA\Put(
     *      path="/api/certification/{id}",
     *      tags={"Certification"},
     *      summary="Update a certification",
     *      @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Certification ID",
     *         @OA\Schema(type="integer")
     *      ),
     *      @OA\RequestBody(
     *         required=true,
     *         description="Data for update certification",
     *         @OA\JsonContent(ref="#/components/schemas/CertificationRequest")
     *      ),
     *      @OA\Response(
     *          response="200", 
     *          description="Updated certification data",
     *          @OA\JsonContent(ref="#/components/schemas/Certification")
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
    public function update(int $id, CertificationRequest $request): JsonResponse {
        $certification = $this->certificationService->update($id, $request->all());
        return response()->json($certification, 200);
    }

    /**
     * @OA\Delete(
     *      path="/api/certification/{id}",
     *      tags={"Certification"},
     *      summary="Delete a certification",
     *      @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Certification ID",
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
        $this->certificationService->deleteById($id);
        return response()->noContent();
    }
}
