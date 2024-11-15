<?php

namespace App\Mappers\News\V1;

use App\DTOs\News\V1\ArticleDTO;
use App\Traits\V1\KeywordExtractor;
use Carbon\Carbon;

class NewsApiResponseMapper
{
    use KeywordExtractor;
    public function map($responses): array
    {
        $articles = [];
        foreach ($responses as $response) {
            foreach ($response['articles'] ?? [] as $article) {
                $dto = new ArticleDTO(
                    'News API',
                    '',
                    $article['author'] ?? '',
                    Carbon::parse($article['publishedAt']),
                    $this->extractKeywords($article['title'], 'string'),
                    $article['title'],
                    $article['content'],
                    $article['url'],
                );
                $articles[] = $dto->arrayData();
            }
        }
        return $articles;
    }
}
