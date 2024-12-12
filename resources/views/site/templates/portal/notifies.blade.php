@extends('site.templates.portal')
@section('head')
    @parent
    <link rel="stylesheet" href="{{ asset('css/portal/support.css') }}" />
@endsection


@section('content')
    <div>
        <div class="sect__top">
            <div class="breadcrumb__container d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#!" class="go_back">Назад</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('portal.index') }}">Главная</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('portal.notifies.index') }}">Уведомления</a></li>
                    </ol>
                </nav>
            </div>
            <div class="sect__bottom align-end">
                <div class="title_page">Уведомления</div>

            </div>
        </div>
        <div class="notifies_container">
            @foreach ($notifies as $notify)
                <div class="notifies_item {{ $notify->read_at == null ? 'not-read' : '' }}">
                    <div class="top_notify">
                        <div class="title_notify">
                            {{ $notify->title }}
                        </div>
                        @if ($notify->read_at == null)
                            <a class="notice_exit" href="{{ route('portal.notifies.read', $notify) }}">
                            </a>
                        @endif
                    </div>
                    @if ($notify->message != '')
                        <div class="message_notify">
                            {{ $notify->message }}
                        </div>
                    @endif
                    <div class="date_notify">
                        {{ $notify->human_datetime() }}
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
