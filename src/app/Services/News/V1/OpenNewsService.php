<?php
namespace App\Services\News\V1;

use App\Connectors\News\V1\NewsConnector;

class OpenNewsService
{
    protected $connector;
    protected $apiKey;

    public function __construct(NewsConnector $connector)
    {
        $this->connector = $connector;
        $this->apiKey = config('services.opennews.key');
    }

    /**
     * Fetch articles from OpenNews API.
     *
     * @return array Formatted article data.
     */
    public function fetchArticles(): array
    {
        $url = 'https://opennewsapi.org/v2/articles';
        $params = [
            'language' => 'en',
            'apiKey' => $this->apiKey,
        ];

        $response = $this->connector->fetchData($url, $params);

        // Process and return data in a consistent format
        $articles = [];
        foreach ($response['data'] as $article) {
            $articles[] = [
                'title' => $article['headline'],
                'description' => $article['summary'],
                'url' => $article['link'],
                'source' => 'OpenNews',
                'published_at' => $article['date'],
            ];
        }

        return $articles;
    }
}
