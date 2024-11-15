<?php

namespace App\Services;

use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;

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
            // Execute the operation
            $data = $operation();

            // Return success response
            return $this->successResponse('Operation completed successfully', $data);
        } catch (ModelNotFoundException $e) {
            // Handle not found exception
            return $this->errorResponse('Resource not found', 404);
        } catch (Exception $e) {
            // Handle other exceptions
            return $this->errorResponse('An error occurred: ' . $e->getMessage(), 500);
        }
    }

    /**
     * Standardized success response.
     *
     * @param string $message
     * @param mixed $data
     * @return array
     */
    protected function successResponse(string $message, $data = []): array
    {
        return [
            'status' => 'success',
            'message' => $message,
            'data' => $data,
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
