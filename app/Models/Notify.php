<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use App\Traits\TimestampDisplayTrait;

class Notify extends Model
{
    use HasFactory, TimestampDisplayTrait;

    protected $fillable = [
        'user_id',
        'title',
        'message',
        'read_at',
    ];

    public static function unreaded_count()
    {
        return Notify::where('user_id' , Auth::user()->id)->where('read_at', null)->count();
    }

    public static function last10()
    {
        return Notify::where('user_id' , Auth::user()->id)
            ->where('read_at', null)
            ->orderBy('id', 'desc')
            ->take(10)
            ->get();
    }

    public static function send($user_id, $title = '', $message = '' )
    {
        $notify = Notify::create([
            'user_id' => $user_id,
            'title' => $title,
            'message' => $message,
            'read_at' => null
        ]);
        return $notify;
    }
}
