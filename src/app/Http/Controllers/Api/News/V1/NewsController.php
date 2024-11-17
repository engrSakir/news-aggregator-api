<?php

namespace App\Http\Controllers\Api\News\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\News\V1\FindNewsRequest;
use App\Http\Requests\News\V1\GetNewsRequest;
use App\Services\News\V1\FindNewsService;
use App\Services\News\V1\GetNewsService;
use Illuminate\Http\JsonResponse;

class NewsController extends Controller
{
    public function index(GetNewsRequest $request, GetNewsService $service): JsonResponse
    {
        return $this->response($service->handle($request->validated()));
    }

    public function show(FindNewsRequest $request, FindNewsService $service, $id): JsonResponse
    {
        return $this->response($service->handle($id));
    }
}
