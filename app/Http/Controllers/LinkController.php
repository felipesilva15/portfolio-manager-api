<?php

namespace App\Http\Controllers;

use App\Http\Requests\Link\LinkRequest;
use App\Services\LinkService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class LinkController extends Controller
{
    protected LinkService $linkService;

    public function __construct(LinkService $linkService) {
        $this->linkService = $linkService;
    }
    
    /**
     * @OA\Get(
     *      path="/api/link",
     *      tags={"Link"},
     *      summary="List all links",
     *      @OA\Response(
     *          response="200", 
     *          description="Link list",
     *          @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/Link")
     *         )
     *      )
     * )
     */
    public function index(): JsonResponse {
        $links = $this->linkService->getAll();
        return response()->json($links, 200);
    }
    
    /**
     * @OA\Get(
     *      path="/api/link/{id}",
     *      tags={"Link"},
     *      summary="List a link by ID",
     *      @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Link ID",
     *         @OA\Schema(type="integer")
     *      ),
     *      @OA\Response(
     *          response="200", 
     *          description="Link data",
     *          @OA\JsonContent(ref="#/components/schemas/Link")
     *      ),
     *      @OA\Response(
     *          response="404", 
     *          description="Record not found",
     *          @OA\JsonContent(ref="#/components/schemas/ApiErrorDTO")
     *      )
     * )
     */
    public function show(int $id): JsonResponse {
        $link = $this->linkService->getById($id);
        return response()->json($link, 200);
    }
    
    /**
     * @OA\Post(
     *      path="/api/link",
     *      tags={"Link"},
     *      summary="Registers a link",
     *      @OA\RequestBody(
     *         required=true,
     *         description="Data for creating a new link",
     *         @OA\JsonContent(ref="#/components/schemas/LinkRequest")
     *      ),
     *      @OA\Response(
     *          response="201", 
     *          description="Registered link data",
     *          @OA\JsonContent(ref="#/components/schemas/Link")
     *      ),
     *      @OA\Response(
     *          response="401", 
     *          description="Unauthorized",
     *          @OA\JsonContent(ref="#/components/schemas/ApiErrorDTO")
     *      ),
     *      security={{"bearerAuth":{}}}
     * )
     */
    public function store(LinkRequest $request): JsonResponse {
        $link = $this->linkService->create($request->all());
        return response()->json($link, 201);
    }

    /**
     * @OA\Put(
     *      path="/api/link/{id}",
     *      tags={"Link"},
     *      summary="Update a link",
     *      @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Link ID",
     *         @OA\Schema(type="integer")
     *      ),
     *      @OA\RequestBody(
     *         required=true,
     *         description="Data for update link",
     *         @OA\JsonContent(ref="#/components/schemas/LinkRequest")
     *      ),
     *      @OA\Response(
     *          response="200", 
     *          description="Updated link data",
     *          @OA\JsonContent(ref="#/components/schemas/Link")
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
    public function update(int $id, LinkRequest $request): JsonResponse {
        $link = $this->linkService->update($id, $request->all());
        return response()->json($link, 200);
    }

    /**
     * @OA\Delete(
     *      path="/api/link/{id}",
     *      tags={"Link"},
     *      summary="Delete a link",
     *      @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Link ID",
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
        $this->linkService->deleteById($id);
        return response()->noContent();
    }
}
