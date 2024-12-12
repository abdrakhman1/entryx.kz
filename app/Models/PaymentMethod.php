<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'machine_title',
        'visible',
        // Другие поля способа оплаты
    ];

    // Опционально: связь с заказами
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public static function scopeVisible($query)
    {
        return $query->where('visible', 1);
    }
}
