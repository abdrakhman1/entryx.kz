<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Intervention\Image\Facades\Image;

class Document extends Model
{
    use HasFactory;

    protected $fillable = [
        'documentable_type', // Тип связанной модели (User, Product, Ticket)
        'documentable_id',  // ID связанной модели
        'document_type_id',
        'title',
        'file_path',
        'link',
    ];

    public function documentable()
    {
        return $this->morphTo();
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function documentType()
    {
        return $this->belongsTo(DocumentType::class);
    }

    public function getImagePublicPath($size_name = '')
    {
        if ($this->document_type_id != 1){
            return "/img/noimg.jpg"; 
        }

        if ($size_name == '') {
            return $this->file_path;
        }

        if (!in_array($size_name, ['thumbnail', 'medium', 'large', 'full'])) {
            // abort(404);
            return "/img/noimg.jpg";
        };

        $rel_path = '/images/' . $size_name . '/';
        if (!file_exists(public_path($rel_path))) {
            mkdir(public_path($rel_path), 0777, true);
        }

        $fileinfo = pathinfo($this->getImageSystemPath());
        $filename = $fileinfo['basename'];

        if (file_exists(public_path($rel_path) . $filename)) {
            return $rel_path . $filename;
        }

        if ($size_name == 'thumbnail') {
            $image_width = 150;
            $image_height = 150;
        } elseif($size_name == 'medium') {
            $image_width = 450;
            $image_height = 450;
        } elseif($size_name == 'large') {
            $image_width = 900;
            $image_height = 900;
        } else {
            return $this->file_path;
        }

        // return (file_exists($this->getImageSystemPath()));
        // return ($this->getImageSystemPath());
        if (!is_file($this->getImageSystemPath())){
            return "/img/noimg.jpg";
        }

        $thumbnail = Image::make($this->getImageSystemPath());
        $thumbnail->resize($image_width, $image_height, function ($constraint) {
            $constraint->aspectRatio();
        });
        $thumbnail->save(public_path($rel_path) . $filename);
        return $rel_path . $filename;
    }

    public function getImageAppPath()
    {
        return '/public' . $this->file_path;
    }

    public function getImageSystemPath()
    {
        return public_path($this->file_path);
    }

    public function getYoutubeThumbnailPath()
    {
        preg_match(
            '/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/)|.*[?&]v=|youtu\.be\/)([^"&?\/\s]{11})/',
            $this->link,
            $matches
        );
        $video_id = $matches[1] ?? null;
        return 'https://img.youtube.com/vi/' . $video_id . '/hqdefault.jpg';
    }
}
