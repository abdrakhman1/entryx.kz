@extends('layouts.app')
@php
    $support_status = $ticket->status;
@endphp
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h1 class="admin_title title-p">{{ $ticket->subject }}</h1>
                </div>
                <div class="pull-right">
                    <a class="btn btn_back" href="{{ route('admin.tickets.index') }}">
                        <img src="{{ asset('img/arrows-left.svg') }}" alt="">
                        Назад</a>
                </div>
            </div>
        </div>
        <div class="form_admin">
            <div class="form_dialogs">

                <div class="message_user">
                    <div class="user_role">{{ $ticket->user->name }}</div>
                    <div class="date">{{ $ticket->human_datetime() }}</div>
                    {{ $ticket->message }}
                </div>

                @foreach ($ticket->replies as $reply)
                    <div @class([
                        'message_admin' => $reply->isOwner(),
                        'message_user' => !$reply->isOwner(),
                    ])>
                        <div class="user_role"> {{ $reply->user->name }} </div>
                        <div class="date"> {{ $reply->human_datetime() }}</div>
                        {{ $reply->message }}
                    </div>
                @endforeach


                @if ($support_status == 'open')
                    <form class="form_admin" action="{{ route('admin.tickets.reply_store', $ticket) }}" method="post">
                        @csrf
                        <textarea class="message_field" name="message" id="" cols="30" rows="10"></textarea>
                        <div class="flex gap-2 justify-content-end">
                            <a href='{{ route('admin.tickets.set_close', $ticket) }}' class="btn_close">Закрыть запрос</a>
                            <button class="btn_add">Отправить</button>
                        </div>
                    </form>
                @else
                    <div class="support_close">
                        Запрос закрыт (без возможности писать сообщения)
                    </div>
                @endif



            </div>

        </div>
    </div>
@endsection
