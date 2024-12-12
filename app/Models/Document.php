<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'document_type_id',
        'title',
        'file_path',
        'link',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function documentType()
    {
        return $this->belongsTo(DocumentType::class);
    }

    public function getImagePublicPath()
    {
        return $this->file_path;
    }

    public function getImageAppPath()
    {
        return '/public' . $this->file_path;
    }

    public function getImageSystemPath()
    {
        return public_path($this->file_path);
    }
}
