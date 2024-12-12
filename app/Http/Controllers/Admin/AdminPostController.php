<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class AdminPostController extends Controller
{
    public function index()
    {
        $posts = Post::orderBy('id', 'desc')->get();
        return view('admin.posts.index', compact('posts'));
    }

    public function create()
    {
        return view('admin.posts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'image_file' => 'image|mimes:jpg,png,jpeg|max:9124|dimensions:min_width=100,min_height=100',
            'content' => 'required',
            'visible' => 'boolean',
        ]);

        $filepath = '';
        if($request->hasFile('image_file')) {
            $filepath = Post::uploadImage($request->file('image_file'));
        }

        $data = $request->all();
        $data['image'] = $filepath;
        Post::create($data);

        return redirect()->route('admin.posts.index')
            ->with('success', 'Post created successfully.');
    }

    public function delete_image($id)
    {
        $item = Post::find($id);

        if (!empty($item->image) && file_exists($item->getImageSystemPath())){
            unlink($item->getImageSystemPath());
        }
        $item->image = '';
        $item->save();
        return back();
    }

    public function show(Post $post)
    {
        return view('admin.posts.show', compact('post'));
    }

    public function edit(Post $post)
    {
        return view('admin.posts.edit', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required',
            'image_file' => 'image|mimes:jpg,png,jpeg|max:9124|dimensions:min_width=100,min_height=100',
            'content' => 'required',
            'visible' => 'boolean',
        ]);

        $data = $request->all();

        $filepath = '';
        if($request->hasFile('image_file')) {
            $filepath = Post::uploadImage($request->file('image_file'));
            $data['image'] = $filepath;
        }

        $post->update($data);

        return redirect()->route('admin.posts.index')
            ->with('success', 'Post updated successfully.');
    }

    public function destroy(Post $post)
    {
        $post->delete();

        if (!empty($post->image) && file_exists($post->getImageSystemPath())){
            unlink($post->getImageSystemPath());
        }

        return redirect()->route('admin.posts.index')
            ->with('success', 'Post deleted successfully.');
    }
}
