@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2 class="admin_title title-p">Изменение пароля</h2>
                </div>
                <div class="pull-right">
                    <a class="btn go_back btn_back" href="#!">
                        <img src="{{ asset('img/arrows-left.svg') }}" alt="">
                        Назад</a>
                </div>
            </div>
        </div>

        
       
        <form class="form_admin"  action="{{ route('admin.users.change_pass_submit', $user) }}" method="POST">
            @csrf
            <div class="card_admin">
            <div class="email_text">
                {{ $user->email }}
            </div>
            <div class="form-group">
                <label>Новый пароль:</label>
                <input class="form-control" type="password" name="newpass" value="">
            </div>
            @error('newpass')
                <small class="text-danger">{{ $message }}</small>
            @enderror

            <div class="form-group">
                <label>Повторите:</label>
                <input class="form-control" type="password" name="renewpass" value="">
            </div>
            @error('renewpass')
                <small class="text-danger">{{ $message }}</small>
            @enderror

            <div>
                <button class="btn btn-primary">Сохранить</button>
            </div>
        </div>
        </form>

    </div>
@endsection
