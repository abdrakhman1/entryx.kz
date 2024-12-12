<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RefBook extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'alias',
        'description',
        'options',
        'parrent_id',
        'visible',
        'order',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'options' => 'array',
    ];

    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        'options' => '{"items": []}',
        'order' => 0
    ];

    public function items()
    {
        return $this->hasMany(RefItem::class, 'book_id');
    }

    public static function alias($alias = '')
    {
        return RefBook::where('alias', $alias)->first();
    }
}

