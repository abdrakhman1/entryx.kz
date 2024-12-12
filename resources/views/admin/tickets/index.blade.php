@extends('layouts.app')
@section('head')
    @parent
    <link rel="stylesheet" href="{{ asset('css/reset.css') }}">
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2 class="admin_title title-p">Обращения в тех.поддержку</h2>
                </div>
            </div>
        </div>
        @if ($tickets->isEmpty())
            Обращений в техническую поддержку ещё не поступало.
        @else
        <table class="admin_table table table-bordered">
            <thead>
                <tr>
                    <th>Название</th>
                    <th>Дата</th>
                    <th>Статус</th>
                    <th width="280px">Действия</th>
                </tr>
            </thead>

            @foreach ($tickets as $ticket)
                <tbody>
                    <tr>
                        <td>
                            <a href="{{ route('admin.tickets.show', $ticket) }}">
                                {{ $ticket->subject }}
                            </a>
                        </td>
                        <td>{{ $ticket->human_date() }}</td>
                        <td>
                            <div class="indicator_box">
                                <div class='indicator {{ $ticket->status == 'open' ? 'bg_green' : 'bg_red' }}'></div>
                                {{ $ticket->status }}
                        </td>
                        <td>

                            @if ($ticket->status == 'open')
                                <a href='{{ route('admin.tickets.set_close', $ticket) }}'class="btn btn_danger"> Закрыть
                                    запрос</a>
                            @else
                                <a href='{{ route('admin.tickets.set_open', $ticket) }}'class="btn btn_info">Возобновить</a>
                            @endif

                        </td>
                    </tr>
                </tbody>
            @endforeach
        </table>
        @endif
        

        {{ $tickets->links() }}

    </div>
@endsection
