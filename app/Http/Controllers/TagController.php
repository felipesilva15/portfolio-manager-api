<?php

namespace App\Http\Controllers;

use App\Http\Requests\Tag\StoreTagRequest;
use App\Http\Requests\Tag\UpdateTagRequest;
use App\Services\TagService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class TagController
{
    protected TagService $tagService;

    public function __construct(TagService $tagService) {
        $this->tagService = $tagService;
    }

    public function index(): JsonResponse {
        $tags = $this->tagService->getAll();
        return response()->json($tags, 200);
    }

    public function show($id): JsonResponse {
        $tag = $this->tagService->getById($id);
        return response()->json($tag, 200);
    }

    public function store(StoreTagRequest $request): JsonResponse {
        $tag = $this->tagService->create($request->all());
        return response()->json($tag, 201);
    }

    public function update(int $id, UpdateTagRequest $request): JsonResponse {
        $tag = $this->tagService->update($id, $request->all());
        return response()->json($tag, 200);
    }

    public function destroy(int $id): Response {
        $this->tagService->deleteById($id);
        return response()->noContent();
    }

    public function projects(int $id): JsonResponse {
        $projects = $this->tagService->getProjectsByTagId($id);
        return response()->json($projects, 200);
    }
}
