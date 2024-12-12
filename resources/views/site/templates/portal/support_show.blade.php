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
                            Просмотр обращения
                        </li>
                    </ol>
                </nav>
            </div>
            <div class="sect__bottom align-end">
                <div class="title_page"> {{ $ticket->subject }}</div>
            </div>
        </div>
        <div class="form_dialogs">
            <div class="message_user">
                <div class="user_role">{{ $ticket->user->name }} </div>
                <div> {{ $ticket->message }} </div>
                <div class="date"> {{ $ticket->created_at }}</div>
            </div>

            @foreach ($ticket->replies as $reply)
                <div @class([
                    'message_admin' => ! $reply->isOwner(),
                    'message_user' => $reply->isOwner()
                ])>
                    <div class="user_role"> {{ $reply->user->name }} </div>
                    <div class="date"> {{ $reply->human_datetime() }}</div>
                    {{ $reply->message }}
                </div>
            @endforeach

            @if ($ticket->status == 'open')
                <form class="form_message " action="{{ route('portal.tickets.reply_store', $ticket) }}" method="post">
                    @csrf
                    <textarea class="message_field" name="message" id="" cols="30" rows="10"></textarea>
                    <div class="btn_box">
                        <a href="{{ route('portal.tickets.set_close', $ticket) }}" class="butn butn-grey">Закрыть
                            обращение</a>
                        <button class="butn butn-green">Отправить сообщение</button>
                    </div>
                </form>
            @else
                <div class="support_close">
                    Запрос закрыт (без возможности писать сообщения)
                </div>
            @endif
        </div>

    </section>
@endsection
