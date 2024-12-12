<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class SiteController extends Controller
{
    public function home()
    {
        return view('site.home');
    }
  
    public function show_post($slug)
    {
        $post = Post::where('slug', $slug)->where('visible', true)->firstOrFail();
        return view('site.posts.show', compact('post'));
    }

    public function about()
    {
        return view('site.templates.pages.about');
    }

    public function catalog()
    {
        return view('site.templates.pages.catalog');
    }

    public function product()
    {
        return view('site.templates.pages.product');
    }

    public function contacts()
    {
        return view('site.templates.pages.contacts');
    }

    public function dealers()
    {
        return view('site.templates.pages.dealers');
    }
    public function points_sale()
    {
        return view('site.templates.pages.points_sale');
    }

    
}