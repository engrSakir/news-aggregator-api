<?php

namespace App\Providers;

use App\Services\News\V1\GuardianNewsService;
use Illuminate\Support\ServiceProvider;
use App\Connectors\News\V1\NewsConnector;
use App\Services\News\V1\NewsAPIService;
use App\Services\News\V1\OpenNewsService;
use App\Services\News\V1\NewsCredService;
use App\Services\News\V1\NewsAggregatorService;

class NewsServiceProvider extends ServiceProvider
{
    public function register()
    {
        // Bind the shared connector
        $this->app->singleton(NewsConnector::class, function () {
            return new NewsConnector();
        });

        $this->app->singleton(\App\Services\News\V1\NewsAggregatorService::class, function ($app) {
            return new \App\Services\News\V1\NewsAggregatorService($app->make(\App\Connectors\News\V2\NewsConnector::class));
        });

        // Bind the aggregator service with all individual services
        $this->app->singleton(NewsAggregatorService::class, function ($app) {
            return new NewsAggregatorService(
                [
                    $app->make(NewsAPIService::class),
//                    $app->make(OpenNewsService::class),
//                    $app->make(NewsCredService::class),
                    $app->make(GuardianNewsService::class),
//                    $app->make(\App\Services\News\V2\NewsAggregatorService::class)
                ]
            );
        });
    }
}
