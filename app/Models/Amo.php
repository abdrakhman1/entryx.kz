<?php

namespace App\Models;

use Exception;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

/**
 * для инициализации нужно взять с amoCRM AMO_CODE, простоавить в .env затем выполнить команд
 * от имени администратора web: /admin/amo/auth
 */


class Amo
{
    public function __construct(
        public string $client_id = '',
        public string $client_secret = '',
        public string $code = '',
        public string $redirect_uri = '',
        public string $subdomain = '',
        public string $host = '',
        public $access_token = '',
        public $longlive_token = '',
    ) {
        $this->client_id = env('AMO_CLIENT_ID', '');
        $this->client_secret = env('AMO_CLIENT_SECRET', '');
        $this->code = env('AMO_CODE', '');
        $this->redirect_uri = env('AMO_RERIDECT_URI', '');
        // $this->subdomain = env('AMO_SUBDOMAIN', '');
        $this->subdomain = 'entryx';
        $this->host = 'https://' . $this->subdomain . '.amocrm.ru';
        // $this->access_token = $this->auth()['access_token'];
        $this->longlive_token = config('app.amo_longlive_token', '');
    }


    public function auth()
    {
        $amo_code_data = Storage::json('amo_code.txt');

        if ($amo_code_data == null || $amo_code_data['end_token_time'] - 60 < time()) {

            $payload = [
                'client_id'     => $this->client_id,
                'client_secret' => $this->client_secret,
                'grant_type'    => 'authorization_code',
                'code'          => $this->code,
                'redirect_uri' => $this->redirect_uri
            ];
            $response = Http::post($this->host . '/oauth2/access_token', $payload);
            $arr_response = $response->json();

            if ($response->status() != 200) {
                return [
                    'success' => false,
                    'error' => $arr_response,
                    'access_token' => 'error',
                ];
            }

            $arr_response['end_token_time'] = $arr_response['expires_in'] + time();

            Storage::disk('local')->put('amo_code.txt', json_encode($arr_response));

            return $arr_response;
        } else {
            return $amo_code_data;
        }
    }

    public function get($command = 'account')
    {
        $response =
            Http::withToken($this->longlive_token)
            ->get($this->host . '/api/v4/' . $command);

        Log::info('--- AMO ' . $command . '; get: ' . $response->body());
        return $response->json();
    }

    public function post($command = '', $payload = [])
    {
        $response =
            Http::withToken($this->longlive_token)
            ->post($this->host . '/api/v4/' . $command, $payload);

        Log::info('--- AMO ' . $command . ';  post: ' . $response->body());
        return $response->json();
    }


}
