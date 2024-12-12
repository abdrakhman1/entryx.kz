<?php

namespace App\Services;

use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Log;

class OldOrderCancel
{
    public function __invoke()
    {
        // Log::debug("message OldOrderCancel: test");

        $now = Carbon::now();
        $orders = Order::where('created_at', '<', $now->subHours(72))
            ->whereIn('status', [0, 1, 2])
            ->get();
        if ($orders) {

            foreach ($orders as $order) {
                $order->status = -1;
                $order->save();
                SyncService::post(
                    'orders/upload',
                    [
                        "order_id" => $order->article,
                        "set_status" => "cancel"
                    ]
                );

                Log::debug("message OldOrderCancel: " . $order->article);
            }
        }
    }
}
