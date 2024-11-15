<?php

namespace App\Mappers\News\V1;

use App\DTOs\News\V1\ArticleDTO;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class NyTimesApiResponseMapper
{
    /**
     * @param array $responses
     * @return array
     */
    public function map(array $responses): array
    {
        $articles = [];
        foreach ($responses as $response) {
            foreach ($response['response']['docs'] ?? [] as $article) {
                $dto = new ArticleDTO(
                    'The New York Times',
                    $article['news_desk'],
                    $article['byline']['original'] ?? '',
                    Carbon::parse($article['pub_date']),
                    $this->getKeywords($article['keywords']),
                    $article['abstract'],
                    $article['lead_paragraph'],
                    $article['web_url'],
                );
                $articles[] = $dto->arrayData();
            }
        }
        return $articles;
    }

    /**
     * Get only the first 10 items as comma seperated string
     * @param array $keywords
     * @return string
     */
    private function getKeywords(array $keywords): string
    {
        $values = array_column($keywords, 'value');
        $limitedValues = array_slice($values, 0, 10);
        $convertedString = implode(',', $limitedValues);

        if (strlen($convertedString) <= 255) {
            return $convertedString;
        }

        // Log the error if the value is invalid
        Log::warning('NyTimes Keywords - Value exceeds maximum length for string column.', [
            'value' => $convertedString,
            'length' => strlen($convertedString),
        ]);

        // Return an empty string
        return '';
    }
}
