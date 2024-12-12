@extends('site.templates.portal')
@section('head')
    @parent
    <link rel="stylesheet" href="{{ asset('css/portal/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/portal/orders-cart.css') }}" />
@endsection

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/portal/index">Назад</a></li>
            <li class="breadcrumb-item"><a href="/portal/index">Главная</a></li>
            <li class="breadcrumb-item"><a href="/portal/orders">Заказы</a></li>
            <li class="breadcrumb-item" aria-current="page">
                <a href="{{ route('portal.user.order.show', $order) }}">
                    Заказ № {{ $order->id }}
                </a>
            </li>
            <li class="breadcrumb-item active">Оплата</li>
        </ol>
    </nav>
    <div class="text-center kaspi_qr_page">
        <h1 class="fs-2 mb-3">Сумма оплаты: <span class="fw-bold">{{ $order->total_amount }} ₸ </span></h1>
        <p class="mb-3">
            После оплаты свяжитесь с менеджером
        </p>
        <img src="/img/kaspi_qr.png" class="kaspi_qr_image" alt="">
    </div>
@endsection
