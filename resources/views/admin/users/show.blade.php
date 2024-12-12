@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2 class="admin_title title-p">Просмотр данных пользователя</h2>
                </div>
                <div class="pull-right">
                    <a class="btn btn_back" href="{{ route('admin.users.index') }}"> <img
                            src="{{ asset('img/arrows-left.svg') }}" alt=""> Назад </a>
                </div>
            </div>
        </div>

        <div class="container_post card_admin">
            <div class="card_item">
                <span>Имя:</span>
                {{ $user->name }}
            </div>
            <div class="card_item card_item--no_border">
                <span>Email:</span>
                {{ $user->email }}
            </div>
        </div>
    </div>
@endsection
