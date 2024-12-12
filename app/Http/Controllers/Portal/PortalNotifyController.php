<?php

namespace App\Http\Controllers\Portal;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Notify;
use Illuminate\Support\Facades\Auth;

class PortalNotifyController extends Controller
{
    public function index()
    {
        $notifies = Notify::where('user_id', Auth::user()->id)->orderBy('id', 'desc')->paginate(20);
        return view('site.templates.portal.notifies', compact('notifies'));
    }

    public function read(Notify $notify)
    {
        if (Auth::user()->id != $notify->user_id){
            return abort(404);
        }
        $notify->read_at = now();
        $notify->save();
        return [
            'notify' => $notify,
            'unreaded_count' => Notify::unreaded_count()
        ];
    }
}
