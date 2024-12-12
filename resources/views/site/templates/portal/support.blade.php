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
                    </ol>
                </nav>
            </div>
            <div class="sect__bottom align-end">
                <div class="title_page">Тех.поддержка</div>
                <a class="butn butn-green" href="{{ route('portal.tickets.create') }}">Новое обращение</a>
            </div>
        </div>
        <div class="support_items">
            @foreach ($tickets as $ticket)
                <div class="support_item-box">
                    <a class="support_item" href="{{ route('portal.tickets.show', $ticket->id) }}">
                        <div class="col">
                            <p>ID запроса:</p>
                            <div> {{ $ticket->id }}</div>
                        </div>
                        <div class="col">
                            <p>Тема:</p>
                            <div> {{ $ticket->subject }}</div>
                        </div>
                        <div class="col">
                            <p>Дата запроса:</p>
                            <div> {{ $ticket->human_date() }}</div>
                        </div>
                        <div class="col">
                            <p>Статус:</p>
                            <div class="indicator_box">
                                <div class='indicator {{ $ticket->status == 'open' ?  'bg_red' : 'bg_green' }}'></div>
                                {{ $ticket->status == 'open' ? 'В обработке' : 'Закрыт'}}
                            </div>
                        </div>
                    </a>
                    @if ($ticket->status == 'open')
                        <a href='{{ route('portal.tickets.set_close', $ticket) }}'class="btn_close_request"> Закрыть
                            запрос</a>
                    @else
                        <a href='{{ route('portal.tickets.set_open', $ticket) }}'class="btn_open_request">Возобновить</a>
                    @endif
                </div>
            @endforeach

        </div>

        <div>
            {{ $tickets->links() }}
        </div>


    </section>
@endsection
