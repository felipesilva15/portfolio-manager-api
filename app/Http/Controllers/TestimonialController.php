<?php

namespace App\Http\Controllers;

use App\Http\Requests\Testimonial\TestimonialRequest;
use App\Services\TestimonialService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TestimonialController extends Controller
{
    protected TestimonialService $testimonialService;

    public function __construct(TestimonialService $testimonialService) {
        $this->testimonialService = $testimonialService;
    }
    
    /**
     * @OA\Get(
     *      path="/api/testimonial",
     *      tags={"Testimonial"},
     *      summary="List all testimonials",
     *      @OA\Response(
     *          response="200", 
     *          description="Testimonial list",
     *          @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/Testimonial")
     *         )
     *      )
     * )
     */
    public function index(): JsonResponse {
        $testimonials = $this->testimonialService->getAll();
        return response()->json($testimonials, 200);
    }
    
    /**
     * @OA\Get(
     *      path="/api/testimonial/{id}",
     *      tags={"Testimonial"},
     *      summary="List a testimonial by ID",
     *      @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Testimonial ID",
     *         @OA\Schema(type="integer")
     *      ),
     *      @OA\Response(
     *          response="200", 
     *          description="Testimonial data",
     *          @OA\JsonContent(ref="#/components/schemas/Testimonial")
     *      ),
     *      @OA\Response(
     *          response="404", 
     *          description="Record not found",
     *          @OA\JsonContent(ref="#/components/schemas/ApiErrorDTO")
     *      )
     * )
     */
    public function show(int $id): JsonResponse {
        $testimonial = $this->testimonialService->getById($id);
        return response()->json($testimonial, 200);
    }
    
    /**
     * @OA\Post(
     *      path="/api/testimonial",
     *      tags={"Testimonial"},
     *      summary="Registers a testimonial",
     *      @OA\RequestBody(
     *         required=true,
     *         description="Data for creating a new testimonial",
     *         @OA\JsonContent(ref="#/components/schemas/TestimonialRequest")
     *      ),
     *      @OA\Response(
     *          response="201", 
     *          description="Registered testimonial data",
     *          @OA\JsonContent(ref="#/components/schemas/Testimonial")
     *      ),
     *      @OA\Response(
     *          response="401", 
     *          description="Unauthorized",
     *          @OA\JsonContent(ref="#/components/schemas/ApiErrorDTO")
     *      )
     * )
     */
    public function store(TestimonialRequest $request): JsonResponse {
        $testimonial = $this->testimonialService->create($request->all());
        return response()->json($testimonial, 201);
    }

    /**
     * @OA\Put(
     *      path="/api/testimonial/{id}",
     *      tags={"Testimonial"},
     *      summary="Update a testimonial",
     *      @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Testimonial ID",
     *         @OA\Schema(type="integer")
     *      ),
     *      @OA\RequestBody(
     *         required=true,
     *         description="Data for update testimonial",
     *         @OA\JsonContent(ref="#/components/schemas/TestimonialRequest")
     *      ),
     *      @OA\Response(
     *          response="200", 
     *          description="Updated testimonial data",
     *          @OA\JsonContent(ref="#/components/schemas/Testimonial")
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
    public function update(int $id, TestimonialRequest $request): JsonResponse {
        $testimonial = $this->testimonialService->update($id, $request->all());
        return response()->json($testimonial, 200);
    }

    /**
     * @OA\Delete(
     *      path="/api/testimonial/{id}",
     *      tags={"Testimonial"},
     *      summary="Delete a testimonial",
     *      @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Testimonial ID",
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
        $this->testimonialService->deleteById($id);
        return response()->noContent();
    }
}
