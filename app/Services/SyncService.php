<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\ConnectionException;

class SyncService
{
    public static function get($url)
    {
        $url = env('1C_SERVER') . $url;
        try {
            $response = Http::timeout(4)
                ->withBasicAuth(env('1C_USER_NAME'), env('1C_USER_PASSWORD'))
                ->get($url);
        } catch (ConnectionException $e) {
            return [
                'error' => 'Ошибка подключения больше 4 секунды',
                'data' => $e,
            ];
        }
        // $data = $response->json();
        $data = [
            'body' => $response->body(),
            'json' => $response->json(),
            'headers' => $response->headers(),
            'status' => $response->status()
        ];

        return $data;
    }

    public static function post($url, $data = [])
    {
        $url = env('1C_SERVER') . $url;
        try {
            $response = Http::timeout(4)
                ->withBasicAuth(env('1C_USER_NAME'), env('1C_USER_PASSWORD'))
                ->post($url, $data);
        } catch (ConnectionException $e) {
            return [
                'error' => 'Ошибка подключения больше 4 секунды',
                'data' => $e,
            ];
        }
        $data = $response->json();

        return $data;
    }

}