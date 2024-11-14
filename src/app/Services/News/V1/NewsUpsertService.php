<?php
namespace App\Services\News\V1;

use App\Models\Article;

class NewsUpsertService
{
    public function upsert(): array
    {
        $articles = app()->make(NewsAggregatorService::class)->fetchAllArticlesAsync();

        Article::upsert($articles, ['url'], ['title', 'description', 'source', 'published_at', 'updated_at']);

        return Article::all()->toArray();
    }
}
