@extends('site.templates.portal')
@section('head')
    @parent
    <link rel="stylesheet" href="{{ asset('css/portal/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/portal/post-policy.css') }}" />
@endsection

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#!" class="go_back">Назад</a></li>
            <li class="breadcrumb-item"><a href="/portal/index">Главная</a></li>
            <li class="breadcrumb-item active" aria-current="page">
                Статьи
            </li>
        </ol>
    </nav>
    <div class="title_page">Статьи</div>
    <div class="posts_cards">
        @foreach ($posts as $post)
        <div class="post_card">
            <img   src="{{ $post->getImagePublicPath() }}" alt="">
            <div class="post_info">
                <p class="data">  {{ $post->human_date() }}</p>
                <h4>{{ $post->title }}</h4>
                <p class="post_text-prev">{{ Str::limit(strip_tags($post->content), 100) }}</p>
                <a class="link_learn" href="{{ route('portal.posts.show', $post) }}">Узнать</a>
                {{-- <a class="link_learn" href="{{ route ('portal.posts.show'), $post->id}}">Узнать</a> --}}
            </div>
        </div>
        @endforeach
         
        
    </div>
@endsection
