<?php

namespace App\Services\Auth\V1;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Password;

class PasswordResetEmailService
{
    /**
     * @param $request
     * @return JsonResponse
     */
    public function handle($request): JsonResponse
    {
        $status = Password::sendResetLink($request->only('email'));
        return $status === Password::RESET_LINK_SENT
            ? response()->json(['message' => 'Password reset link sent.'])
            : response()->json(['message' => 'Failed to send password reset link.'], 500);
    }
}
