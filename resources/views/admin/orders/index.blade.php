@extends('layouts.app')
@section('head')
    @parent
    <link rel="stylesheet" href="{{ asset('css/reset.css') }}">
@endsection
@section('content')
    <div class="container">
        <h1 class="admin_title title-p">Заказы </h1>
        @if ($orders->isEmpty())
        Список заказов пуст.
        @else
        <table class="admin_table table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Дата заказа</th>
                    <th>Сумма</th>
                    <th>Способ оплаты</th>
                    <th>Статус оплаты</th>
                    <th>Статус заказа</th>
                    <th>Действия</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                    <tr class="order_item" data-url="/portal/orders/{{ $order->id }}">
                        <td>
                            <a class="order_id" href="{{ route('admin.orders.show', $order) }}">
                                {{ $order->id }}
                            </a>
                        </td>
                        <td> {{ $order->human_date() }} </td>
                        <td> {{ $order->total_amount }} ₸ </td>
                        <td> {{ $order->paymentMethod->title }} </td>
                        <td> {{ $order->payment_status ? 'Оплачен' : '' }} </td>
                        <td>
                            <div class="indicator_box">
                                <div class="indicator {{ $order->status == 4 ? 'bg_green' : 'bg_red' }}"></div>
                                {{ $order->human_status() }}
                            </div>
                        </td>
                        <td>
                            <a class="btn btn_info" href="{{ route('admin.orders.show', $order) }}">Show</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        @endif
    </div>
@endsection
