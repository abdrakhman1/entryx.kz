<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Amo;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ApiAmoController extends Controller
{
    public function auth()
    {
        $amo = new Amo();
        Log::info('--- amo auth: ' . json_encode($amo->auth()));
        return $this->sendResponse($amo->auth());
    }

    public function request_dealer()
    {
        $payload = [
            [
                "name" => "Сделка для примера на дилера",
                "created_by" => 0,
                "price" => 0,
                '_embedded' => [
                    'contacts' => [
                        [
                            'name' => 'Екатерина Константиновка Константинопольская',
                            "custom_fields_values" => [
                                [
                                    "field_code" => "EMAIL",
                                    "values" => [
                                        [
                                            "enum_code" => "WORK",
                                            "value" => "unsorted_example@example.com"
                                        ]
                                    ]
                                ],
                                [
                                    "field_code" => "PHONE",
                                    "values" => [
                                        [
                                            "enum_code" => "WORK",
                                            "value" => "+79129876543"
                                        ]
                                    ]
                                ],
                            ]
                        ],
                    ],
                    "companies" => [
                        [
                            "name" => "ООО Рога и Копыта",
                            "custom_fields_values" => [
                                [
                                    "field_name" => "БИН",
                                    "field_id" => 396143,
                                    "values" => [
                                        [
                                            'value' => '123456789012'
                                        ]
                                    ]
                                ]
                            ]
                        ]
                    ]
                ]
            ],
        ];

        $amo = new Amo();
        return $this->sendResponse($amo->post('leads/complex', $payload));
    }


    public function request_question()
    {
        $payload = [
            [
                "name" => "Вопрос с сайта",
                "created_by" => 0,
                "price" => 0,
                "custom_fields_values" => [
                    [
                        "field_id" => 376557, // источник сделки
                        "values" => [
                            [
                                "value" => "Вопрос с сайта: купить дверь"
                            ]
                        ]
                    ]
                ],
                '_embedded' => [
                    'contacts' => [
                        [
                            'name' => 'Екатерина Константиновна Константинопольская',
                            "custom_fields_values" => [
                                [
                                    "field_code" => "PHONE",
                                    "values" => [
                                        [
                                            "enum_code" => "WORK",
                                            "value" => "+79121112233"
                                        ]
                                    ]
                                ],
                            ]
                        ],
                    ]
                ]
            ],
        ];

        $amo = new Amo();
        return $this->sendResponse($amo->post('leads/complex', $payload));
    }

    public function order_request()
    {
        $payload = [
            [
                "name" => "Тестовый заказ с сайта",
                "created_by" => 0,
                "price" => 0,
                "custom_fields_values" => [
                    [
                        "field_id" => 1605213, // Ссылка на заказ с портала
                        "values" => [
                            [
                                "value" => "https://entryx.kz/admin/orders/54"
                            ]
                        ]
                    ]
                ],
                '_embedded' => [
                    'contacts' => [
                        [
                            'name' => 'Екатерина Константиновна Константинопольская',
                            "custom_fields_values" => [
                                [
                                    "field_code" => "PHONE",
                                    "values" => [
                                        [
                                            "enum_code" => "WORK",
                                            "value" => "+79121112233"
                                        ]
                                    ]
                                ],
                            ]
                        ],
                    ]
                ]
            ],
        ];

        $amo = new Amo();
        return $this->sendResponse($amo->post('leads/complex', $payload));

    }



    public function account()
    {
        $amo = new Amo();
        return $this->sendResponse($amo->get('account'));
    }

    public function amo_test()
    {
        $amo = new Amo();
        return $this->sendResponse($amo->get('leads/custom_fields'));

        $amo_code_data = Storage::json('amo_code.txt');

        return [
            '1' => env('AMO_SUBDOMAIN', ''),
            'subdomain' => $amo->subdomain,
            'host' => $amo->host,
            'access_token' => $amo->access_token,
            'auth_response' => $amo->auth(),
            'amo_code_data' => $amo_code_data,
        ];
    }
}
