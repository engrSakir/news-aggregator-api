<?php

namespace App\Jobs\News\V1;

use App\Services\News\V1\NewsAggregatorService;
use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;

class FetchNewsJob// implements ShouldQueue
{
    use Dispatchable, Queueable; // Use Dispatchable here

    /**
     * @return void
     */
    public function handle(): void
    {
        (new NewsAggregatorService())->fetchAllArticlesAsync();
    }
}
