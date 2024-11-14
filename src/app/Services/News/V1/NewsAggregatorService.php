<?php
namespace App\Services\News\V1;

use App\Connectors\News\V1\NewsConnector;
use App\Mappers\News\V1\GuardianApiResponseMapper;
use App\Mappers\News\V1\NewsApiResponseMapper;
use App\Mappers\News\V1\NewsResponseMapper;
use App\Mappers\News\V1\NyTimesApiResponseMapper;
use App\Models\Article;
use Illuminate\Support\Facades\Log;

class NewsAggregatorService
{
    public function fetchAllArticlesAsync(): void
    {
        $requests = $this->getPlatformRequestInfo();

        $responses = (new NewsConnector())->fetchDataAsync($requests);
        $newsApiResponseArray = (new NewsApiResponseMapper())->map($responses['newsAPI']);
        $guardianApiResponseArray = (new GuardianApiResponseMapper())->map($responses['guardian']);
        $nyTimesApiResponseArray = (new NyTimesApiResponseMapper())->map($responses['nytimes']);

        $mergedArticles = array_merge(
            ...array_filter([
                $newsApiResponseArray,
                $guardianApiResponseArray,
                $nyTimesApiResponseArray,
            ])
        );

        try {
            $upsert = Article::upsert($mergedArticles, ['url'], ['title', 'description', 'source', 'published_at', 'updated_at']);
            Log::info("Successfully data fetch & upserting completed: ", [
                'upsert' => $upsert
            ]);
        } catch (\Exception $exception) {
            Log::error("Error upserting: " . $exception->getMessage(), [
                'exception' => $exception
            ]);
        }
    }

    private function getPlatformRequestInfo(): array
    {
        return [
            'newsAPI' => [
                'url' => 'https://newsapi.org/v2/top-headlines',
                'params' => [
                    'country' => 'us',
                    'apiKey' => '5d9f41ea13784fac9be4a091f8295021',
                    'pageSize' => 2,
                ],
                'page_coverage' => 1
            ],
            'guardian' => [
                'url' => 'https://content.guardianapis.com/search',
                'params' => [
                    'order-by' => 'newest',
                    'show-fields' => 'all',
                    'page-size' => 10,
                    'api-key' => 'ca371f06-7ecd-491c-ba03-23e3ae51196d',
                ],
                'page_coverage' => 10
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
        'nytimes' => [
                'url' => 'https://api.nytimes.com/svc/archive/v1/2024/1.json',
                'params' => [
//                    'region' => 'global',
                    'api-key' => '9b7p33l8Up1gVL4fi6ibiEVgmHQ2GeEG',
                ],
            ],
        ];
    }
}
