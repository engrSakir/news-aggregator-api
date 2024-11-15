<?php

namespace App\Http\Controllers\Api\News\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\News\V1\GetNewsRequest;
use App\Models\V1\Article;
use App\Services\News\V1\GetNewsService;
use App\Services\Preference\V1\PreferenceGetService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;

class NewsController extends Controller
{
    public function __invoke(GetNewsRequest $request, GetNewsService $service): JsonResponse
    {
        return $this->response($service->handle($request->validated()));
    }
}
