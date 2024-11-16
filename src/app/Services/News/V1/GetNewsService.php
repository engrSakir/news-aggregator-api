<?php

namespace App\Services\News\V1;

use App\Models\V1\Article;
use App\Services\Preference\V1\PreferenceGetService;
use App\Services\Service;

class GetNewsService extends Service
{
    public function handle(array $requestData): array
    {
        return $this->execute(function () use ($requestData) {
            return $this->getArticles($requestData);
        });
    }

    private function getArticles($requestData): object
    {
        $query = Article::query();
        $query->select('id', 'title', 'category', 'author', 'published_at', 'keywords', 'title', 'description', 'url');
        if (!empty($requestData['preference'])) {
            $preferences = $this->getQueryPreference();
            foreach ($preferences as $key => $values) {
                if (!empty($values)) {
                    $query->orWhereIn($key, $values);
                }
            }
        }

        if (!empty($requestData['keyword'])) {
            $query->where('keywords', 'like', '%' . $requestData['keyword'] . '%');
        }

        if (!empty($requestData['date'])) {
            $query->whereDate('published_at', $requestData['date']);
        }

        if (!empty($requestData['category'])) {
            $query->where('category', $requestData['category']);
        }

        if (!empty($requestData['source'])) {
            $query->where('source', $requestData['source']);
        }

        return $query->orderBy('published_at', 'desc')
            ->simplePaginate($requestData['per_page'] ?? 10);
    }

    private function getQueryPreference(): array
    {
        $preferences = (new PreferenceGetService())->handle();
        return collect($preferences['data'])->groupBy('type')
            ->map(fn($items) => $items->pluck('value')->all())
            ->toArray();
    }
}
