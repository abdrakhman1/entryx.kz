@extends('layouts.clean')

@section('content')
    <h1>Профиль {{ $user->name }}</h1>

    <div class="card_wrapper">
        <ul>
            <li>
                {{ $user->name }}
            </li>
            <li>
                {{ $user->email }}
            </li>
            <li>
                <a href="/user/logout">Выход</a>
            </li>
        </ul>
    </div>


@stop