<?php

namespace App\Jobs;

use App\Models\Article;
use App\Services\News\V1\NewsAggregatorService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Foundation\Bus\Dispatchable;

class FetchNewsJob// implements ShouldQueue
{
    use Dispatchable, Queueable; // Use Dispatchable here
    protected NewsAggregatorService $newsAggregatorService;

    public function __construct(NewsAggregatorService $newsAggregatorService)
    {
        $this->newsAggregatorService = $newsAggregatorService;
    }

    public function handle()
    {
       return $this->newsAggregatorService->fetchAllArticles();
    }
}
