<?php

namespace App\Services\News\V1;

use App\Services\News\V1\NewsAPIService;
use App\Services\News\V1\OpenNewsService;
use App\Services\News\V1\NewsCredService;

class NewsAggregatorService
{
    protected $newsAPIService;
    protected $openNewsService;
    protected $newsCredService;
    protected $guardianNewsService;
    protected $newsAggregatorService;

    public function __construct(
        NewsAPIService $newsAPIService,
        OpenNewsService $openNewsService,
        NewsCredService $newsCredService,
        GuardianNewsService $guardianNewsService,
        \App\Services\News\V2\NewsAggregatorService $newsAggregatorService,
    ) {
        $this->newsAPIService = $newsAPIService;
        $this->openNewsService = $openNewsService;
        $this->newsCredService = $newsCredService;
        $this->guardianNewsService = $guardianNewsService;
        $this->newsAggregatorService = $newsAggregatorService;
    }

    /**
     * Fetch articles from all news sources and merge them.
     *
     * @return array Merged articles from all sources.
     */
    public function fetchAllArticles(): array
    {
        return array_merge(
//            $this->newsAPIService->fetchArticles(),
//            $this->openNewsService->fetchArticles(),
//            $this->newsCredService->fetchArticles(),
//            $this->guardianNewsService->fetchArticles(),
            $this->newsAggregatorService->fetchAllArticlesAsync(),
        );
    }
}
