@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h1 class="admin_title title-p">{{ $post->title }}</h1>
                </div>
                <div class="pull-right">
                    <a class="btn btn_back" href="{{ route('admin.posts.index') }}"> 
                        <img src="{{asset('img/arrows-left.svg')}}" alt="">
                        Назад</a>
                </div>
            </div>
        </div>
        
        <div class="container_post card_admin">
            <div><img src="{{ $post->image }}" alt=""></div>
        <p class="card_item">{!! $post->content !!}</p>
        <p class="card_item"><span>Visible:</span>{{ $post->visible ? 'Yes' : 'No' }}</p>
        <div>
            <a href="{{ route('admin.posts.edit', $post) }}" class="btn btn_primary">Редактировать</a>
        <form action="{{ route('admin.posts.destroy', $post) }}" method="POST" class="d-inline">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn_danger" onclick="return confirm('Are you sure you want to delete this post?')">Удалить</button>
        </form>
        </div>
        </div>
    </div>
@endsection
