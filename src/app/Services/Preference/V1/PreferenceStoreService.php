<?php

namespace App\Services\Preference\V1;

use App\Services\Service;

class PreferenceStoreService extends Service
{
    public function handle(array $requestData): array
    {
        return $this->execute(function () use ($requestData) {
            return auth()->user()->preferences()->create($requestData);
        });
    }
}
