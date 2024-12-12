@extends('site.templates.portal')
@section('head')
    @parent
    <link rel="stylesheet" href="{{ asset('css/portal/profile.css') }}" />
@endsection


@section('content')
    <section class="container support">
        <div class="sect__top">
            <div class="breadcrumb__container d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#!" class="go_back">Назад</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('portal.index') }}">Главная</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('portal.user.profile') }}">Профиль компании</a></li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Новый адрес
                        </li>
                    </ol>
                </nav>
            </div>
            <div class="sect__bottom align-end">
                <div class="title_page"> Новый адрес</div>

            </div>
        </div>

        <form class="form_address" action="{{ route('portal.user.addresses.store') }}" method="post">
            @csrf

            <div class="input_box">
                <label>Город:</label>
                <input class="input_address" type="text" name="city" value="{{ old('city') }}">
            </div>
            @error('city')
                <small class="text-danger">{{ $message }}</small>
            @enderror

            <div class="input_box">
                <label>Адрес:</label>
                <input class="input_address" type="text" name="street" value="{{ old('street') }}">
            </div>
            @error('street')
                <small class="text-danger">{{ $message }}</small>
            @enderror

            <button class="butn butn-green">Добавить адрес</button>
        </form>



    </section>
@endsection
