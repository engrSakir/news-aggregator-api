<?php

namespace App\Services\News\V1;

use App\Connectors\News\V1\NewsConnector;

class NewsAPIService
{
    protected $connector;
    protected $apiKey;

    public function __construct(NewsConnector $connector)
    {
        $this->connector = $connector;
//        $this->apiKey = config('services.newsapi.key');
        $this->apiKey = '5d9f41ea13784fac9be4a091f8295021';
    }

    /**
     * Fetch articles from NewsAPI.
     *
     * @return array Formatted article data.
     */
    public function fetchArticles(): array
    {
        $url = 'https://newsapi.org/v2/top-headlines';
        $params = [
            'country' => 'us',
            'apiKey' => $this->apiKey,
        ];

        $response = $this->connector->fetchData($url, $params);

        // Process and return data in a consistent format
        $articles = [];
        foreach ($response['articles'] as $article) {
            $articles[] = [
                'title' => $article['title'],
                'description' => $article['description'],
                'url' => $article['url'],
                'source' => 'NewsAPI',
                'published_at' => $article['publishedAt'],
            ];
        }

        return $articles;
    }
}
