<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Services\SyncService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class StoreController extends Controller
{
    public function index()
    {
        $orders = Order::orderBy('id', 'desc')->paginate(20);
        return view('site.templates.store.index', compact('orders'));
    }

    public function order_show(Order $order)
    {
        return view('site.templates.store.order', compact('order'));
    }

    public function get_order_by_uuid($uuid)
    {
        $order = Order::where('uuid', $uuid)->first();
        return redirect()->route('storeman.order.show', $order);
    }

    public function set_status_done(Order $order)
    {
        foreach($order->items as $item){
            if ($item->variant){
                $product_variant = ProductVariant::find($item->variant->id);
                $product_variant->quantity = $product_variant->quantity - $item->quantity;
                $product_variant->save();
            } else {
                $product = Product::find($item->product->id);
                $product->quantity = $product->quantity - $item->quantity;
                $product->save();
            }
        }

        $payment = match($order->paymentMethod->machine_title) {
            'nal' => 'cash',
            'contract' => 'contract',
            'beznal' => 'bank_transfer',
            'cloudpayment' => 'online',
        };

        $data = [
            "order_id" => $order->article,
            "set_status" => "done",
            "payment" => $payment
        ];

        Log::info('1c orders/upload data:  ' . json_encode($data));

        $responce = SyncService::post(
            'orders/upload',
            $data
        );

        Log::info('1c orders/upload done: ' . $responce['body']);


        $order->status = 4;
        $order->storeman_id = Auth::user()->id;
        $order->save();
        return back();
    }
}
