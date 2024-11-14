<?php
namespace App\Services\News\V1;

use App\Models\Article;

class NewsUpsertService
{
    public function upsert(): array
    {
        $articles = app()->make(NewsAggregatorService::class)->fetchAllArticlesAsync();

        foreach ($articles as $article) {
            Article::create($article);
        }

//        return $articles;
        return Article::all()->toArray();
    }
}
