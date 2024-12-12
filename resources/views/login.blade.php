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
