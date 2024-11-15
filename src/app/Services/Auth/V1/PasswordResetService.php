<?php

namespace App\Services\Auth\V1;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Password;

class PasswordResetService
{
    /**
     * @param $request
     */
    public function handle($request): JsonResponse
    {
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => bcrypt($password),
                ])->save();
            }
        );

        return $status === Password::PASSWORD_RESET
            ? response()->json(['message' => __($status)], 200)
            : response()->json(['email' => __($status)], 400);
    }
}
