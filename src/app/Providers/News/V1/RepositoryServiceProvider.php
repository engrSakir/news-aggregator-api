<?php


namespace App\Providers\News\V1;

use App\Repositories\News\V1\ArticleRepository;
use App\Repositories\News\V1\ArticleRepositoryInterface;
use Illuminate\Support\ServiceProvider;


class RepositoryServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(ArticleRepositoryInterface::class, ArticleRepository::class);
    }
}
