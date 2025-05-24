<?php

namespace App\Http\Controllers;

use App\Http\Requests\Tag\TagRequest;
use App\Services\TagService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class TagController
{
    protected TagService $tagService;

    public function __construct(TagService $tagService) {
        $this->tagService = $tagService;
    }

    /**
     * @OA\Get(
     *      path="/api/tag",
     *      tags={"Tag"},
     *      summary="List all tags",
     *      @OA\Response(
     *          response="200", 
     *          description="Tag list",
     *          @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/Tag")
     *         )
     *      )
     * )
     */
    public function index(): JsonResponse {
        $tags = $this->tagService->getAll();
        return response()->json($tags, 200);
    }

    /**
     * @OA\Get(
     *      path="/api/tag/{id}",
     *      tags={"Tag"},
     *      summary="List a tag by ID",
     *      @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Tag ID",
     *         @OA\Schema(type="integer")
     *      ),
     *      @OA\Response(
     *          response="200", 
     *          description="Tag data",
     *          @OA\JsonContent(ref="#/components/schemas/Tag")
     *      ),
     *      @OA\Response(
     *          response="404", 
     *          description="Record not found",
     *          @OA\JsonContent(ref="#/components/schemas/ApiErrorDTO")
     *      )
     * )
     */
    public function show(int $id): JsonResponse {
        $tag = $this->tagService->getById($id);
        return response()->json($tag, 200);
    }

    /**
     * @OA\Post(
     *      path="/api/tag",
     *      tags={"Tag"},
     *      summary="Registers a tag",
     *      @OA\RequestBody(
     *         required=true,
     *         description="Data for creating a new tag",
     *         @OA\JsonContent(ref="#/components/schemas/TagRequest")
     *      ),
     *      @OA\Response(
     *          response="201", 
     *          description="Registered tag data",
     *          @OA\JsonContent(ref="#/components/schemas/Tag")
     *      ),
     *      @OA\Response(
     *          response="401", 
     *          description="Unauthorized",
     *          @OA\JsonContent(ref="#/components/schemas/ApiErrorDTO")
     *      )
     * )
     */
    public function store(TagRequest $request): JsonResponse {
        $tag = $this->tagService->create($request->all());
        return response()->json($tag, 201);
    }

    /**
     * @OA\Put(
     *      path="/api/tag/{id}",
     *      tags={"Tag"},
     *      summary="Update a tag",
     *      @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Tag ID",
     *         @OA\Schema(type="integer")
     *      ),
     *      @OA\RequestBody(
     *         required=true,
     *         description="Data for update tag",
     *         @OA\JsonContent(ref="#/components/schemas/TagRequest")
     *      ),
     *      @OA\Response(
     *          response="200", 
     *          description="Updated tag data",
     *          @OA\JsonContent(ref="#/components/schemas/Tag")
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
    public function update(int $id, TagRequest $request): JsonResponse {
        $tag = $this->tagService->update($id, $request->all());
        return response()->json($tag, 200);
    }

    /**
     * @OA\Delete(
     *      path="/api/tag/{id}",
     *      tags={"Tag"},
     *      summary="Delete a tag",
     *      @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Tag ID",
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
        $this->tagService->deleteById($id);
        return response()->noContent();
    }

    public function projects(int $id): JsonResponse {
        $projects = $this->tagService->getProjectsByTagId($id);
        return response()->json($projects, 200);
    }
}
