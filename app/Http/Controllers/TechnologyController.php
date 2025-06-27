<?php

namespace App\Http\Controllers;

use App\Http\Requests\Technology\TechnologyRequest;
use App\Services\TechnologyService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class TechnologyController extends Controller
{
    protected TechnologyService $technologyService;

    public function __construct(TechnologyService $technologyService) {
        $this->technologyService = $technologyService;
    }

    /**
     * @OA\Get(
     *      path="/api/technology",
     *      tags={"Technology"},
     *      summary="List all technologys",
     *      @OA\Response(
     *          response="200", 
     *          description="Technology list",
     *          @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/Technology")
     *         )
     *      )
     * )
     */
    public function index(): JsonResponse {
        $technologys = $this->technologyService->getAll();
        return response()->json($technologys, 200);
    }

    /**
     * @OA\Get(
     *      path="/api/technology/{id}",
     *      tags={"Technology"},
     *      summary="List a technology by ID",
     *      @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Technology ID",
     *         @OA\Schema(type="integer")
     *      ),
     *      @OA\Response(
     *          response="200", 
     *          description="Technology data",
     *          @OA\JsonContent(ref="#/components/schemas/Technology")
     *      ),
     *      @OA\Response(
     *          response="404", 
     *          description="Record not found",
     *          @OA\JsonContent(ref="#/components/schemas/ApiErrorDTO")
     *      )
     * )
     */
    public function show(int $id): JsonResponse {
        $technology = $this->technologyService->getById($id);
        return response()->json($technology, 200);
    }

    /**
     * @OA\Post(
     *      path="/api/technology",
     *      tags={"Technology"},
     *      summary="Registers a technology",
     *      @OA\RequestBody(
     *         required=true,
     *         description="Data for creating a new technology",
     *         @OA\JsonContent(ref="#/components/schemas/TechnologyRequest")
     *      ),
     *      @OA\Response(
     *          response="201", 
     *          description="Registered technology data",
     *          @OA\JsonContent(ref="#/components/schemas/Technology")
     *      ),
     *      @OA\Response(
     *          response="401", 
     *          description="Unauthorized",
     *          @OA\JsonContent(ref="#/components/schemas/ApiErrorDTO")
     *      ),
     *      security={{"bearerAuth":{}}}
     * )
     */
    public function store(TechnologyRequest $request): JsonResponse {
        $technology = $this->technologyService->create($request->all());
        return response()->json($technology, 201);
    }

    /**
     * @OA\Put(
     *      path="/api/technology/{id}",
     *      tags={"Technology"},
     *      summary="Update a technology",
     *      @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Technology ID",
     *         @OA\Schema(type="integer")
     *      ),
     *      @OA\RequestBody(
     *         required=true,
     *         description="Data for update technology",
     *         @OA\JsonContent(ref="#/components/schemas/TechnologyRequest")
     *      ),
     *      @OA\Response(
     *          response="200", 
     *          description="Updated technology data",
     *          @OA\JsonContent(ref="#/components/schemas/Technology")
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
    public function update(int $id, TechnologyRequest $request): JsonResponse {
        $technology = $this->technologyService->update($id, $request->all());
        return response()->json($technology, 200);
    }

    /**
     * @OA\Delete(
     *      path="/api/technology/{id}",
     *      tags={"Technology"},
     *      summary="Delete a technology",
     *      @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Technology ID",
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
        $this->technologyService->deleteById($id);
        return response()->noContent();
    }
}
