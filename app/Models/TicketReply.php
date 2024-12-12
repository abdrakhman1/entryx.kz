<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\TimestampDisplayTrait;
use Illuminate\Support\Facades\Auth;

class TicketReply extends Model
{
    use HasFactory, TimestampDisplayTrait;

    protected $fillable = [
        'ticket_id',
        'user_id',
        'message',
    ];

    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function isOwner()
    {
        $user = Auth::user();
        return $this->user->id == $user->id;
    }
}
