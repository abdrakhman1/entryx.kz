@extends('layouts.app')
@section('head')
    @parent
    <link rel="stylesheet" href="{{ asset('css/reset.css') }}">
@endsection
@section('content')
    <div class="container">
        <h1 class="admin_title title-p">Sync</h1>

        <a href="/admin/sync/test">test</a>
        <a href="/admin/sync/ip">ip</a>

        <form action="{{ route('admin.sync.get') }}" method="post">
            @csrf
            {{ env('1C_SERVER') }}<input type="text" name="url" id="">
            <input type="submit" value="send">
        </form>
    </div>
@endsection