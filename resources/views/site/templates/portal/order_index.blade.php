@extends('site.templates.portal')
@section('head')
    @parent
    <link rel="stylesheet" href="{{ asset('css/portal/orders-cart.css') }}" />
@endsection

@section('content')
    <div class="order_box">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/portal/index">Назад</a></li>
                <li class="breadcrumb-item"><a class="go_back" href="#!">Главная</a></li>
                <li class="breadcrumb-item"><a href="/portal/orders">Заказы</a></li>
                <li class="breadcrumb-item active" aria-current="page">
                    Заказ № {{ $order->id }}
                </li>
            </ol>
        </nav>

        <div class="title_page title_box">
            Заказ №{{ $order->id }}
            <div class="data_title">
                от {{ $order->human_datetime() }}
            </div>
        </div>

        <div class="order_status">
            @if ($order->status == -1)
                {{ $order->human_status() }}
            @else
                @foreach ($order->all_statuses() as $status_key => $status_value)
                    <div class="order_status_item {{ $status_key == $order->status ? 'active' : '' }}">
                        <div class="indicator"></div>
                        {{ $status_value }}
                    </div>
                @endforeach
            @endif
        </div>

        <div>
            @if ($order->status == 0)
                <a class="butn_order_cancel" href="{{ route('portal.user.order.cancel', $order) }}">Отменить заказ</a>
            @endif
        </div>

        <div class="order_info_box">
            <ul class="order_info">
                <li>
                    <span>Способ оплаты:</span> {{ $order->paymentMethod->title }}
                </li>
                @if ($order->paymentMethod->machine_title == 'beznal')
                    <li>
                        <span> Реквизиты:</span> <a href="{{ route('portal.user.download_requisits') }}">Скачать</a>
                    </li>
                @endif

            </ul>
            @if ($order->status == 3)
                <div class="qr_box">
                    <a href="{{ route('portal.user.order.qr', $order) }}" class="qr_butn">QR для получения заказа</a>
                </div>
            @endif

            @if ($order->status == 2 && $order->paymentMethod->machine_title == 'kaspi_qr')
                <a href="{{ route('portal.user.order.kaspi_qr', $order) }}" class="qr_butn">
                    Оплатить Kaspi QR
                </a>
            @endif

            @if ($order->status == 2 && $order->payment_status == 0 && $order->paymentMethod->machine_title == 'cloudpayment')
                <a href="{{ route('portal.user.order.online_payment', $order) }}" class="qr_butn">
                    Оплатить онлайн картой
                </a>
            @endif

        </div>
        <div class="order-items_desktop">
            <table id='tableOrder' class="table_cart table_cart_order">
                <thead>
                    <tr>
                        <th>Изображение</th>
                        <th>Наименование</th>
                        <th>Вариант</th>
                        <th>Артикул</th>
                        <th>Количество</th>
                        <th>Цена/ед</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($order->items as $item)
                        <tr>
                            <td>
                                <img class="img_table" src="{{ $item->product->get_main_image_path() }}" alt="">
                            </td>
                            <td>
                                <a href="{{ route('portal.catalog.product', $item->product) }}">
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

        <div class="order-items_mobile ">
            @foreach ($order->items as $item)
                <div class="cart_item_mobile">
                    <div class="cart_item_col">
                        <div class="cart_item_title-box">
                            <div class="cart_item_title">{{ $item->product->title }}</div>
                            <div>{{ $item->variant->title ?? ' ' }}</div>
                        </div>
                        <div class="td_container quantity_container">
                            <div class="quantity"> {{ $item->quantity }} шт</div>
                        </div>
                    </div>
                    <div class="cart_item_col cart_item_col-right">
                        <img class="img_mobile" src="{{ $item->product->get_main_image_path() }}" alt="">
                        <div class="cart_item_price"> {{ $item->product->price * $item->quantity }} ₸</div>
                    </div>
                </div>
            @endforeach
        </div>



        <div class="order_total_sum">
            Общая сумма заказа: <span>{{ $order->total_amount }} ₸</span>
        </div>
    </div>
@endsection
@section('footerScripts')
    @parent
@endsection
