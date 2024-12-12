<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'title',
        'price',
        'quantity',
        'article',
        'store_place',
        'requisite'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
