<?php

use App\Jobs\FetchNewsJob;
use App\Services\News\V1\NewsAggregatorService;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\AuthController;

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
Route::post('password/email', [AuthController::class, 'sendPasswordResetLinkEmail']);
Route::post('password/reset', [AuthController::class, 'resetPassword']);


Route::get('/news', function (NewsAggregatorService $newsAggregatorService) {
    // Dispatch the job with the NewsAggregatorService injected
    return FetchNewsJob::dispatchSync($newsAggregatorService);

//    return response()->json(['status' => 'Job dispatched successfully']);
});
