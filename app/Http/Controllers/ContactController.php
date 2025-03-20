<?php

namespace App\Http\Controllers;

use App\Http\Requests\Contact\StoreContactRequest;
use App\Http\Requests\Contact\UpdateContactRequest;
use App\Services\ContactService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class ContactController
{
    protected ContactService $contactService;

    public function __construct(ContactService $contactService) {
        $this->contactService = $contactService;
    }

    public function index(): JsonResponse {
        $contacts = $this->contactService->getAll();
        return response()->json($contacts, 200);
    }

    public function show($id): JsonResponse {
        $contact = $this->contactService->getById($id);
        return response()->json($contact, 200);
    }

    public function store(StoreContactRequest $request): JsonResponse {
        $contact = $this->contactService->create($request->all());
        return response()->json($contact, 201);
    }

    public function update(int $id, UpdateContactRequest $request): JsonResponse {
        $contact = $this->contactService->update($id, $request->all());
        return response()->json($contact, 200);
    }

    public function destroy(int $id): Response {
        $this->contactService->deleteById($id);
        return response()->noContent();
    }
}
