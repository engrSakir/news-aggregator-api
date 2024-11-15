<?php

namespace App\Services\Preference\V1;

use App\Services\Service;

class PreferenceGetService extends Service
{
    public function handle(): array
    {
        return $this->execute(function () {
            return auth()->user()->preferences()
                ->get()
                ->groupBy('type')
                ->map(function ($group) {
                    return $group->pluck('value');
                })->toArray();
        });
    }
}
