<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Connectors\News\V1\NewsConnector;
use App\Services\News\V1\NewsAggregatorService;

class NewsServiceProvider extends ServiceProvider
{
    public function register()
    {
        // Bind the shared connector
        $this->app->singleton(NewsConnector::class, function () {
            return new NewsConnector();
        });

        $this->app->singleton(NewsAggregatorService::class, function ($app) {
            return new NewsAggregatorService($app->make(NewsConnector::class));
        });
    }
}
