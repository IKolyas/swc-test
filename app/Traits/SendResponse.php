<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;

trait SendResponse
{
    private function successResponse($data, $code = 200): JsonResponse
    {
        return response()->json(['error' => null, 'result' => $data], $code);
    }

    private function failedResponse(string $message, $code = 400): JsonResponse
    {
        return response()->json(['error' => $message, 'result' => null], $code);
    }
}