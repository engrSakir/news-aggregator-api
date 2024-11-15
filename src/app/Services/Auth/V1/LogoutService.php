<?php

namespace App\Services\Auth\V1;

class LogoutService
{
    public function handle($request): array
    {
        $request->user()->currentAccessToken()->delete();
        return ['message' => 'Logged out successfully.'];
    }
}
