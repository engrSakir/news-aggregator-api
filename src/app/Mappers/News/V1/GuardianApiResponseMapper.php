<?php

namespace App\Mappers\News\V1;

use App\DTOs\News\V1\ArticleDTO;
use App\Traits\V1\KeywordExtractor;
use Carbon\Carbon;

class GuardianApiResponseMapper
{
    use KeywordExtractor;
    public function map($responsePages): array
    {
        $articles = [];
        foreach ($responsePages as $page) {
            foreach ($page['response']['results'] ?? [] as $article) {
                $dto = new ArticleDTO(
                    'The Guardian',
                    $article['sectionName'],
                    $article['fields']['byline'] ?? '',
                    Carbon::parse($article['webPublicationDate']),
                    $this->extractKeywords($article['webTitle'], 'string'),
                    $article['webTitle'],
                    $article['fields']['bodyText'],
                    $article['webUrl'],
                );
                $articles[] = $dto->arrayData();
            }
        }
        return $articles;
    }
}
