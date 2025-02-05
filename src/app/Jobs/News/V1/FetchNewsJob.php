<?php

namespace App\Jobs\News\V1;

use App\Services\News\V1\NewsAggregatorService;
use Illuminate\Foundation\Bus\Dispatchable;

class FetchNewsJob
{
    use Dispatchable;

    /**
     * @return void
     */
    public function handle(): void
    {
        (new NewsAggregatorService())->fetchAllArticlesAsync();
    }
}
