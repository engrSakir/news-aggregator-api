<?php

namespace App\Console\Commands\News\V1;

use App\Jobs\News\V1\FetchNewsJob;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class FetchNews extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:fetch-news';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Log the start time and output to terminal
        $startTime = microtime(true);
        $this->info('Fetching news...');
        Log::info('app:fetch-news job started at: ' . Carbon::now());

        // Dispatch the job synchronously
        FetchNewsJob::dispatchSync();

        // Log the end time
        $endTime = microtime(true);

        // Calculate the total time taken
        $duration = $endTime - $startTime;

        // Output the time taken in the terminal and log it
        $this->info('News fetched successfully completed & it took ' . round($duration, 2) . ' seconds.');

        Log::info('app:fetch-news job end at: ' . Carbon::now(), [
            'starting_microtime' => $startTime,
            'ending_microtime' => $endTime,
            'duration' => round($duration, 2) . ' seconds.',
        ]);
    }
}
