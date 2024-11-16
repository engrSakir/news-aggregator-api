<?php

use App\Http\Controllers\Api\Auth\V1\AuthController;
use App\Http\Controllers\Api\News\V1\NewsController;
use App\Http\Controllers\Api\Preference\V1\PreferenceController;
use Illuminate\Support\Facades\Route;

Route::post('register', [AuthController::class, 'register'])->name('register');
Route::post('login', [AuthController::class, 'login'])->name('login');
Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:sanctum')->name('logout');
Route::post('password/email', [AuthController::class, 'sendPasswordResetLinkEmail'])->name('password.email');
Route::post('password/reset', [AuthController::class, 'resetPassword'])->name('password.reset');

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::resource('preferences', PreferenceController::class)
        ->only(['index', 'store', 'update', 'destroy'])
        ->names('preferences');
    Route::get('news', [NewsController::class, 'index'])->name('news.index');
    Route::get('news/{id}', [NewsController::class, 'find'])->name('news.find');
});


