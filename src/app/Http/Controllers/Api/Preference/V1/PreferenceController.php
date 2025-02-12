<?php

namespace App\Http\Controllers\Api\Preference\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Preference\V1\PreferenceDestroyRequest;
use App\Http\Requests\Preference\V1\PreferenceStoreRequest;
use App\Http\Requests\Preference\V1\PreferenceUpdateRequest;
use App\Services\Preference\V1\PreferenceDestroyService;
use App\Services\Preference\V1\PreferenceGetService;
use App\Services\Preference\V1\PreferenceStoreService;
use App\Services\Preference\V1\PreferenceUpdateService;
use Illuminate\Http\JsonResponse;

class PreferenceController extends Controller
{
    public function index(PreferenceGetService $service): JsonResponse
    {
        return $this->response(
            data: $service->handle()
        );
    }

    public function store(PreferenceStoreRequest $request, PreferenceStoreService $service): JsonResponse
    {
        return $this->response(
            data: $service->handle($request->validated())
        );
    }

    public function update(PreferenceUpdateRequest $request, $id, PreferenceUpdateService $service): JsonResponse
    {
        return $this->response(
            data: $service->handle($request->validated(), $id)
        );
    }

    public function destroy(PreferenceDestroyRequest $request, $id, PreferenceDestroyService $service): JsonResponse
    {
        return $this->response(
            data: $service->handle($id)
        );
    }
}
