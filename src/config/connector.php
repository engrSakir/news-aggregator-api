<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Connector & Platform Configuration
    |--------------------------------------------------------------------------
    */

    'platforms' => [
        'news' => [
            'newsapi' => [
                'status' => env('PLATFORM_NEWS_NEWSAPI_STATUS_V1', 'active'),
                'v1' => [
                    'url' => 'https://newsapi.org/v2/top-headlines',
                    'params' => [
                        'country' => 'us',
                        'apiKey' => env('PLATFORM_NEWS_NEWSAPI_API_KEY_V1', ''),
                        'pageSize' => 10,
                    ],
                    'page_coverage' => 2,
                ],
            ],
            'guardianapis' => [
                'status' => env('GUARDIANAPIS_NEWS_NEWSAPI_STATUS_V1', 'active'),
                'v1' => [
                    'url' => 'https://content.guardianapis.com/search',
                    'params' => [
                        'order-by' => 'newest',
                        'show-fields' => 'all',
                        'page-size' => 10,
                        'api-key' => env('GUARDIANAPIS_NEWS_NEWSAPI_API_KEY_V1', ''),
                    ],
                    'page_coverage' => 2
                ],
            ],
            'nytimes' => [
                'status' => env('NYTIMES_NEWS_NEWSAPI_STATUS_V1', 'active'),
                'v1' => [
                    'timeout' => 120,
                    'url' => 'https://api.nytimes.com/svc/archive/v1/2024/1.json',
                    'params' => [
                        'api-key' => env('NYTIMES_NEWS_NEWSAPI_API_KEY_V1', ''),
                    ],
                ],
            ],
        ]
    ],
    'async_logging' => [
        'enabled' => true, // Enable or disable logging
        'log_level' => 'info', // Default log level
        'log_request_details' => true, // Log request details before dispatching
        'log_response_details' => true, // Log response details after receiving
        'log_timing_in_seconds' => true, // Log time in seconds
        'log_full_response_body' => false, // Log the full response body
        'log_response_status' => true, // Log response status and code
    ],
];
