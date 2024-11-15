<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;

abstract class Controller
{
    protected function response(array $data, $code = 200): JsonResponse
    {
        $code = $data['code'] ?? $code;
        unset($data['code']);
        return response()->json($data, $code);
    }
}
