<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Property;
use App\Services\SyncService;
use Illuminate\Http\Request;

class AdminSyncController extends Controller
{
    public function index()
    {
        return view('admin.sync.index');
    }

    public function ip(Request $request)
    {
        dd( $request->ip());
        return ;
    }

    public function test()
    {
        // dd(SyncService::get('/api/people/1'));
        return SyncService::get('/RVRYLVpYOElENEQxSEtRU1hIQkUK');
    }

    public function sync_get(Request $request)
    {
        $responce = SyncService::get($request->url);
        dd($responce);
        return ;
    }
}
