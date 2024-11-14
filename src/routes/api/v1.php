<?php

use App\Http\Controllers\Api\V1\AuthController;
use App\Jobs\V1\FetchNewsJob;
use Illuminate\Support\Facades\Route;

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
Route::post('password/email', [AuthController::class, 'sendPasswordResetLinkEmail']);
Route::post('password/reset', [AuthController::class, 'resetPassword']);


Route::get('/news', function () {
    // Dispatch the job with the NewsAggregatorService injected
    return FetchNewsJob::dispatchSync();

//    return response()->json(['status' => 'Job dispatched successfully']);
});
