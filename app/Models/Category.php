<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'parent_id'];

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
}
