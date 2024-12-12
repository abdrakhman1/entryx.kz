@extends('site.templates.portal')
@section('head')
    @parent
    <link rel="stylesheet" href="{{ asset('css/portal/support.css') }}" />
@endsection


@section('content')
    <section class="container support">
        <div class="sect__top">
            <div class="breadcrumb__container d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#!" class="go_back">Назад</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('portal.index') }}">Главная</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('portal.tickets.index') }}"> Тех.поддержка</a></li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Новое обращение
                        </li>
                    </ol>
                </nav>
            </div>
            <div class="sect__bottom align-end">
                <div class="title_page"> Новое обращение</div>
            </div>
        </div>

        <form class="form_message" action="{{ route('portal.tickets.store') }}" method="post">
            @csrf
            <div class="theme_box">
                <label for="theme_message">Тема обращения:</label>
                <input type="text" name="subject" id="theme_message" value="{{ old('subject') }}" placeholder="Тема">
                @error('subject')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <textarea class="message_field m0" name="message" id="" cols="30" rows="10">{{ old('message') }}</textarea>
            @error('message')
                <small class="text-danger">{{ $message }}</small>
            @enderror
            <div class="btn_box">
                <button class="butn butn-green">Отправить сообщение</button>
            </div>
        </form>



    </section>
@endsection
