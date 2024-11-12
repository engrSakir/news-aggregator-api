<?php

namespace App\Services\Auth\V1;

use Password;

class PasswordResetEmailService
{
    public function handle($request)
    {
        $status = Password::sendResetLink($request->only('email'));

        return $status === Password::RESET_LINK_SENT
            ? response()->json(['message' => 'Password reset link sent.'])
            : response()->json(['message' => 'Failed to send password reset link.'], 500);
    }
}
