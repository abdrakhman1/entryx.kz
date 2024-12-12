@extends('layouts.app')
@section('head')
    @parent
    <link rel="stylesheet" href="{{ asset('css/reset.css') }}">
@endsection
@section('content')
    <div class="admin_home">
        <h1 class="admin_title">Система администрирования</h1>

        <a href="/logout" class="butn_admin">
            <h2>Администратор</h2>
            <img src="../img/logout.svg" alt="">
        </a>
    </div>
@stop
