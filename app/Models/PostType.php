<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class PostType extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        // Другие поля типа страницы
    ];

    protected static function boot()
    {
        parent::boot();

        // static::creating(function ($postType) {
        //     $postType->slug = Str::slug($postType->name);
        // });
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
