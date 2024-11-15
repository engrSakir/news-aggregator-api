<?php

use App\Http\Controllers\Api\Auth\V1\AuthController;
use App\Http\Controllers\Api\News\V1\NewsController;
use App\Http\Controllers\Api\Preference\V1\PreferenceController;
use Illuminate\Support\Facades\Route;

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
Route::post('password/email', [AuthController::class, 'sendPasswordResetLinkEmail']);
Route::post('password/reset', [AuthController::class, 'resetPassword']);

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::resource('preferences', PreferenceController::class)->only(['index', 'store', 'update', 'destroy']);
    Route::get('news', NewsController::class);
});


