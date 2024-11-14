<?php
namespace App\Services\News\V1;

use App\Connectors\News\V1\NewsConnector;

class NewsAggregatorService
{
    public function fetchAllArticlesAsync(): array
    {
        // Define API requests for different news sources
        $requests = [
            'newsAPI' => [
                'url' => 'https://newsapi.org/v2/top-headlines',
                'params' => [
                    'country' => 'us',
                    'apiKey' => '5d9f41ea13784fac9be4a091f8295021',
                ],
            ],
            'guardian' => [
                'url' => 'https://content.guardianapis.com/search',
                'params' => [
                    'order-by' => 'newest',
                    'show-fields' => 'all',
                    'page-size' => 10,
                    'api-key' => 'ca371f06-7ecd-491c-ba03-23e3ae51196d',
                ],
            ],
//            'openNews' => [
//                'url' => 'https://opennewsapi.org/v2/articles',
//                'params' => [
//                    'language' => 'en',
//                    'apiKey' => config('services.opennews.key'),
//                ],
//            ],
//            'newsCred' => [
//                'url' => 'https://newscredapi.com/v1/articles',
//                'params' => [
//                    'region' => 'global',
//                    'apiKey' => config('services.newscred.key'),
//                ],
//            ],

        ];

        // Perform the asynchronous requests
        $responses = app()->make(NewsConnector::class)->fetchDataAsync($requests);

        // Process and merge the results into a single articles array
        $allArticles = [];

        // Process each response and map it to a consistent format
        foreach ($responses as $source => $response) {
            if ($source == 'newsAPI' && isset($response['articles'])) {
                foreach ($response['articles'] as $article) {
                    $allArticles[] = [
                        'title' => $article['title'],
                        'description' => $article['description'],
                        'url' => $article['url'],
                        'source' => 'NewsAPI',
                        'published_at' => $article['publishedAt'],
                    ];
                }
            } elseif ($source == 'openNews' && isset($response['data'])) {
                foreach ($response['data'] as $article) {
                    $allArticles[] = [
                        'title' => $article['headline'],
                        'description' => $article['summary'],
                        'url' => $article['link'],
                        'source' => 'OpenNews',
                        'published_at' => $article['date'],
                    ];
                }
            } elseif ($source == 'newsCred' && isset($response['articles'])) {
                foreach ($response['articles'] as $article) {
                    $allArticles[] = [
                        'title' => $article['title'],
                        'description' => $article['body'],
                        'url' => $article['url'],
                        'source' => 'NewsCred',
                        'published_at' => $article['published'],
                    ];
                }
            } elseif ($source == 'guardian' && isset($response['response']['results'])) {
                foreach ($response['response']['results'] as $article) {
                    $allArticles[] = [
                        'title' => $article['webTitle'],
                        'description' => $article['fields']['trailText'] ?? '',
                        'url' => $article['webUrl'],
                        'source' => 'The Guardian',
                        'published_at' => $article['webPublicationDate'],
                    ];
                }
            }
        }

        return $allArticles;
    }
}
