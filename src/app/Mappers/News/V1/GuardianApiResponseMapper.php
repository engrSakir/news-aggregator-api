<?php

namespace App\Mappers\News\V1;

use App\DTOs\News\V1\ArticleDTO;

class GuardianApiResponseMapper
{
    public function map($responses): array
    {
        $articles = [];
        foreach ($responses as $response) {
            foreach ($response['response']['results'] ?? [] as $article) {
                $dto = new ArticleDTO(
                    $article['webTitle'],
                    $article['fields']['bodyText'],
                    $article['webUrl'],
                    'GuardianApi',
                    $article['webPublicationDate']
                );
                $articles[] = $dto->arrayData();
            }
        }
        return $articles;
    }
}
