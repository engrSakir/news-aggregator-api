<?php

namespace App\Services\Auth\V1;

use App\Services\Service;
use Illuminate\Support\Facades\Password;

class PasswordResetEmailService extends Service
{
    public function handle(array $requestData): array
    {
        return $this->execute(operation: function () use ($requestData) {
            $status = Password::sendResetLink($requestData);
            return $status === Password::RESET_LINK_SENT
                ? $this->successResponse('Password reset link sent')
                :  $this->errorResponse('Failed to send password reset link.', 500);
        });
    }
}
