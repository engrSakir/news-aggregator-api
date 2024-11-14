<?php

namespace App\Mappers\News\V1;

use App\DTOs\News\V1\ArticleDTO;

class NewsApiResponseMapper
{
    public function map($responses): array
    {
        $articles = [];
        foreach ($responses as $response) {
            foreach ($response['articles'] ?? [] as $article) {
                $dto = new ArticleDTO(
                    $article['title'],
                    $article['description'],
                    $article['url'],
                    'NewsApi',
                    $article['publishedAt']
                );
                $articles[] = $dto->arrayData();
            }
        }
        return $articles;
    }
}
