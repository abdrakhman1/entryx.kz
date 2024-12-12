@extends('site.templates.portal')
@section('head')
    @parent
    <link rel="stylesheet" href="{{ asset('css/portal/orders-cart.css') }}" />
@endsection

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/portal/index">Назад</a></li>
            <li class="breadcrumb-item"><a href="/portal/index">Главная</a></li>
            <li class="breadcrumb-item active" aria-current="page">
                Заказы
            </li>
        </ol>
    </nav>
    <div class="title_page mb-3">Заказы</div>
    <div style="color: #999; font-size: 12px">
        Заказы, которые не будут оплачены в течении 72 часов автоматически будут отменены.
    </div>

    @if (!$orders->isEmpty())
    <div class="order_categories">
        <a href="#!" class="order_category active">Все</a>
        {{-- <a href="#!" class="order_category">Текущие</a> --}}
        {{-- <a href="#!" class="order_category">Выполненные</a> --}}
        {{-- <a href="#!" class="order_category">Отмененные</a> --}}
    </div>
    <div class="order_desktop">
        <table id='tableCartOrder' class="table_cart table_cart_order">
          <thead>
              <tr>
                  <th>ID</th>
                  <th>Дата заказа</th>
                  <th>Сумма</th>
                  <th>Способ оплаты</th>
                  <th>Статус </th>
              </tr>
          </thead>
          <tbody>
              @foreach ($orders as $order)
                  <tr class="order_item" data-url="/portal/orders/{{ $order->id }}">
                      <td> <a class="order_id" href="#!">{{ $order->id }}</a></td>
                      <td> {{ $order->human_date() }} </td>
                      <td> {{ $order->total_amount }} ₸ </td>
                      <td> {{ $order->paymentMethod->title }} </td>
                      <td>
                          <div class="indicator_box">
                            <div class="indicator {{ $order->status == 4 ?  'bg_green': 'bg_red'   }}"></div>
                            {{ $order->human_status() }}

                          </div>
                      </td>
                  </tr>
              @endforeach
          </tbody>
        </table>
    </div>

    <div class="order_mobile">
        <div class="order_items">
            @foreach ($orders as $order)
                <div class="order_item" data-url="/portal/orders/{{ $order->id }}">
                    <div class="item"><span>ID</span>{{ $order->id }}</div>
                    <div class="item"><span>Дата заказа</span>{{ $order->human_date() }}</div>
                    <div class="item"><span>Сумма</span>{{ $order->total_amount }}</div>
                    <div class="item"><span>Способ оплаты</span>{{ $order->paymentMethod->title }}</div>
                    <div class="item"><span>Статус</span>
                        <div class="indicator_box">
                            <div class="indicator {{ $order->status == 4 ?  'bg_green': 'bg_red'   }}"></div>
                            {{ $order->human_status() }}
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    @else
    <p class="text_empty">У вас нет текущих заказов</p>
    @endif
    <div class="pagination">

        {{ $orders->links() }}

    </div>
@endsection
@section('footerScripts')
    @parent
    <script src="{{ asset('js/portal-orders.js') }}"></script>
@endsection
