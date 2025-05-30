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
    
    public function index(): JsonResponse {
        $testimonials = $this->testimonialService->getAll();
        return response()->json($testimonials, 200);
    }
    
    public function show(int $id): JsonResponse {
        $testimonial = $this->testimonialService->getById($id);
        return response()->json($testimonial, 200);
    }
    
    public function store(TestimonialRequest $request): JsonResponse {
        $testimonial = $this->testimonialService->create($request->all());
        return response()->json($testimonial, 201);
    }

    public function update(int $id, TestimonialRequest $request): JsonResponse {
        $testimonial = $this->testimonialService->update($id, $request->all());
        return response()->json($testimonial, 200);
    }

    public function destroy(int $id): Response {
        $this->testimonialService->deleteById($id);
        return response()->noContent();
    }
}
