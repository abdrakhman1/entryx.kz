<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BranchOffice extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'image',
        'address',
        'phone',
        'description',
        'latitude',
        'longitude',
        'city_id',
        'user_id',
        'is_visible'
    ];

    public function scopeVisible($query)
    {
        return $query->where('is_visible', true);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
