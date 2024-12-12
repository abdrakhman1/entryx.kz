<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Notify;
use App\Models\Order;
use App\Models\Push;
use App\Services\SyncService;
use Illuminate\Support\Facades\Log;

class AdminOrderController extends Controller
{
    public function index()
    {
        $orders = Order::orderBy('id', 'desc')->paginate(20);
        return view('admin.orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        return view('admin.orders.show', compact('order'));
    }

    public function set_status(Order $order, $status_id)
    {
        $order->status = $status_id;
        $order->save();
        Notify::send($order->user->id, 'Статус заказа №' . $order->id . ' был изменён на: «' . $order->human_status() . '»');
        Push::send('Заказ: ' . $order->human_status(), 'Статус вашего заказа был изменён', $order->user->id);

        if ($order->status == -1) {
            $responce = SyncService::post(
                'orders/upload',
                [
                    "order_id" => $order->article,
                    "set_status" => "cancel"
                ]
            );

            Log::info('1c orders/upload cancel data response:  ' . json_encode($responce['body']));
        }

        if ($order->status == 4) {
            $payment = match($order->paymentMethod->machine_title) {
                'nal' => 'cash',
                'contract' => 'contract',
                'beznal' => 'bank_transfer',
                'cloudpayment' => 'online',
                'kaspi_qr' => 'online',
            };

            if ($payment == 'online') {
                $responce = SyncService::post(
                    'orders/upload',
                    [
                        "order_id" => $order->article,
                        "payment" => $payment,
                        "set_status" => "done",
                        "payment_data" => [
                            "datetime" => now()->format('Y-m-d H:i'),
                            "transaction" => "0",
                        ]
                    ]
                );
            } else {
                $responce = SyncService::post(
                    'orders/upload',
                    [
                        "order_id" => $order->article,
                        "payment" => $payment,
                        "set_status" => "done"
                    ]
                );
            }

            Log::info('1c orders/upload data response:  ' . json_encode($responce['body']));

        }


        return back();
    }
}
