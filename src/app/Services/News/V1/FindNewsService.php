<?php

namespace App\Services\News\V1;

use App\Models\V1\Article;
use App\Services\Service;

class FindNewsService extends Service
{
    public function handle(int $id): array
    {
        return $this->execute(function () use ($id) {
            $query = Article::query();
            $query->select('id', 'title', 'category', 'author', 'published_at', 'keywords', 'title', 'description', 'url');
            return $query->find($id);
        });
    }
}
