<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ProductVariant;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'category_id',
        'title',
        'description',
        'price',
        'quantity',
    ];

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
        return $this->hasMany(Document::class);
    }

    public function get_main_image_path(){
        $document = Document::where('product_id', $this->id)->orderBy('main', 'desc')->first();
        if ($document == null){
            return "";
        }
        return $document->file_path;
    }

    public function get_properties()
    {
        $property_values = PropertyValue::where('product_id', $this->id)->get();
        return $property_values;
    }

}
