<?php

namespace App\Services\Preference\V1;

use App\Enums\News\V1\NewsEnum;
use App\Services\Service;
use Illuminate\Support\Facades\Cache;

class PreferenceStoreService extends Service
{
    public function handle(array $requestData): array
    {
        return $this->execute(function () use ($requestData) {
            Cache::forget(NewsEnum::NEWS_PREFERENCE_CACHE_PREFIX . auth()->id());
            return auth()->user()->preferences()->create($requestData);
        });
    }
}
