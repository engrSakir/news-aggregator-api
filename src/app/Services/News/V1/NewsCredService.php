<?php
namespace App\Services\News\V1;

use App\Connectors\News\V1\NewsConnector;

class NewsCredService
{
    protected $connector;
    protected $apiKey;

    public function __construct(NewsConnector $connector)
    {
        $this->connector = $connector;
        $this->apiKey = config('services.newscred.key');
    }

    /**
     * Fetch articles from NewsCred API.
     *
     * @return array Formatted article data.
     */
    public function fetchArticles(): array
    {
        $url = 'https://newscredapi.com/v1/articles';
        $params = [
            'region' => 'global',
            'apiKey' => $this->apiKey,
        ];

        $response = $this->connector->fetchData($url, $params);

        // Process and return data in a consistent format
        $articles = [];
        foreach ($response['articles'] as $article) {
            $articles[] = [
                'title' => $article['title'],
                'description' => $article['body'],
                'url' => $article['url'],
                'source' => 'NewsCred',
                'published_at' => $article['published'],
            ];
        }

        return $articles;
    }
}
