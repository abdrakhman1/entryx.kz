@extends('layouts.app')

@section('content')
    <div class="container">
        @foreach ($products as $product)
            <div>
                <h2>{{ $product->title }}</h2>
                <!-- Остальная информация о товаре -->
            </div>
        @endforeach
    </div>
@endsection
