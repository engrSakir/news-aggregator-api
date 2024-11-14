<?php

namespace App\Jobs\V1;

use App\Services\News\V1\NewsAggregatorService;
use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;

class FetchNewsJob// implements ShouldQueue
{
    use Dispatchable, Queueable; // Use Dispatchable here

    public function handle()
    {
        return app()->make(NewsAggregatorService::class)->fetchAllArticlesAsync();
    }
}
