<?php

use App\Http\Controllers\AppController;
use Illuminate\Support\Facades\Route;

// Root & health route
Route::get('/', [AppController::class, 'index']);
Route::get('/health', [AppController::class, 'health']);

