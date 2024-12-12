<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Log;

class SyncService
{
    public static function get($url)
    {
        $url = config('app.1c_server') . $url;
        // dd($url);
        try {
            $response = Http::timeout(7)
                ->withBasicAuth(config('app.1c_user_name'), config('app.1c_user_password'))
                ->get($url);
        } catch (ConnectionException $e) {
            return [
                'error' => 'Ошибка подключения больше 7 секунды',
                'data' => $e->getMessage(),
            ];
        }
        // $response_json = $response->json();
        $data_response = [
            'body' => $response->body(),
            'json' => $response->json(),
            'headers' => $response->headers(),
            'status' => $response->status(),
            'url' => $url,
            'method' => 'get'
        ];

        if (isset($data_response['json']['result']) && $data_response['json']['result'] == 'error') {
            Log::error('SyncService ' . $url . '; payload: ' . json_encode($url) );
            Log::error('SyncService error: ' . $data_response['json']['error_text']);
            // dd('Error', $data);
        }

        return $data_response;
    }

    public static function post($url, $data = [])
    {
        $url = config('app.1c_server') . $url;
        // dd($url);
        // dd($data);
        try {
            $response = Http::timeout(7)
                ->withBasicAuth(config('app.1c_user_name'), config('app.1c_user_password'))
                ->post($url, $data);
        } catch (ConnectionException $e) {
            return [
                'error' => 'Ошибка подключения больше 7 секунды',
                'data' => $e,
            ];
        }
        $data_response = [
            'body' => $response->body(),
            'json' => $response->json(),
            'headers' => $response->headers(),
            'status' => $response->status(),
            'url' => $url,
            'method' => 'post'
        ];

        if (isset($data_response['json']['result']) && $data_response['json']['result'] == 'error') {
            Log::error('SyncService ' . $url . '; payload: ' . json_encode($data) );
            Log::error('SyncService error: ' . $data_response['json']['error_text']);
            // dd('Error', $data);
        }

        return $data_response;
    }

    public static function patch($url, $data = [])
    {
        $url = config('app.1c_server') . $url;
        // dd($url);
        // dd($data);
        try {
            $response = Http::timeout(7)
                ->withBasicAuth(config('app.1c_user_name'), config('app.1c_user_password'))
                ->patch($url, $data);
        } catch (ConnectionException $e) {
            return [
                'error' => 'Ошибка подключения больше 7 секунд',
                'data' => $e,
            ];
        }
        $data_response = [
            'body' => $response->body(),
            'json' => $response->json(),
            'headers' => $response->headers(),
            'status' => $response->status(),
            'url' => $url,
            'method' => 'patch'
        ];

        if (isset($data_response['json']['result']) && $data_response['json']['result'] == 'error') {
            Log::error('SyncService ' . $url . '; payload: ' . json_encode($data) );
            Log::error('SyncService error: ' . $data_response['json']['error_text']);
            // dd('Error', $data);
        }

        return $data_response;
    }
}
