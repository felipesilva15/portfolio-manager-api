<?php

namespace App\Exceptions;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;

class BussinessRuleException extends HttpException
{
    public function __construct(string $message, array $headers = []) {
        parent::__construct(422, $message, null, $headers, 422);
    }

    public function render(Request $request): JsonResponse {
        return response()->json([
            'path' => $request->path(),
            'code' => $this->code,
            'message' => $this->message
        ], $this->code);
    }
}
