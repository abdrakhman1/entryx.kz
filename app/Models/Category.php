<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'parent_id', 'slug'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($category) {
            $category->slug = Str::slug($category->title);
        });

        self::updated(function ($category) {
            $category->slug = Str::slug($category->title);
        });

        static::updating(function ($category) {
            $category->slug = Str::slug($category->title);
        });
    }

    // Get the parent category
    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    // Get the child categories
    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    // Get the products for the category
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function properties()
    {
        return $this->hasMany(Property::class);
    }

    public static function menu()
    {
        return Category::orderBy('id', 'asc')->get();
    }
}
