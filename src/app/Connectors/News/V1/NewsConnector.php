<?php
namespace App\Connectors\News\V1;

use GuzzleHttp\Client;

class NewsConnector
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client();
    }

    /**
     * Send a GET request to the specified endpoint with the given parameters.
     *
     * @param string $url The API endpoint URL.
     * @param array $params Query parameters for the request.
     * @return array The decoded JSON response.
     * @throws \Exception
     */
    public function fetchData(string $url, array $params = []): array
    {
        try {
            $response = $this->client->get($url, ['query' => $params]);
            return json_decode($response->getBody()->getContents(), true);
        } catch (\Exception $e) {
            throw new \Exception("Error fetching data: " . $e->getMessage());
        }
    }
}
