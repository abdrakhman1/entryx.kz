<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentLink extends Model
{
    use HasFactory;

    protected $fillable = [
        'link',
        'order_id',
        'description',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }


}
