<?php

namespace App\Services\Auth\V1;

class LogoutService
{
    public function handle($request)
    {
        // Logout only from the current device
        $request->user()->currentAccessToken()->delete();

        return ['message' => 'Logged out successfully.'];
    }
}
