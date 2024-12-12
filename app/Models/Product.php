<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ProductVariant;
use App\Models\Cart;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'category_id',
        'title',
        'slug',
        'description',
        'article',
        'price',
        'quantity',
        'visible',
        'store_place',
        'requisite'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($product) {
            $product->slug = Str::slug($product->title);
        });

        self::updated(function ($product) {
            $product->slug = Str::slug($product->title);
        });

        static::updating(function ($product) {
            $product->slug = Str::slug($product->title);
        });
    }

    public static function scopeVisible($query)
    {
        return $query->where('visible', 1);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class)->withPivot('quantity');
    }

    public function variants()
    {
        return $this->hasMany(ProductVariant::class);
    }

    public function documents()
    {
        return $this->morphMany(Document::class, 'documentable');
    }

    public function propertyValues()
    {
        return $this->hasMany(PropertyValue::class);
    }

    public function get_main_image_path($size_name = ''){
        $document = $this->documents()->orderBy('main', 'desc')->first();
        if ($document == null){
            return "/img/noimg.jpg";
        }
        return $document->getImagePublicPath($size_name);
        // return $document->file_path;
    }

    public function get_properties()
    {
        $property_values = PropertyValue::where('product_id', $this->id)->get();
        return $property_values;
    }

    public function price_minimum()
    {
        if ($this->variants->count() > 1){
            $price_minimum = $this->variants->first();
            foreach($this->variants as $variant){
                if ($variant->price < $price_minimum){
                    $price_minimum = $variant->price;
                }
            }
            return $price_minimum;
        } else {
            return $this->price;
        }

    }

}
