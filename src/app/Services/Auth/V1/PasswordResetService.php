<?php

namespace App\Services\Auth\V1;

use App\Services\Service;
use Illuminate\Support\Facades\Password;

class PasswordResetService extends Service
{
    public function handle(array $requestData): array
    {
        return $this->execute(operation: function () use ($requestData) {
            $status = Password::reset(
                $requestData,
                function ($user, $password) {
                    $user->forceFill([
                        'password' => bcrypt($password),
                    ])->save();
                }
            );

            return $status === Password::PASSWORD_RESET
                ? $this->successResponse(__($status))
                : $this->errorResponse(__($status), 400);
        });
    }
}
