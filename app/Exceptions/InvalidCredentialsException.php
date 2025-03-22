<?php

namespace App\Exceptions;

use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;

class InvalidCredentialsException extends HttpException
{
    public function __construct(string $message = 'Credenciais inválidas.', int $code = 401, array $headers = []) {
        parent::__construct($code, $message, null, $headers, $code);
    }

    public function render(Request $request) {
        return response()->json([
            'path' => $request->path(),
            'code' => $this->code,
            'message' => $this->message
        ], $this->code);
    }
}
