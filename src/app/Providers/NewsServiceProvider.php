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

        // Bind each service, passing in the shared connector
        $this->app->singleton(NewsAPIService::class, function ($app) {
            return new NewsAPIService($app->make(NewsConnector::class));
        });

        $this->app->singleton(OpenNewsService::class, function ($app) {
            return new OpenNewsService($app->make(NewsConnector::class));
        });

        $this->app->singleton(NewsCredService::class, function ($app) {
            return new NewsCredService($app->make(NewsConnector::class));
        });

        $this->app->singleton(GuardianNewsService::class, function ($app) {
            return new GuardianNewsService($app->make(NewsConnector::class));
        });

        $this->app->singleton(\App\Services\News\V2\NewsAggregatorService::class, function ($app) {
            return new \App\Services\News\V2\NewsAggregatorService($app->make(\App\Connectors\News\V2\NewsConnector::class));
        });

        // Bind the aggregator service with all individual services
        $this->app->singleton(NewsAggregatorService::class, function ($app) {
            return new NewsAggregatorService(
                $app->make(NewsAPIService::class),
                $app->make(OpenNewsService::class),
                $app->make(NewsCredService::class),
                $app->make(GuardianNewsService::class),
                $app->make(\App\Services\News\V2\NewsAggregatorService::class),
            );
        });
    }
}
