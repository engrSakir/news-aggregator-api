<?php

namespace App\Services\Preference\V1;

use App\Models\V1\Preference;
use App\Services\Service;

class PreferenceUpdateService extends Service
{
    public function handle(array $requestData, $id): array
    {
        return $this->execute(function () use ($requestData, $id) {
            $preference = Preference::findOrFail($id);
            $preference->update($requestData);
            return $requestData;
        });
    }
}
