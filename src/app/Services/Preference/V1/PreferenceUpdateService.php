<?php

namespace App\Services\Preference\V1;

use App\Enums\News\V1\NewsEnum;
use App\Models\V1\Preference;
use App\Services\Service;
use Illuminate\Support\Facades\Cache;

class PreferenceUpdateService extends Service
{
    public function handle(array $requestData, $id): array
    {
        return $this->execute(function () use ($requestData, $id) {
            $preference = Preference::findOrFail($id);
            $preference->update($requestData);
            Cache::forget(NewsEnum::NEWS_PREFERENCE_CACHE_PREFIX . auth()->id());
            return $requestData;
        });
    }
}
