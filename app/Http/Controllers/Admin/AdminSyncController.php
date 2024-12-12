<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\Property;
use App\Models\Role;
use App\Models\User;
use App\Services\SyncService;
use Faker\Factory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AdminSyncController extends Controller
{
    public function index()
    {
        return view('admin.sync.index');
    }

    public function ip(Request $request)
    {
        dd($request->ip());
        return;
    }

    public function test()
    {
        // dd(SyncService::get('/api/people/1'));
        return SyncService::get('');
    }

    public function sync_get(Request $request)
    {
        $responce = SyncService::get($request->url);
        dd($responce);
        return;
    }

    public function products()
    {
        $responce = SyncService::get(
            'products'
        );
        $products = $responce['json']['products'];
        dd($responce);
    }

    public function sync_products()
    {
        $responce = SyncService::get(
            'products'
        );
        $counter = 0;
        $products = $responce['json']['products'];
        foreach ($products as $product) {
            $finded_product = Product::where('article', $product['article'])->first();
            if ($finded_product) {
                $finded_product->price = (int)$product['price'];
                $finded_product->quantity = (int)$product['remains'];
                $finded_product->requisite = $product['requisite'] ?? "";
                $finded_product->save();
                $counter++;
            }

            $finded_variant = ProductVariant::where('article', $product['article'])->first();
            if ($finded_variant) {
                $finded_variant->price = (int)$product['price'];
                $finded_variant->quantity = (int)$product['remains'];
                $finded_variant->requisite = $product['requisite'] ?? "";
                $finded_variant->save();
                $counter++;
            }
        }
        dd('Синхронизировано товаров: ' . $counter, $products);
    }



    public function new_user()
    {
        $responce = SyncService::post(
            'users/new',
            [
                "lastname" => "Иваненко",
                "firstname" => "Сидор",
                "surname" => "Петрович",
                "email" => "test2@test2.com",
                "bin" => "33444433212345",
                "company_name" => "ИП Мир 2 дверей",
                "address" => "Караганда, улица Пушкина, 10, 2",
                "phones" => "+7 7212 12-54-87, +7 700 123-45-67"
            ]
        );
        dd($responce);
    }

    public function user_update($bin = '217763551939')
    {
        $responce = SyncService::patch(
            'users/' . $bin,
            [
                "company_name" => "ТОО Мир Супердверей 1337",
                "address" => "Караганда, улица Ленина, 1937",
                "phones" => "7 (777) 9998877"
            ]
        );
        dd($responce);
    }

    public function get_user($bin = '123456789000')
    {
        $responce = SyncService::get(
            'users/' . $bin
        );
        dd($responce);
    }

    public function new_order()
    {
        $responce = SyncService::post(
            'orders/new',
            [
                "user_bin" => "770901300888",
                "payment" => "cash",
                "reserve" => false,
                "items" => [
                    [
                        "article" => "80338173032328106546917780638711",
                        "quantity" => "1",
                    ],
                    [
                        "article" => "95028045974929506419822805817028",
                        "quantity" => "2",
                    ]
                ]
            ]
        );



        // $responce2 = SyncService::post(
        //     'orders/upload',
        //     [
        //         "order_id" => $responce['json']['order_id'],
        //         "set_status" => "cancel",
        //         "payment" => "bank_transfer"
        //     ]
        // );

        $responce3 = SyncService::get(
            'orders/' . $responce['json']['order_id']
        );


        dd(
            $responce,
            // $responce2,
            $responce3
        );
    }


    public function get_order($uuid = '08588ffd-c5b7-11ee-96d1-000c292da07a')
    {
        $responce = SyncService::get(
            'orders/' . $uuid
        );
        dd($responce);
    }

    public function update_order($uuid = 'a907d127-41ec-11ee-a06b-b42e9919ece8')
    {
        $responce = SyncService::post(
            'orders/update',
            [
                "order_id" => $uuid,
                "items" => [
                    [
                        "article" => "10005",
                        "quantity" => "4",
                        "variation" => "860х2050 L"
                    ],
                    [
                        "article" => "570003",
                        "quantity" => "2",
                        "variation" => "860х2050 R"
                    ]
                ]
            ]
        );
        dd($responce);
    }

    public function get_order_by_user_bin($bin = '454978380003')
    {
        $responce = SyncService::get(
            'orders_by_bin/' . $bin
        );
        dd($responce);
    }

    public function order_upload($order_id = 'c17a481e-b133-11ee-96d1-000c292da07a')
    {
        // dd(123);
        $responce = SyncService::post(
            'orders/upload',
            [
                "order_id" => $order_id,
                "set_status" => "done",
                "payment" => "bank_transfer"
            ]
        );
        dd($responce);
    }

    public function order_cancel($order_id = '632813fd-c4d8-11ee-96d1-000c292da07a')
    {
        $responce = SyncService::post(
            'orders/upload',
            [
                "order_id" => $order_id,
                "set_status" => "cancel",
            ]
        );
        dd($responce);
    }

    public function order_upload_online($order_id = 'ad4aa7cf-c4d8-11ee-96d1-000c292da07a')
    {
        $responce = SyncService::post(
            'orders/upload',
            [
                "order_id" => $order_id,
                "set_status" => "done",
                "payment" => "online",
                "payment_data" => [
                    "datetime" => now()->format('Y-m-d H:i'),
                    "transaction" => (string)rand(111111111, 999911111)
                ]
            ]
        );
        dd($responce);
    }
























    public function user_test()
    {
        $faker = Factory::create('ru_RU');

        $user_bin = (string)rand(100000000000, 999999999999);
        $user = [
            // "lastname" => $faker->lastName,
            // "firstname" => $faker->middleName,
            // "surname" => $faker->middleName,
            "name" => $faker->lastName . " " . $faker->firstName . " " . $faker->middleName,
            "email" => $faker->email,
            "bin" => $user_bin,
            "company_name" => $faker->company,
            "address" => $faker->address,
            "phones" => $faker->phoneNumber
        ];

        $responce_new_user = SyncService::post(
            'users/new',
            $user
        );


        $responce_get_user = SyncService::get(
            'users/' . $user_bin
        );

        $user_new_data =
            [
                "company_name" => "ИП Мир дверей 003",
                "address" => "Караганда, улица Пушкина, 1003",
                "phones" => "+7 700 123-45-0233"
            ];

        $responce_user_update = SyncService::patch(
            'users/' . $user_bin,
            $user_new_data
        );


        $responce_get_user_after_update = SyncService::get(
            'users/' . $user_bin
        );

        $responce = SyncService::get(
            'products'
        );
        $products = $responce['json']['products'];
        $product1 = $products[rand(0, count($products) - 1)];
        $product2 = $products[rand(0, count($products) - 1)];
        // $product1['article'] = '58381806253822028911810282491900';
        // $product2['article'] = '27417123962826027793861893779896';
        // $product1['article'] = '16139733908329027875900801880832';
        // $product2['article'] = '83829482997427136802871122805172';
        $product_with_null_remains = null;
        foreach ($products as $product) {
            if ($product['remains'] == 0) {
                $product_with_null_remains = $product;
                break;
            }
        }

        $responce_new_order0 = SyncService::post(
            'orders/new',
            [
                "user_bin" => $user_bin,
                "payment" => "cash",
                "reserve" => false,
                "items" => [
                    [
                        "article" => $product1['article'],
                        "quantity" => "1",
                    ]
                ]
            ]
        );

        $order_items = [
            [
                "article" => $product1['article'],
                "quantity" => "4",
            ],
            [
                "article" => $product2['article'],
                "quantity" => "1",
            ]
        ];

        // dd($order_items);


        $responce_new_order = SyncService::post(
            'orders/new',
            [
                "user_bin" => $user_bin,
                "payment" => "cash",
                // "reserve" => false,
                "items" => $order_items,
            ]
        );


        // sleep(1);
        // dd($responce_new_order, $order_items);
        if (isset($responce_new_order['json']['order_id'])) {
            $responce_order = SyncService::get(
                'orders/' . $responce_new_order['json']['order_id']
            );
        } else {
            dd($responce_new_order);
        }






        $responce_order_by_bin = SyncService::get(
            'orders_by_bin/' . $user_bin
        );

        $data_order_cancel = [
            "order_id" => $responce_new_order['json']['order_id'],
            "set_status" => "cancel",
        ];

        $responce_order_cancel = SyncService::post(
            'orders/upload',
            $data_order_cancel
        );


        $responce_order1 = SyncService::get(
            'orders/' . $responce_new_order['json']['order_id']
        );




        $responce_new_order2 = SyncService::post(
            'orders/new',
            [
                "user_bin" => $user_bin,
                "payment" => "cash",
                "reserve" => false,
                "items" => [
                    [
                        "article" => $product2['article'],
                        "quantity" => "1",
                    ]
                ]
            ]
        );

        $responce_order2 = SyncService::get(
            'orders/' . $responce_new_order2['json']['order_id']
        );

        $responce_order_done_bank = SyncService::post(
            'orders/upload',
            [
                "order_id" => $responce_new_order2['json']['order_id'],
                "set_status" => "done",
                "payment" => "bank_transfer"
            ]
        );





        $responce_new_order3 = SyncService::post(
            'orders/new',
            [
                "user_bin" => $user_bin,
                "payment" => "cash",
                "reserve" => false,
                "items" => [
                    [
                        "article" => $product1['article'],
                        "quantity" => "1",
                    ]
                ]
            ]
        );

        // dd($responce_new_order3);

        $responce_order3 = SyncService::get(
            'orders/' . $responce_new_order3['json']['order_id']
        );

        $responce_order_done_online = SyncService::post(
            'orders/upload',
            [
                "order_id" => $responce_new_order3['json']['order_id'],
                "set_status" => "done",
                "payment" => "online",
                "payment_data" => [
                    "datetime" => now()->format('Y-m-d H:i'),
                    "transaction" => (string)rand(111111111, 999911111)
                ]
            ]
        );





        $responce_new_order_with_null_remains = SyncService::post(
            'orders/new',
            [
                "user_bin" => $user_bin,
                "payment" => "cash",
                "reserve" => false,
                "items" => [
                    [
                        "article" => $product_with_null_remains['article'],
                        "quantity" => "3",
                    ]
                ]
            ]
        );

        $responce_order_with_null_remains = SyncService::get(
            'orders/' . $responce_new_order_with_null_remains['json']['order_id']
        );





        $responce_order_by_bin2 = SyncService::get(
            'orders_by_bin/' . $user_bin
        );



        dd(
            $user,
            $responce_new_user,
            $responce_get_user,
            $user_new_data,
            $responce_user_update,
            $responce_get_user_after_update,
            $responce_new_order,
            $responce_order,
            $responce_order_by_bin,
            $data_order_cancel,
            $responce_order_cancel,
            $responce_order1,
            $responce_order2,
            $responce_order_done_bank,
            $responce_new_order3,
            $responce_order3,
            $responce_order_done_online,
            'product_with_null_remains',
            $product_with_null_remains,
            'responce_new_order_with_null_remains',
            $responce_new_order_with_null_remains,
            $responce_order_with_null_remains,
            $responce_order_by_bin2
        );
    }


















    public function remains_test()
    {
        // $faker = Factory::create('ru_RU');

        // $user_bin = (string)rand(100000000000, 999999999999);
        // $user = [
        //     "name" => $faker->lastName . " " . $faker->firstName . " " . $faker->middleName,
        //     "email" => $faker->email,
        //     "bin" => $user_bin,
        //     "company_name" => $faker->company,
        //     "address" => $faker->address,
        //     "phones" => $faker->phoneNumber
        // ];

        // $responce_new_user = SyncService::post(
        //     'users/new',
        //     $user
        // );

        // $responce_get_user = SyncService::get(
        //     'users/' . $user_bin
        // );

        $order_items = [
            [
                "article" => '58381806253822028911810282491900',
                "quantity" => "1",
            ],
            [
                "article" => '27417123962826027793861893779896',
                "quantity" => "1",
            ]
        ];

        // dd($order_items);
        $data = [
            "user_bin" => '123456789005',
            "payment" => "cash",
            "reserve" => false,
            "items" => $order_items
        ];

        // dd($data);

        Log::info('1c orders/new data:  ' . json_encode($data));


        $responce_new_order = SyncService::post(
            'orders/new',
            $data
        );

        dd($responce_new_order, $data);




        $responce_products = SyncService::get(
            'products'
        );
        $products = $responce_products['json']['products'];

        $produсt_for_order = null;
        foreach ($products as $product) {
            if ($product['remains'] > 5) {
                $produсt_for_order = $product;
                break;
            }
        }

        dd($produсt_for_order);


        // dd(
        //     $responce_get_user
        // );
    }

    public function sync_users()
    {
        $role = Role::where('machine_title', 'dealer')->first();
        $users = User::where('role_id', $role->id)->get();
        $responces = [];
        foreach ($users as $user) {
            if ($user->bin) {
                $fio = explode(' ', $user->name);
                $responce = SyncService::get(
                    'users/' . $user->bin
                );

                if ($responce['json']['result'] == 'error') {
                    $responce = SyncService::post(
                        'users/new',
                        [
                            "lastname" => $fio[2] ?? '',
                            "firstname" => $fio[0] ?? '',
                            "surname" => $fio[1] ?? '',
                            "email" => $user->email,
                            "bin" => $user->bin,
                            "company_name" => $user->company_name,
                            "address" => "",
                            "phones" => $user->phone
                        ]
                    );
                    $responces[] = $responce;
                }
            }
        }

        dd('Пользователей добавлено: ' . count($responces));
    }
}
