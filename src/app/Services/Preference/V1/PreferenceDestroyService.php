<?php

namespace App\Services\Preference\V1;

use App\Enums\News\V1\NewsEnum;
use App\Models\V1\Preference;
use App\Services\Service;
use Illuminate\Support\Facades\Cache;

class PreferenceDestroyService extends Service
{
    public function handle($id): array
    {
        return $this->execute(function () use ($id) {
            $preference = Preference::findOrFail($id);
            $preference->delete();
            Cache::forget(NewsEnum::NEWS_PREFERENCE_CACHE_PREFIX . auth()->id());
            return [];
        });
    }
}
