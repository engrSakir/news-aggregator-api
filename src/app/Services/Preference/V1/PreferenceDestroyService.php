<?php

namespace App\Services\Preference\V1;

use App\Models\V1\Preference;
use App\Services\Service;

class PreferenceDestroyService extends Service
{
    public function handle($id): array
    {
        return $this->execute(function () use ($id) {
            $preference = Preference::findOrFail($id);
            $preference->delete();
            return [];
        });
    }
}
