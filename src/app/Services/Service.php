<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;
use Throwable;

class Service
{
    /**
     * Handle a callable operation with standardized response.
     *
     * @param callable $operation
     * @return array
     */
    protected function execute(callable $operation): array
    {
        try {
            $data = $operation();
            if (!empty($data['code'])) {
                return $data;
            }
            return $this->successResponse('Successfully done', $data);
        } catch (Throwable $e) {
            Log::error('An unexpected error occurred: ' . $e->getMessage(), ['exception' => $e]);
            return $this->errorResponse('An unexpected error occurred: ' . $e->getMessage(), 500);
        }
    }

    /**
     * Standardized success response.
     *
     * @param string $message
     * @param mixed $data
     * @return array
     */
    protected function successResponse(string $message, mixed $data = [], int $code = 200): array
    {
        return [
            'status' => 'success',
            'message' => $message,
            'data' => $data,
            'code' => $code,
        ];
    }

    /**
     * Standardized error response.
     *
     * @param string $message
     * @param int $code
     * @return array
     */
    protected function errorResponse(string $message, int $code): array
    {
        return [
            'status' => 'failed',
            'message' => $message,
            'data' => [],
            'code' => $code,
        ];
    }
}
