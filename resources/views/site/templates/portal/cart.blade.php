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
                <li class="breadcrumb-item active" aria-current="page">
                    Корзина
                </li>
            </ol>
        </nav>

        <div class="title_page">Корзина</div>
        @if ($cart->count())
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
                            <th> </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cart->items as $item)
                            <tr>
                                <td> <img class="img_table" src="{{ $item->product->get_main_image_path() }}"
                                        alt="">
                                </td>
                                <td> {{ $item->product->title }}</td>
                                <td>
                                    {{ $item->variant->title ?? ' ' }}
                                </td>
                                <td>
                                    @if ($item->product->variants->count() > 0)
                                        {{ $item->variant->price }} ₸
                                    @else
                                        {{ $item->product->price }} ₸
                                    @endif
                                </td>
                                <td>
                                    <div class="td_container quantity_container">
                                        <a class="btn quantity_minus"
                                            href="{{ route('portal.user.cart.reduce', $item->id) }}"></a>
                                        <div class="quantity"> {{ $item->quantity }} </div>
                                        <a href="{{ route('portal.user.cart.increase', $item->id) }}"
                                            class="btn quantity_plus"></a>
                                    </div>
                                </td>
                                <td>
                                    @if ($item->product->variants->count() > 0)
                                        {{ $item->variant->price * $item->quantity }} ₸
                                    @else
                                        {{ $item->product->price * $item->quantity }} ₸
                                    @endif
                                </td>
                                <td>
                                    <div class="td_container"><a href="{{ route('portal.user.cart.delete', $item->id) }}"
                                            class="btn_del"></a></div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="cart_mobile">
                @foreach ($cart->items as $item)
                    <div class="cart_item_mobile">
                        <div class="cart_item_col">
                            <div class="cart_item_title-box">
                                <div class="cart_item_title">{{ $item->product->title }}</div>
                                <div>{{ $item->variant->title ?? ' ' }}</div>
                            </div>
                            <div class="td_container quantity_container">
                                <a class="btn quantity_minus" href="{{ route('portal.user.cart.reduce', $item->id) }}"></a>
                                <div class="quantity"> {{ $item->quantity }} </div>
                                <a href="{{ route('portal.user.cart.increase', $item->id) }}"
                                    class="btn quantity_plus"></a>
                                <div class="td_container"><a href="{{ route('portal.user.cart.delete', $item->id) }}"
                                        class="btn_del"></a></div>
                            </div>
                            <div>
                                @if ($item->product->variants->count() > 0)
                                    {{ $item->variant->price }} ₸ <span class="text_gray">/ 1 шт</span>
                                @else
                                    {{ $item->product->price }}
                                @endif

                            </div>
                        </div>


                        <div class="cart_item_col cart_item_col-right">
                            <img class="img_mobile" src="{{ $item->product->get_main_image_path() }}" alt="">
                            @if ($item->product->variants->count() > 0)
                                <div class="cart_item_price">{{ $item->variant->price * $item->quantity }} ₸</div>
                            @else
                                {{ $item->product->price * $item->quantity }} ₸
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="container_right">
                <div id='orderPrice' class="order_price"> Итого: <span>{{ $cart->total_sum() }} ₸</span> </div>
                <a href="{{ route('portal.user.cart.to_order') }}" class="order_registration butn butn-green">Перейти к
                    оформлению</a>
            </div>
        @else
            <div class="message_cart">Ваша корзина пуста. <a href="{{ route('portal.catalog.index') }}"
                    class="btn_green-light">Перейти к
                    покупкам</a></div>
        @endif
    </div>
@endsection
@section('footerScripts')
    @parent
@endsection
