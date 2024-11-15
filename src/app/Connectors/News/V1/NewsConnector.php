<?php
namespace App\Connectors\News\V1;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Config;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\RequestException;
use Exception;

class NewsConnector
{
    /**
     * Fetch multiple asynchronous GET requests.
     *
     * @param array $requests An array of requests, each with a URL and parameters.
     * @return array Decoded JSON responses.
     */
    public function fetchDataAsync(array $requests): array
    {
        $config = config('connector.async_logging');

        if (!$config['enabled']) {
            return [];
        }

        try {
            $startTime = microtime(true);
            $this->log('info', "Starting asynchronous data fetch", [
                'requests_count' => count($requests),
            ], $config);

            $responses = Http::pool(function ($pool) use ($requests, $config) {
                $handles = [];

                foreach ($requests as $key => $request) {
                    $pageCoverage = $request['page_coverage'] ?? 1;

                    for ($page = 1; $page <= $pageCoverage; $page++) {
                        $request['params']['page'] = $page;
                        $timeOut = $request['timeout'] ?? 30;

                        // Log request details
                        if ($config['log_request_details']) {
                            $this->log('info', "Dispatching request", [
                                'key' => "$key-$page",
                                'url' => $request['url'],
                                'params' => $request['params'],
                                'timeout' => $timeOut,
                            ], $config);
                        }

                        $handles["$key-$page"] = $pool->as("$key-$page")
                            ->timeout($timeOut)
                            ->get($request['url'], $request['params']);
                    }
                }

                return $handles;
            });

            $this->log('info', "All requests dispatched", [
                'total_time_seconds' => round(microtime(true) - $startTime, 2),
            ], $config);

            return $this->processResponses($responses, $config);

        } catch (Exception $e) {
            $this->log('error', "Failed to fetch data asynchronously", [
                'requests' => $requests,
                'exception' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ], $config);

            return [];
        }
    }


    /**
     * Process and structure the responses.
     *
     * @param array $responses Responses from the HTTP client pool.
     * @param array $config Configuration for logging.
     * @return array Structured decoded JSON responses.
     */
    private function processResponses(array $responses, array $config): array
    {
        $results = [];
        foreach ($responses as $key => $response) {
            $start = microtime(true);

            try {
                list($type, $page) = explode('-', $key);

                if ($response instanceof ConnectionException) {
                    // Log timeout error but do not halt the process
                    $this->log('error', "Connection timeout", [
                        'key' => $key,
                        'message' => $response->getMessage(),
                    ], $config);
                    continue; // Skip this response
                } elseif ($response instanceof RequestException) {
                    $this->log('error', "Request exception", [
                        'key' => $key,
                        'message' => $response->getMessage(),
                        'response_body' => $response->response->body(),
                    ], $config);
                    continue; // Skip this response
                } elseif ($response->successful()) {
                    $responseDetails = [
                        'key' => $key,
                        'status' => $response->status(),
                        'response_time_seconds' => round(microtime(true) - $start, 2),
                    ];

                    if ($config['log_response_status']) {
                        $responseDetails['response_status_code'] = $response->status();
                    }

                    if ($config['log_full_response_body']) {
                        $responseDetails['response_body'] = $response->body();
                    }

                    $this->log('info', "Successful response", $responseDetails, $config);

                    // Accumulate successful response
                    $results[$type][$page] = $response->json();
                } else {
                    $responseDetails = [
                        'key' => $key,
                        'status' => $response->status(),
                        'response_time_seconds' => round(microtime(true) - $start, 2),
                        'response_body' => $response->body(),
                    ];

                    $this->log('warning', "Unsuccessful response", $responseDetails, $config);
                    continue; // Skip this response
                }
            } catch (Exception $e) {
                $this->log('error', "Error processing response", [
                    'key' => $key,
                    'exception' => $e->getMessage(),
                    'trace' => $e->getTraceAsString(),
                ], $config);
                continue; // Skip this response
            }
        }

        return $results;
    }


    /**
     * Log messages using the custom channel.
     *
     * @param string $level Log level: 'info', 'warning', 'error'.
     * @param string $message Log message.
     * @param array $context Additional context.
     * @param array $config Logging configuration.
     */
    private function log(string $level, string $message, array $context, array $config): void
    {
        if (!in_array($level, ['info', 'warning', 'error', 'debug', 'critical'])) {
            $level = 'info';
        }

        if ($config['enabled']) {
            Log::channel('connector_logs')->$level($message, $context);
        }
    }
}
