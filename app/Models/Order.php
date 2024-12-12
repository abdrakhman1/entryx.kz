<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\TimestampDisplayTrait;

class Order extends Model
{
    use HasFactory, TimestampDisplayTrait;

    protected $fillable = [
        'cart_id',
        'user_id',
        'payment_method_id',
        'address_id',
        'total_amount',
        'status',   // 0 - new, 1 - in progress, 2 - waiting payment, 3 - ready to deploy, 4 -done, -1 - cancaled
        'delivery_id',
        'article',
        'uuid',
        'payment_status',
        'storeman_id'
    ];

    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function paymentMethod()
    {
        return $this->belongsTo(PaymentMethod::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function storeman()
    {
        return $this->belongsTo(User::class, 'storeman_id');
    }

    public function delivery()
    {
        return $this->belongsTo(Delivery::class);
    }

    public function payment_link_model()
    {
        return $this->hasOne(PaymentLink::class, 'order_id');
    }



    public function products_quantity()
    {
        $quantity = 0;
        foreach ( $this->items as $item) {
            $quantity += $item->quantity;
        }
        return $quantity;
    }

    public function human_status()
    {
        $text = match ($this->status) {
            '-1' => 'Отменён',
            '0' => 'Создан',
            '1' => 'В обработке',
            '2' => 'Ожидает оплаты',
            '3' => 'Готов к выдаче',
            '4' => 'Выполнен',
            default => '-',
        };
        return $text;
    }

    public static function all_statuses()
    {
        $list = [
            '0' => 'Создан',
            '1' => 'В обработке',
            '2' => 'Ожидает оплаты',
            '3' => 'Готов к выдаче',
            '4' => 'Выполнен',
        ];
        return $list;
    }

    public static function real_all_statuses()
    {
        $list = [
            '-1' => 'Отменён',
            '0' => 'Создан',
            '1' => 'В обработке',
            '2' => 'Ожидает оплаты',
            '3' => 'Готов к выдаче',
            '4' => 'Выполнен',
        ];
        return $list;
    }

    public function human_payment_status()
    {
        return $this->payment_status != 0 ? 'Оплачен' : 'Не оплачен';
    }


}
