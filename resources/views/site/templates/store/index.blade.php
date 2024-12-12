@extends('site.templates.storeman')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#!" onclick="goBack()">Назад</a></li>
            <li class="breadcrumb-item active"><a href="{{ route('storeman.index') }}">Заказы</a></li>

        </ol>
    </nav>
    <div class="auth_container">
        <h1 class="title_section">Склад</h1>
        <div class="auth_name"> <span>Пользователь:</span> {{ Auth::user()->name }}</div>
    </div>


    <h2 class="title_container">Заказы:</h2>
    <div class="orders_container">
        @foreach ($orders as $item)
        <a href="{{ route('storeman.order.show', $item->id) }}">
        <ul class="order_container">
            <li>
                <span>ID:</span>{{ $item->id }}  
            </li>
            <li>
                <span>Дата создания:</span>{{ $item->human_datetime() }}
            </li>
            <li>
                <span>Кол-во товаров:</span>{{ $item->products_quantity() }}
            </li>
            <li>
                <span>Статус:</span>
                <div class="indicator_box">
                    <div class='indicator {{ $item->human_status() == 'Выполнен' ?  'bg_green' : 'bg_red'  }}'></div>
                    {{ $item->human_status() }}
                </div>
            </li>
        </ul>
    </a>
        @endforeach
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
