@extends('layouts.app')
@section('head')
    @parent
    <link rel="stylesheet" href="{{ asset('css/reset.css') }}">
@endsection
@section('content')
    <div class="container">
        <h1 class="admin_title title-p">Публикации </h1>
        <a href="{{ route('admin.posts.create') }}" class="btn btn_add">Создать пост</a>

        @if ($posts->isEmpty())
            
        @else
        <table class="admin_table table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Изображение</th>
                    <th>Название</th>
                    <th>Slug</th>
                    <th>Видимость</th>
                    <th>Действия</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($posts as $post)
                    <tr>
                        <td>{{ $post->id }}</td>
                        <td>
                            <img alt="" src="{{ $post->image }}" height="50">
                        </td>
                        <td>{{ $post->title }}</td>
                        <td>{{ $post->slug }}</td>
                        <td>{{ $post->visible ? 'Yes' : 'No' }}</td>
                        <td>
                            <a href="{{ route('admin.posts.show', $post) }}" class="btn btn_info btn-sm">View</a>
                            <a href="{{ route('admin.posts.edit', $post) }}" class="btn btn_primary btn-sm">Edit</a>
                            <form action="{{ route('admin.posts.destroy', $post) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn_danger btn-sm"
                                    onclick="return confirm('Are you sure you want to delete this post?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        @endif
        
    

    </div>
@endsection
