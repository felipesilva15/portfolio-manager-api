<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Services\ContactService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    protected ContactService $contactService;

    public function __construct(Request $request, Contact $model, ContactService $contactService) {
        $this->model = $model;
        $this->request = $request;
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
}
