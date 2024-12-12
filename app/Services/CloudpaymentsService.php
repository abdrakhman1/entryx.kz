<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\ConnectionException;

class CloudpaymentsService
{
    public $cloudpayments_public_id;
    public $cloudpayments_secret;

    public $base_url = "https://api.cloudpayments.kz/";

    public function __construct()
    {
        $this->cloudpayments_public_id = config('app.cloudpayments_public_id', '');
        $this->cloudpayments_secret = config('app.cloudpayments_secret', '');
    }

    public function get($uri)
    {
        $response = Http::withBasicAuth(
            config('app.cloudpayments_public_id'),
            config('app.cloudpayments_secret')
        )
            ->get($this->base_url . $uri);
        return $response->json();
    }

    public function post($uri, $body = [])
    {
        $response = Http::withBasicAuth(
            config('app.cloudpayments_public_id'),
            config('app.cloudpayments_secret')
        )
            ->post($this->base_url . $uri, $body);
        return $response->json();
    }

    public function test()
    {
        return $this->get('test');
    }

    public function create_order($sum, $email, $description = '', $order_id = '', $user_id = '')
    {
        $body = [
            "InvoiceId" => $order_id,
            "Amount" => $sum,
            "Currency" => "KZT",
            "Description" => $description,
            "Email" => $email,
            "RequireConfirmation" => false,
            "SendEmail" => false,
            "JsonData" => [
                'cloudPayments' => [
                    'orderData' => [
                        'id' => $order_id,
                        'user_id' => $user_id,
                    ]
                ]
            ]
        ];

        $response = Http::withBasicAuth(
            config('app.cloudpayments_public_id'),
            config('app.cloudpayments_secret')
        )
            ->post($this->base_url . 'orders/create', $body);
        return $response->json();
    }


}

