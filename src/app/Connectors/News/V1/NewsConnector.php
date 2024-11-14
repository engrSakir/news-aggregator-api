<?php
namespace App\Connectors\News\V1;

use Illuminate\Support\Facades\Http;

class NewsConnector
{
    /**
     * Send multiple asynchronous GET requests using Laravel HTTP client’s pool.
     *
     * @param array $requests An array of requests, each with a URL and parameters.
     * @return array An array of decoded JSON responses.
     */
    public function fetchDataAsync(array $requests): array
    {
        $responses = Http::pool(function ($pool) use ($requests) {
            $handles = [];

            foreach ($requests as $key => $request) {
                $handles[$key] = $pool->as($key)->get($request['url'], $request['params']);
            }

            return $handles;
        });

        // Process and return the responses in JSON
        $results = [];
        foreach ($responses as $key => $response) {
            $results[$key] = $response->json();
        }

        return $results;
    }
}
