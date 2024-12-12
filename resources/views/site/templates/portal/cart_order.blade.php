@extends('site.templates.portal')
@section('head')
    @parent
    <link rel="stylesheet" href="{{ asset('css/portal/orders-cart.css') }}" />
@endsection
@section('content')
    <div class="cart_section">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#!" class="go_back">Назад</a></li>
                <li class="breadcrumb-item"><a href="/portal/index">Главная</a></li>
                <li class="breadcrumb-item"><a href="{{ route('portal.user.cart') }}">Корзина</a></li>
                <li class="breadcrumb-item active" aria-current="page">
                    Оформление заказа
                </li>
            </ol>
        </nav>
        <div class="title_page">Ваш заказ</div>

        <div class="cart_desktop">
            <table id='tableCart' class="table_cart">
                <thead>
                    <tr>
                        <th>Изображение</th>
                        <th>Наименование</th>
                        <th>Вариант</th>
                        <th>Цена</th>
                        <th>Количество</th>
                        <th>Общая стоимость</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cart->items as $item)
                        <tr>
                            <td> <img class="img_table" src="{{ $item->product->get_main_image_path() }}" alt="">
                            </td>
                            <td> {{ $item->product->title }}</td>
                            <td> {{ $item->variant->title ?? ' ' }}</td>
                            <td>{{ $item->product->price }} ₸ </td>
                            <td>
                                <div class="td_container quantity_container">
                                    <div class="quantity"> {{ $item->quantity }} </div>
                                </div>
                            </td>
                            <td>{{ $item->product->price * $item->quantity }} ₸</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="cart_mobile cart_mobile_order">
            @foreach ($cart->items as $item)
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
        <form action="{{ route('portal.user.cart.cart_make_order') }}" method="POST" id="checking_form">
            @csrf

            <input type="hidden" name="cart_id" value="{{ $cart->id }}">

            <div class="order_payment">
                <div class="title_page title_page-order">Выбор способа оплаты</div>

                <div class="payment_items">

                    @foreach ($payment_methods as $payment_method)
                        <div class="payment_item">
                            <input id="payment_id_{{ $payment_method->id }}" type="radio" name="payment_method"
                                value="{{ $payment_method->id }}">
                            <label for="payment_id_{{ $payment_method->id }}">
                                {{ $payment_method->title }}
                            </label>
                        </div>
                    @endforeach
                </div>
            </div>
            @error('payment_method')
                <small class="text-danger">{{ $message }}</small>
            @enderror

            <div class="container_right">
                <div id='orderPrice' class="order_price"> Итого: <span>{{ $cart->total_sum() }} ₸</span> </div>
                <div class="flex gap-3 order_registration">
                    <a href="{{ route('portal.user.cart') }}" class="butn-grey butn">Вернуться в корзину</a>
                    <button class="butn butn-green" id="submit_btn">
                        Оформить заказ
                    </button>
                </div>

            </div>
        </form>

    </div>

    <script>
        document.getElementById('submit_btn').addEventListener('click', function() {
            event.preventDefault();
            var form = document.getElementById('checking_form');
            if (form.checkValidity()) {
                this.disabled = true;
                form.submit();
            }
        });
    </script>


@endsection
@section('footerScripts')
    @parent
@endsection
