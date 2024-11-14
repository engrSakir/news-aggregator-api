<?php

namespace App\Providers\News\V1;

use App\Services\News\V1\NewsUpsertService;
use Illuminate\Support\ServiceProvider;
use App\Connectors\News\V1\NewsConnector;
use App\Services\News\V1\NewsAggregatorService;

class NewsServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(NewsConnector::class, function () {
            return new NewsConnector();
        });
    }
}
