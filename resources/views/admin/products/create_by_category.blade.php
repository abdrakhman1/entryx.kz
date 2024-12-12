@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2 class="admin_title title-p">Добавление товара "{{ $category->title }}"</h2>
                </div>
                <div class="pull-right">
                    <a class="btn btn_back" href="{{ route('admin.products.index') }}"> 
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

        <form action="{{ route('admin.products.store') }}" method="POST">
            @csrf

            <div class="row form_admin">
                <div class="form-group">
                    <label>Название:</label>
                    <input type="text" name="title" class="form-control" placeholder="Название">
                </div>
                <div class="form-group">
                    <label>Категория:</label>
                    <select name="category_id" class="form-control">
                        <option value="{{ $category->id }}">{{ $category->title }}</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Описание:</label>
                    <textarea class="form-control" style="height:150px" name="description" placeholder="Описание"></textarea>
                </div>
                <div class="form-group">
                    <label>Цена:</label>
                    <input   type="number" step="0.01" name="price" class="input_price form-control input-sm" placeholder="Цена">
                    
                </div>

                <div class="form-group">
                    <label>Количество:</label>
                    <input type="number" name="quantity" class="form-control input-sm" placeholder="Количество" />
                </div>

                <div class="form-group">
                    <h4>Свойства:</h4>
                    @foreach ($properties as $property)
                        {{ $property->title }}
                        <input type="text" name="property[{{ $property->id }}]" value="">
                    @endforeach
                </div>

                

                <button type="submit" class="btn btn_add">Добавить</button>
            </div>
        </form>
    </div>
@endsection
