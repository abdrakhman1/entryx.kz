<?php

namespace App\Http\Controllers\Portal;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\PaymentMethod;
use App\Services\SyncService;
use App\Services\EmailService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PortalCartController extends Controller
{
    protected $emailService;

    public function __construct(EmailService $emailService)
    {
        $this->emailService = $emailService;
    }

    public function cart()
    {
        $cart = Cart::current();
        return view('site.templates.portal.cart', compact('cart'));
    }

    public function cart_increase_product($cart_item_id)
    {
        $cart = Cart::current();
        $cart->increase_item($cart_item_id);
        return back();
    }

    public function cart_reduce_product($cart_item_id)
    {
        $cart = Cart::current();
        $cart_item = CartItem::find($cart_item_id);
        if ($cart_item) {
            $cart->reduce_item($cart_item_id);
        }
        return back();
    }

    public function cart_delete_product($cart_item_id)
    {
        $cart = Cart::current();
        $cart->delete_item($cart_item_id);
        return back()->withSuccess('Товар удалён из корзины');
    }

    public function cart_make_order(Request $request)
    {
        $request->validate([
            'payment_method' => 'required',
        ]);

        $user = auth()->user();
        $cart = Cart::current();
        $order = $cart->make_to_order('', $request->payment_method);

        if ($order->paymentMethod->machine_title == 'kaspi_qr'){
            $order->status = 2;
            $order->save();
        }

        if ($order->paymentMethod->machine_title == 'cloudpayment'){
            $order->status = 2;
            $order->save();
            return redirect()->route('portal.user.order.online_payment', $order);
        }

        $order_items = [];

        foreach($order->items as $item){
            $order_items[] = [
                "article" => $item->product->article,
                "quantity" => (string)$item->quantity,
            ];
        }

        $payment = match($order->paymentMethod->machine_title) {
            'nal' => 'cash',
            'contract' => 'contract',
            'beznal' => 'bank_transfer',
            'cloudpayment' => 'online',
            'kaspi_qr' => 'online',
        };

        $data = [
            "user_bin" => $user->bin,
            "payment" => $payment,
            "reserve" => false,
            "items" => $order_items
        ];

        // dd($data);

        $this->emailService->sendOrderConfirmation($order);

        Log::info('1c orders/new data:  ' . json_encode($data));

        $responce = SyncService::post(
            'orders/new',
            $data
        );

        if (!key_exists('body', $responce)){
            // if ($responce['body'] == 'error'){
            //     return back()->withErrors(['Ошибка при создании заказа']);
            // }
            $responce['body'] = 'error';
        }

        Log::info('1c orders/new user_bin ' . $user->bin . ': ' . $responce['body']);

        $order->article = $responce['json']['order_id'] ?? 'none';
        $order->save();

        return redirect()->route('portal.user.order.show', $order);
    }

    public function to_order()
    {
        $cart = Cart::current();
        $payment_methods = PaymentMethod::visible()->get();
        return view('site.templates.portal.cart_order', compact('cart', 'payment_methods'));
    }

    public function reset()
    {
        $cart = Cart::current();
        dump($cart);
        dump($cart->items);
        foreach($cart->items as $item) {
            dump($item);
            dump($item->product);
        }
    }


}
