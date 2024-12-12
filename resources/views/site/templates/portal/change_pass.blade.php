@extends('site.templates.portal')
@section('head')
    @parent
    <link rel="stylesheet" href="{{ asset('css/portal/profile.css') }}" />
@endsection

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a class="go_back" href="#!">Назад</a></li>
            <li class="breadcrumb-item"><a href="/portal/index">Главная</a></li>
            <li class="breadcrumb-item active" aria-current="page">
                Изменение пароля
            </li>
        </ol>
    </nav>
    <div class="title_page">Изменение пароля</div>

    <div>
        <form class="form_change_pass" action="{{ route('portal.user.profile.change_pass_submit') }}" method="POST">
            @csrf

            <div class="input_box">
                <label>Новый пароль:</label>
                <input class="" type="password" name="newpass" value="">
            </div>
            @error('newpass')
                <small class="text-danger">{{ $message }}</small>
            @enderror

            <div class="input_box">
                <label>Повторите:</label>
                <input class="" type="password" name="renewpass" value="">
            </div>
            @error('renewpass')
                <small class="text-danger">{{ $message }}</small>
            @enderror
            <button class="butn butn-green">Сохранить</button>
        </form>

    </div>

@section('footerScripts')
    @parent
    <script src="{{ asset('js/form-file.js') }}"></script>

@show
@endsection
