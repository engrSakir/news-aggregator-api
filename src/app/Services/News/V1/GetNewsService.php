<?php

namespace App\Services\News\V1;

use App\Models\V1\Article;
use App\Repositories\News\V1\ArticleRepositoryInterface;
use App\Services\Preference\V1\PreferenceGetService;
use App\Services\Service;

class GetNewsService extends Service
{
    protected ArticleRepositoryInterface $articleRepository;

    public function __construct(ArticleRepositoryInterface $articleRepository)
    {
        $this->articleRepository = $articleRepository;
    }

    public function handle(array $requestData): array
    {
        return $this->execute(function () use ($requestData) {
            return $this->articleRepository->getAll($requestData);
        });
    }
}
