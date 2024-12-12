<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'title',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_property_values')->withPivot('value');
    }

    public function propertyValues()
    {
        return $this->hasMany(PropertyValue::class);
    }


    public static function filter_data($category_id = null)
    {
        $query = PropertyValue::with('property');

        if ($category_id !== null) {
            $query->where('category_id', $category_id);
        }

        $propertyValuesGrouped = $query
            ->orderBy('id', 'desc')
            ->get()
            ->groupBy('property_id')
            ->map(function ($values) {
                return $values->unique('value');
            });

        return $propertyValuesGrouped;
    }
}
