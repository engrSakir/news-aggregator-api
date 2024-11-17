<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Queue;

class AppController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json([
            'status' => 'success',
            'data' => [
                'message' => 'Welcome to the ' . config('app.name'),
                'version' => '1.0.0',
                'documentation_url' => 'http://localhost:8101/api/documentation'
            ]
        ], 200);
    }

    public function health(): JsonResponse
    {
        try {
            $db = DB::connection()->getPdo() ? 'connected' : 'disconnected';
            $cache = Cache::set('health-check', true) ? 'available' : 'unavailable';
            $queue = Queue::size() >= 0 ? 'running' : 'stopped';
            $data = [
                'timestamp' => now(),
                'database' => $db,
                'cache' => $cache,
                'queue' => $queue
            ];
            if ($db === 'connected' && $cache === 'available' && $queue === 'running') {
                return response()->json([
                    'status' => 'success',
                    'data' => $data
                ], 200);
            } else {
                Log::error('Health check failure', $data);
                return response()->json([
                    'status' => 'error',
                    'message' => 'Some services are unavailable',
                    'data' => $data
                ], 500);
            }
        } catch (\Exception $e) {
            Log::error('Health check exception', ['error' => $e->getMessage()]);
            return response()->json([
                'status' => 'error',
                'message' => 'Health check failed',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
