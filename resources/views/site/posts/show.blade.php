@extends('site.template.main')

@section('content')
    <div class="container">
        <h1>{{ $post->title }}</h1>
        <p><img src="{{ $post->image }}" alt=""></p>
        <div>{!! $post->content !!}</div>
    </div>
@endsection
