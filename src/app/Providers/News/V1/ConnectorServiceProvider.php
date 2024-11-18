<?php

namespace App\Providers\News\V1;

use Illuminate\Support\ServiceProvider;
use App\Connectors\News\V1\NewsConnector;

class ConnectorServiceProvider extends ServiceProvider
{
    /**
     * @return void
     */
    public function register(): void
    {
        $this->app->singleton(NewsConnector::class, function () {
            return new NewsConnector();
        });
    }
}
