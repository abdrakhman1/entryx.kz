@extends('site.templates.storeman')

@section('content')
    <div class="storeman_section">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#!" onclick="goBack()">Назад</a></li>
                <li class="breadcrumb-item"><a href="{{ route('storeman.index') }}">Заказы</a></li>
                <li class="breadcrumb-item active" aria-current="page">
                    Заказ №{{ $order->id }}
                </li>
            </ol>
        </nav>

        <h1 class="title_section">Заказ №{{ $order->id }} <span>от {{ $order->human_datetime() }}</span></h1>

        <div class="info_order">
            <div>
                <span>Статус:</span> {{ $order->human_status() }}
            </div>

            <div>
                <span>Статус оплаты:</span> {{ $order->human_payment_status() }}
            </div>
        </div>

        @if (!($order->human_status() == 'Выполнен'))
            <div>
                <div class="table_title">Покупатель: </div>
                <ul class="shopper_info">
                    <li><span>Имя:</span>{{ $order->user->name }}</li>
                    @if ($order->user->company_name)
                        <li><span>Компания:</span>{{ $order->user->company_name }}</li>
                    @endif
                    @if ($order->user->phone)
                        <li><span>Телефон:</span>{{ $order->user->phone }}</li>
                    @endif
                    @if ($order->user->email)
                        <li><span>Email:</span>{{ $order->user->email }}</li>
                    @endif
                </ul>

            </div>
            <div>
                <div class="table_title">Товары</div>
                <table class="table_order desktop">
                    <thead>
                        <tr>
                            <th>Изображение</th>
                            <th>Наименование</th>
                            <th>Вариант</th>
                            <th>Артикул</th>
                            <th>Количество</th>
                            <th>Место на складе</th>
                            <th>Место на складе</th>
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
                                    {{ $item->product->title ?? '' }}
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
                                    {{ $item->product->store_place ?? '' }}
                                </td>
                                <td>
                                    {{ $item->variant->store_place ?? '' }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="mobile">
                    <div class="products_container">
                        @foreach ($order->items as $item)
                            <div class="product_container">
                                <div class="flex">
                                    <div><img class="img_order" src="{{ $item->product->get_main_image_path('thumbnail') }}"
                                            alt="">
                                    </div>
                                    <div class="product_container_info">

                                        @if ($item->variant->title ?? false)
                                            <div class="product_variant"> {{ $item->variant->title ?? '' }}</div>
                                        @endif

                                        @if ($item->product->store_place ?? false)
                                            <div class="product_place"> <span>Место на складе:</span>
                                                {{ $item->product->store_place ?? '' }} </div>
                                        @endif
                                        @if ($item->variant->store_place ?? false)
                                            <div class="product_place"> <span>Место на складе:</span>
                                                {{ $item->variant->store_place ?? '' }}</div>
                                        @endif
                                        @if ($item->variant->article ?? false)
                                            <div class="product_article"> <span>Артикул:</span>
                                                {{ $item->variant->article ?? '' }}</div>
                                        @endif
                                        <div class="product_count"> {{ $item->quantity }} шт</div>
                                    </div>
                                </div>

                                <div class="product_title"> {{ $item->product->title ?? '' }}</div>
                            </div>
                        @endforeach

                    </div>
                </div>
                <a class="butn_issue" href="{{ route('storeman.order.set_status_done', $order) }}"
                    onclick="return confirm('вы уверены?')">
                    Подтвердить выдачу товара
                </a>
            </div>
        @else
            Товар выдан.
            <a class="butn_back" href="{{ route('storeman.index') }}">
                Вернутся к заказам
            </a>
        @endif

    </div>
@endsection

@section('footerScripts')
    @parent
    <script>
        function goBack() {
            window.history.back();
        }
    </script>
@endsection
