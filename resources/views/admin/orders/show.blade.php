@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2 class="admin_title title-p">Заказ №{{ $order->id }}</h2>
                </div>
                <div class="pull-right">
                    <a class="btn btn_back"href="{{ route('admin.orders.index') }}">
                        <img src="{{ asset('img/arrows-left.svg') }}" alt="">
                        Назад</a>
                </div>
            </div>
        </div>

        <div class="form_admin orders_admin">
            <div>
                <div class="card_title">
                    Заказ №{{ $order->id }} <span class="grey">от {{ $order->human_datetime() }} /
                        {{ $order->article }}</span>
                </div>
                <div class="status_box">
                    <div class="status_items">
                        <div class="status_item  {{ $order->status == 4 ? 'status_green' : '' }}">
                            {{ $order->human_status() }}
                        </div>
                        <div class="storeman_box">

                            @if ($order->status == 4 && $order->storeman)
                                <span> Выдан сотрудником:</span>
                                <a href="{{ route('admin.users.show', ['user' => $order->storeman->id]) }}">
                                    {{ $order->storeman->name }}
                                </a>
                            @endif
                        </div>
                    </div>
                    <div class="dropdown">
                        <button class="btn_secondary dropdown-toggle" type="button" id="dropdownMenuButton2"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Изменить статус:
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                            @foreach ($order->real_all_statuses() as $status_key => $status_value)
                                @if ($order->status == $status_key)
                                    <li class="dropdown-item active"> <b>{{ $status_value }}</b></li>
                                @else
                                    <li class="dropdown-item"><a
                                            href="{{ route('admin.orders.set_status', [$order, $status_key]) }}">
                                            {{ $status_value }}
                                        </a></li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                </div>

            </div>
            <div>
                <div class="table_title">Покупатель: </div>
                <table class="table_order">
                    <thead>
                        <tr>
                            <th>Имя:</th>
                            <th>Компания:</th>
                            <th>Телефон:</th>
                            <th>Email:</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td>
                                <a href="{{ route('admin.dealers.show', $order->user->id) }}">
                                    {{ $order->user->name }}
                                </a>
                            </td>
                            <td>{{ $order->user->company_name }}</td>
                            <td>{{ $order->user->phone }}</td>
                            <td>{{ $order->user->email }}</td>
                        </tr>
                    </tbody>
                </table>

            </div>
            <div>
                <div class="table_title">Товары</div>
                <table class="table_order">
                    <thead>
                        <tr>
                            <th>Изображение</th>
                            <th>Наименование</th>
                            <th>Вариант</th>
                            <th>Артикул</th>
                            <th>Количество</th>
                            <th>Цена/ед</th>
                            <th>Общая сумма</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($order->items as $item)
                            <tr>
                                <td>
                                    <img class="img_table" style="height: 50px"
                                        src="{{ $item->product->get_main_image_path('thumbnail') }}" alt="">
                                </td>
                                <td>
                                    <a href="{{ route("admin.products.show", $item->product) }}">
                                        {{ $item->product->title }}
                                    </a>
                                </td>
                                <td>
                                    {{ $item->variant->title ?? '' }}
                                </td>
                                <td>
                                    {{ $item->variant->article ?? '' }}
                                </td>
                                <td>
                                    {{ $item->quantity }}
                                </td>
                                <td>
                                    @if ($item->variant)
                                        {{ $item->variant->price }}
                                    @else
                                        {{ $item->product->price }}
                                    @endif
                                    ₸
                                </td>
                                <td>
                                    @if ($item->variant)
                                        {{ $item->variant->price * $item->quantity }}
                                    @else
                                        {{ $item->product->price * $item->quantity }}
                                    @endif
                                     ₸
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="pay_box">
                <div>
                    <span>Способ оплаты:</span>
                    {{ $order->paymentMethod->title }}
                </div>
                <div>
                    <span>Статус онлайн оплаты:</span>
                    {{ $order->human_payment_status() }}
                </div>
                <div class="paid_amount">
                    <span>Итого:</span>
                    {{ $order->total_amount }} ₸
                </div>
            </div>
        </div>

    </div>
    <div>
    </div>
@endsection
