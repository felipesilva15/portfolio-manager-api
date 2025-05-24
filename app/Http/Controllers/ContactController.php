<?php

namespace App\Http\Controllers;

use App\Http\Requests\Contact\ContactRequest;
use App\Services\ContactService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class ContactController
{
    protected ContactService $contactService;

    public function __construct(ContactService $contactService) {
        $this->contactService = $contactService;
    }

    /**
     * @OA\Get(
     *      path="/api/contact",
     *      tags={"Contact"},
     *      summary="List all contacts",
     *      @OA\Response(
     *          response="200", 
     *          description="Contact list",
     *          @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/Contact")
     *         )
     *      )
     * )
     */
    public function index(): JsonResponse {
        $contacts = $this->contactService->getAll();
        return response()->json($contacts, 200);
    }

    /**
     * @OA\Get(
     *      path="/api/contact/{id}",
     *      tags={"Contact"},
     *      summary="List a contact by ID",
     *      @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Contact ID",
     *         @OA\Schema(type="integer")
     *      ),
     *      @OA\Response(
     *          response="200", 
     *          description="Contact data",
     *          @OA\JsonContent(ref="#/components/schemas/Contact")
     *      ),
     *      @OA\Response(
     *          response="404", 
     *          description="Record not found",
     *          @OA\JsonContent(ref="#/components/schemas/ApiErrorDTO")
     *      )
     * )
     */
    public function show(int $id): JsonResponse {
        $contact = $this->contactService->getById($id);
        return response()->json($contact, 200);
    }

    /**
     * @OA\Post(
     *      path="/api/contact",
     *      tags={"Contact"},
     *      summary="Registers a contact",
     *      @OA\RequestBody(
     *         required=true,
     *         description="Data for creating a new contact",
     *         @OA\JsonContent(ref="#/components/schemas/ContactRequest")
     *      ),
     *      @OA\Response(
     *          response="201", 
     *          description="Registered contact data",
     *          @OA\JsonContent(ref="#/components/schemas/Contact")
     *      ),
     *      @OA\Response(
     *          response="401", 
     *          description="Unauthorized",
     *          @OA\JsonContent(ref="#/components/schemas/ApiErrorDTO")
     *      )
     * )
     */
    public function store(ContactRequest $request): JsonResponse {
        $contact = $this->contactService->create($request->all());
        return response()->json($contact, 201);
    }

    /**
     * @OA\Put(
     *      path="/api/contact/{id}",
     *      tags={"Contact"},
     *      summary="Update a contact",
     *      @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Contact ID",
     *         @OA\Schema(type="integer")
     *      ),
     *      @OA\RequestBody(
     *         required=true,
     *         description="Data for update contact",
     *         @OA\JsonContent(ref="#/components/schemas/ContactRequest")
     *      ),
     *      @OA\Response(
     *          response="200", 
     *          description="Updated contact data",
     *          @OA\JsonContent(ref="#/components/schemas/Contact")
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
    public function update(int $id, ContactRequest $request): JsonResponse {
        $contact = $this->contactService->update($id, $request->all());
        return response()->json($contact, 200);
    }

    /**
     * @OA\Delete(
     *      path="/api/contact/{id}",
     *      tags={"Contact"},
     *      summary="Delete a contact",
     *      @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Contact ID",
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
        $this->contactService->deleteById($id);
        return response()->noContent();
    }
}
