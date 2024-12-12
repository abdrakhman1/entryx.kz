{{-- @extends('layouts.clean')

@section('content')
    <h1>Вход</h1>

    <div class="card_wrapper">
        <form class="form_request" method="POST" action="/user/login">
            @csrf

            <div class="mb-3">
                <label for="" class="form-label">Email:</label>
                <input type="text" class="form-control" name="email" id="email" value="{{ old('email') }}" required>
                @error('email')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3">
                <label for="" class="form-label">Пароль:</label>
                <input type="password" class="form-control" name="password" id="password" value="{{ old('password') }}" required>
                @error('password')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        
            <button type="submit" class="accept_button btn btn-primary button_width">Вход</button>

        </form>
    </div>


@stop --}}
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <title>Форма входа</title>
</head>

<body>
    <div class="form_login">
        <div class="login_page">
            <a href="/" class="butn_back"><img src="../img/arrows-right.svg" alt="" /> Назад на сайт</a>
            <div class="login_form">
                @if (session()->has('error'))
                    <div class="alert alert-danger" role="alert">
                        {{ session()->get('error') }}
                    </div>
                @endif
                <div class="form_decor"></div>
                <form method="POST" action="/admin_login">
                    @csrf
                    <div>
                        <h2 class="form_title">Вход</h2>
                        <p class="form_text">Введите данные для входа</p>
                    </div>
                    <div>
                        <label for="inputLogin" class="form_label">Логин</label>
                        <input type="text" id="inputLogin" class="form-control" placeholder="Email" name="email"
                            required autofocus>

                    </div>
                    <div>
                        <label for="inputPassword" class="form_label">Пароль</label>
                        <input type="password" id="inputPassword" class="form-control" placeholder="Пароль"
                            name="password" required>
                    </div>

                    <button class="form_butn" type="submit">Войти</button>
                </form>
            </div>
        </div>
    </div>

</body>

</html>
