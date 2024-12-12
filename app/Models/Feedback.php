<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\TimestampDisplayTrait;

class Feedback extends Model
{
    use HasFactory, TimestampDisplayTrait;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'message',
        'filepath1',
        'filepath2',
        'read_at',
        // Другие поля формы обратной связи
    ];
}
