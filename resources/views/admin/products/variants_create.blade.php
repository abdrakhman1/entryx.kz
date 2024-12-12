@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2 class="admin_title title-p">Добавление варианта товара</h2>
                </div>
                <div class="pull-right">
                    <a class="btn btn_back" href="{{ route('admin.products.show', [$product->id]) }}">
                        <img src="{{asset('img/arrows-left.svg')}}" alt="">
                        Назад</a>
                </div>
            </div>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.products.variants_store', [$product->id]) }}" method="POST">
            @csrf

            <div class="row form_admin">
                <div class="form-group">
                    <label>Название:</label>
                    <input type="text" name="title" class="form-control" placeholder="Название">
                </div>

                <div class="form-group">
                    <label>Цена:</label>
                    <input type="number" step="0.01" name="price" class="input_price form-control input-sm" placeholder="Цена">
                </div>

                <div class="form-group">
                    <label>Количество:</label>
                    <input type="quantity" step="1" name="quantity" class="form-control input-sm" placeholder="Количество">
                </div>

                <div class="form-group">
                    <label>Артикул:</label>
                    <input type="text" name="article" class="form-control" placeholder="Артикул">
                </div>

                <div class="form-group">
                    <label>Реквизит:</label>
                    <input type="text" name="requisite" class="form-control" placeholder="Реквизит">
                </div>

                <div class="form-group">
                    <label>Место на складе:</label>
                    <input type="text" name="store_place" class="form-control" placeholder="Место на складе">
                </div>


                <input type="hidden" name="id" value="{{ $product->id }}">

                <button type="submit" class="btn btn_add">Добавить</button>
            </div>
        </form>
    </div>
@endsection
