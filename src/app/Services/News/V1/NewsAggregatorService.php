<?php
namespace App\Services\News\V1;

use App\Connectors\News\V1\NewsConnector;
use App\Mappers\News\V1\GuardianApiResponseMapper;
use App\Mappers\News\V1\NewsApiResponseMapper;
use App\Mappers\News\V1\NyTimesApiResponseMapper;
use App\Models\V1\Article;
use Illuminate\Support\Facades\Log;

class NewsAggregatorService
{
    /**
     * @return void
     */
    public function fetchAllArticlesAsync(): void
    {
        $platforms = $this->getActivePlatforms();
        $responses = (new NewsConnector())->fetchDataAsync($platforms);
        $newsApiResponseArray = (new NewsApiResponseMapper())->map($responses['newsapi'] ?? []);
        $guardianApiResponseArray = (new GuardianApiResponseMapper())->map($responses['guardianapis'] ?? []);
        $nyTimesApiResponseArray = (new NyTimesApiResponseMapper())->map($responses['nytimes'] ?? []);

        $mergedArticles = array_merge(
            ...array_filter([
                $newsApiResponseArray,
                $guardianApiResponseArray,
                $nyTimesApiResponseArray,
            ])
        );

        try {
            $upsert = Article::upsert($mergedArticles, ['url'], ['title', 'description', 'source', 'published_at', 'updated_at']);
            Log::info("Successfully data fetch & upsert completed: ", [
                'affected rows' => $upsert
            ]);
        } catch (\Exception $exception) {
            Log::error("Error upsert: " . $exception->getMessage(), [
                'exception' => $exception
            ]);
        }
    }

    /**
     * @return array
     */
    private function getActivePlatforms(): array
    {
        $platformConfigs = config('connector.platforms.news');
        $activePlatforms = [];
        foreach ($platformConfigs as $key => $item) {
            if (isset($item['status']) && $item['status'] === 'active' && isset($item['v1'])) {
                $activePlatforms[$key] = $item['v1'];
            }
        }
        return $activePlatforms;
    }
}
