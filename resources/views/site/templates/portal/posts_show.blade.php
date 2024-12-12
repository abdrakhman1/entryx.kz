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
            <li class="breadcrumb-item"><a href="{{ route('portal.posts.index') }}">Статьи</a></li>
            <li class="breadcrumb-item active" aria-current="page">
                {{ $post->title }}
            </li>
        </ol>
    </nav>
    <div class="title_container">
        
        <div class="title_page">{{ $post->title }}</div>
        <div class="data">12.03.2023</div>

    </div>
    <div class="post_content">
        <img src="{{ $post->getImagePublicPath() }}" alt="">

        {!! $post->content !!}
        

    </div>
@endsection
