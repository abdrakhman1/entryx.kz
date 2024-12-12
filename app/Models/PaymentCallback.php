<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentCallback extends Model
{
    use HasFactory;

    protected $fillable = [
        'HMAC',
        'order_id',
        'transaction_id',
        'card_last_four',
        'status',
        'ip',
        'data',
        'raw_body',
    ];
}
