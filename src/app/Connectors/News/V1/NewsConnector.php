<?php
namespace App\Connectors\News\V1;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Exception;

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
        try {
            $responses = Http::pool(function ($pool) use ($requests) {
                $handles = [];

                foreach ($requests as $key => $request) {
                    $pageCoverage = $request['page_coverage'] ?? 1;

                    for ($page = 1; $page <= $pageCoverage; $page++) {
                        $request['params']['page'] = $page;
                        $handles[$key][] = $pool->as("$key-$page")->get($request['url'], $request['params']);
                    }
                }

                return $handles;
            });

            return $this->processResponses($responses);

        } catch (Exception $e) {
            // Log the error if the HTTP pool fails
            Log::error("Failed to fetch data asynchronously: " . $e->getMessage(), [
                'requests' => $requests,
                'exception' => $e
            ]);
            return [];
        }
    }

    /**
     * Process and structure the responses.
     *
     * @param array $responses The array of responses from the HTTP client pool.
     * @return array Structured array of decoded JSON responses.
     */
    private function processResponses(array $responses): array
    {
        $results = [];

        foreach ($responses as $key => $response) {
            try {
                list($type, $page) = explode('-', $key);
                $results[$type][$page] = $response->successful() ? $response->json() : [];

                if (!$response->successful()) {
                    Log::warning("Unsuccessful response for {$key}", [
                        'response_status' => $response->status(),
                        'response_body' => $response->body(),
                    ]);
                }
            } catch (Exception $e) {
                // Log the error if processing fails for a specific response
                Log::error("Error processing response for {$key}: " . $e->getMessage(), [
                    'key' => $key,
                    'response' => $response,
                    'exception' => $e
                ]);
                $results[$type][$page] = [];
            }
        }

        return $results;
    }
}
