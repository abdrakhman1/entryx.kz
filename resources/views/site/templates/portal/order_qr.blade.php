@extends('site.templates.portal')
@section('head')
    @parent
    <link rel="stylesheet" href="{{ asset('css/portal/style.css') }}" />
@endsection

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a class="go_back" href="#!">Назад</a></li>
        <li class="breadcrumb-item"><a href="/portal/index">Главная</a></li>
        <li class="breadcrumb-item active" aria-current="page">
           QR
        </li>
    </ol>
</nav>
<div class="qr_box">  {!! QrCode::size(270)->generate(url('/storeman/order/uuid/' . $order->uuid)) !!}</div>
  

@endsection
