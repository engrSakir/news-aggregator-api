<?php

namespace App\Services\Preference\V1;

use App\Enums\News\V1\NewsEnum;
use App\Services\Service;
use Illuminate\Support\Facades\Cache;

class PreferenceGetService extends Service
{
    public function handle(): array
    {
        return $this->execute(function () {
            return Cache::remember(
                NewsEnum::NEWS_PREFERENCE_CACHE_PREFIX . auth()->id(),
                NewsEnum::NEWS_PREFERENCE_CACHE_DURATION,
                function () {
                    return auth()->user()->preferences()
                        ->get(['id', 'user_id', 'type', 'value'])
                        ->toArray();
                });
        });
    }
}
