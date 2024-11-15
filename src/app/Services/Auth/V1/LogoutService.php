<?php

namespace App\Services\Auth\V1;

use App\Models\V1\Preference;
use App\Services\Service;

class LogoutService extends Service
{
    public function handle(): array
    {
        return $this->execute(function () {
            request()->user()->currentAccessToken()->delete();
            return $this->successResponse('Logged out successfully.');
        });
    }
}
