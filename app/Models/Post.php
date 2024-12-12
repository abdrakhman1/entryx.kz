<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'image',
        'content',
        'slug',
        'post_type_id',
        'visible',
        // Другие поля поста
    ];

    protected $casts = [
        'visible' => 'boolean',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($post) {
            $post->slug = Str::slug($post->title);
        });

        self::updated(function ($post) {
            $post->slug = Str::slug($post->title);
        });

        static::updating(function ($post) {
            $post->slug = Str::slug($post->title);
        });
    }

    public function postType()
    {
        return $this->belongsTo(PostType::class);
    }

    public function getImagePublicPath()
    {
        return $this->image;
    }

    public function getImageAppPath()
    {
        return '/public' . $this->image;
    }

    public function getImageSystemPath()
    {
        return public_path($this->image);
    }

    static public function uploadImage($image_resurce)
    {
        $originName = $image_resurce->getClientOriginalName();
        $fileName = pathinfo($originName, PATHINFO_FILENAME);
        $extension = $image_resurce->getClientOriginalExtension();
        $fileName = $fileName . '_' . time() . '.' . $extension;
        $image_resurce->move(public_path('images'), $fileName);
        $url = '/images/' . $fileName;

        return $url;
    }
}
