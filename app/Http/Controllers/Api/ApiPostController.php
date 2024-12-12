<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Post;

class ApiPostController extends Controller
{
    public function posts()
    {
        $posts = Post::select(['id', 'title', 'image', 'content'])->orderBy('id', 'desc')->paginate(6);
        foreach ($posts as $post){
            if ($post->image){
                $post['image'] = url($post->image);
            }
            $post['content'] =  substr(strip_tags($post->content), 0, 200) . "...";
        }
        return $this->sendResponse($posts);
    }

    public function show(Post $post)
    {
        if ($post->image){
            $post['image'] = url($post->image);
        }
        return $this->sendResponse($post);
    }
}
