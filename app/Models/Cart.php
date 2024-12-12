<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'status'    // 0 - new, 1 - processed, 2 - payed, 3 - done
    ];

    public function items()
    {
        return $this->hasMany(CartItem::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function current()
    {
        $user = Auth::user();
        $cart = Cart::where('user_id', $user->id)->where('status', 0)->first();
        if (empty($cart)) {
            $cart = Cart::create([
                'user_id' => $user->id,
                'status' => 0
            ]);
        }
        return $cart;
    }

    public function add_to_cart($product_id, $quantity = 1)
    {
        $product = Product::findOrFail($product_id);

        $cart_item = CartItem::where([
            'product_id' => $product->id,
            'cart_id' => $this->id
        ])->first();

        if (empty($cart_item)) {
            CartItem::create([
                'product_id' => $product->id,
                'cart_id' => $this->id,
                'quantity' => $quantity,
            ]);
        } else {
            if ($cart_item->quantity < $cart_item->product->quantity){
                $cart_item->quantity = $cart_item->quantity + $quantity;
            }
            $cart_item->save();
        }
    }

    public function add_to_cart_variant($variant_id, $quantity = 1)
    {
        $variant = ProductVariant::findOrFail($variant_id);

        $cart_item = CartItem::where([
            'product_id' => $variant->product->id,
            'product_variant_id' => $variant->id,
            'cart_id' => $this->id
        ])->first();

        if (empty($cart_item)) {
            CartItem::create([
                'product_id' => $variant->product->id,
                'product_variant_id' => $variant->id,
                'cart_id' => $this->id,
                'quantity' => $quantity,
            ]);
        } else {
            if ($cart_item->quantity < $cart_item->variant->quantity){
                $cart_item->quantity = $cart_item->quantity + $quantity;
            }
            $cart_item->save();
        }

    }

    public function delete_item($cart_item_id)
    {
        CartItem::find($cart_item_id)->delete();
    }

    public function reduce_item($cart_item_id)
    {
        $order_item = CartItem::find($cart_item_id);
        $order_item->quantity--;
        $order_item->save();
        if ($order_item->quantity <= 0) {
            $order_item->delete();
        }
    }

    public function increase_item($cart_item_id)
    {
        $order_item = CartItem::find($cart_item_id);
        if ($order_item->variant){
            if ($order_item->quantity < $order_item->variant->quantity){
                $order_item->quantity++;
            }
        } else {
            if ($order_item->quantity < $order_item->product->quantity){
                $order_item->quantity++;
            }
        }
        $order_item->save();
        return $order_item->quantity;
    }

    public function count()
    {
        return count($this->items);
    }

    public function make_to_order($comment = '', $payment_method_id = 0){
        $user = Auth::user();
        $cart = self::current();
        $payment_method = PaymentMethod::findOrFail($payment_method_id);
        $order = Order::create([
            'user_id' => $user->id,
            'address_id' => 0,
            'comment' => $comment,
            'total_amount' => $cart->total_sum(),
            'status' => 0,
            'uuid' => Str::uuid(),
            'cart_id' => $cart->id,
            'payment_method_id' => $payment_method->id
        ]);

        foreach ($cart->items as $item )
        {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'product_variant_id' => $item->product_variant_id,
            ]);
        }

        $cart->status = 4;
        $cart->save();

        if ($payment_method->machine_title == 'kaspi_qr'){
            PaymentLink::create([
                'link' => 'https://pay.kaspi.kz/pay/c8qjtcwo',
                'order_id' => $order->id,
            ]);
        }


        $payload = [
            [
                "name" => "Заказ с портала",
                "created_by" => 0,
                "price" => $order->total_amount,
                "custom_fields_values" => [
                    [
                        "field_id" => 1605213, // Ссылка на заказ с портала
                        "values" => [
                            [
                                "value" => "https://entryx.kz/admin/orders/" . $order->id
                            ]
                        ]
                    ]
                ],
                '_embedded' => [
                    'contacts' => [
                        [
                            'name' => $user->name,
                            "custom_fields_values" => [
                                [
                                    "field_code" => "PHONE",
                                    "values" => [
                                        [
                                            "enum_code" => "WORK",
                                            "value" => $user->phone
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
        $amo->post('leads/complex', $payload);

        return $order;
    }

    public function total_sum()
    {
        $sum = 0;
        $cart = self::current();
        foreach ($cart->items as $item) {
            if ($item->product_variant_id != null){
                $product_variant = ProductVariant::findOrFail($item->product_variant_id);
                if ($product_variant->price) {
                    $item_multiplication = $item->quantity * $product_variant->price;
                    $sum += $item_multiplication;
                } else {
                    $sum += 0;
                }
            } else {
                $product = Product::findOrFail($item->product_id);
                if ($product->price) {
                    $item_multiplication = $item->quantity * $product->price;
                    $sum += $item_multiplication;
                } else {
                    $sum += 0;
                }
            }
        }
        return $sum;
    }

    public static function items_for_api()
    {
        $items = Cart::current()->items;
        $output = [];
        foreach($items as $item){
            if ($item->product_variant_id != 0){
                $product_variant = ProductVariant::findOrFail($item->product_variant_id);
                $output[] = [
                    'id' => $item->id,
                    // 'product_variant_id' => $item->product_variant_id,
                    'title' => $item->product->title . ' ' . $product_variant->title,
                    'article' => $product_variant->article,
                    'quantity' => $item->quantity,
                    'price' => $product_variant->price,
                    'price_total' => $product_variant->price * $item->quantity,
                ];

            } else {
                $product = Product::findOrFail($item->product_id);
                $output[] = [
                    'id' => $item->id,
                    // 'product_id' => $item->product_id,
                    'title' => $product->title,
                    'article' => $product->article,
                    'quantity' => $item->quantity,
                    'price' => $product->price,
                    'price_total' => $product->price * $item->quantity,
                ];
            }
        }

        return $output;
    }
}
