<?php

namespace App\Mappers\News\V1;

use App\DTOs\News\V1\ArticleDTO;

class NyTimesApiResponseMapper
{
    public function map($responses): array
    {
        $articles = [];
        foreach ($responses as $response) {
            foreach ($response['response']['docs'] ?? [] as $article) {
                $dto = new ArticleDTO(
                    $article['abstract'],
                    $article['lead_paragraph'],
                    $article['web_url'],
                    'nytimes',
                    $article['pub_date']
                );
                $articles[] = $dto->arrayData();
            }
        }
        return $articles;
    }
}
