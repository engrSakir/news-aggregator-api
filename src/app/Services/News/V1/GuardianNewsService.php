<?php
namespace App\Services\News\V1;

use App\Connectors\News\V1\NewsConnector;

class GuardianNewsService
{
    protected $connector;
    protected $apiKey;

    public function __construct(NewsConnector $connector)
    {
        $this->connector = $connector;
//        $this->apiKey = config('services.guardian.key');
        $this->apiKey = 'ca371f06-7ecd-491c-ba03-23e3ae51196d';
    }

    /**
     * Fetch articles from The Guardian API.
     *
     * @return array Formatted article data.
     */
    public function fetchArticles(): array
    {
        // Set the API endpoint and query parameters
        $url = 'https://content.guardianapis.com/search';
        $params = [
            'order-by' => 'newest',
            'show-fields' => 'all',
            'page-size' => 10, // Number of articles to fetch
            'api-key' => $this->apiKey,
        ];

        // Use the existing connector to fetch data
        $response = $this->connector->fetchData($url, $params);

        // Process and return data in a consistent format
        $articles = [];
        foreach ($response['response']['results'] as $article) {
            $articles[] = [
                'title' => $article['webTitle'],
                'description' => $article['fields']['trailText'] ?? '',
                'url' => $article['webUrl'],
                'source' => 'The Guardian',
                'published_at' => $article['webPublicationDate'],
            ];
        }

        return $articles;
    }
}
