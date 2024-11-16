<?php

use App\Jobs\News\V1\FetchNewsJob;
use Illuminate\Support\Facades\Schedule;

Schedule::job(new FetchNewsJob())->everyFiveMinutes();

Schedule::call(function () {
    \Illuminate\Support\Facades\Log::info("Scheduler is working");
})->everyMinute();
