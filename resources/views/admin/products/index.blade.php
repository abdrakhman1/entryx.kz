@extends('layouts.app')
@section('head')
    @parent
    <link rel="stylesheet" href="{{ asset('css/reset.css') }}">
@endsection
@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2 class="admin_title title-p">Управление товарами</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn_add" href="{{ route('admin.products.create') }}"> Создание товара</a>
            </div>
        </div>
    </div>

    <form action="{{ route('admin.products.filter') }}" method="GET" class="d-none">
        Фильтр
        <div class="mb-3">
            <label for="category_id" class="form-label">Category:</label>
            <select name="category_id" id="category_id" class="form-control">
                <option value="">Select a category</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->title }}</option>
                @endforeach
            </select>
        </div>
    
        <div class="mb-3">
            <label for="price_from" class="form-label">Price From:</label>
            <input type="number" name="price_from" id="price_from" class="form-control" value="{{ old('price_from') }}">
        </div>
    
        <div class="mb-3">
            <label for="price_to" class="form-label">Price To:</label>
            <input type="number" name="price_to" id="price_to" class="form-control" value="{{ old('price_to') }}">
        </div>
    
        <!-- Добавьте другие поля фильтрации, если необходимо -->
    
        <button type="submit" class="btn btn-primary">Apply Filters</button>
    </form>
    

    <table class="admin_table table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Фотография</th>
                <th>Название</th>
                <th>Описание</th>
                <th>Цена</th>
                <th>Количество</th>
                <th width="280px">Действия</th>
            </tr>
        </thead>
        
        @foreach ($products as $product)
        <tbody>
            <tr>
                <td>{{ $product->id }}</td>
                <td>
                    <img src="{{ $product->get_main_image_path() }}" alt="" style="height: 30px">
                </td>
                <td>
                    <a href="{{ route('admin.products.show',$product->id) }}">
                        {{ $product->title }}
                    </a>
                </td>
                <td>{{ Str::limit(strip_tags($product->description), 150) }}</td>
                <td>{{ $product->price }}</td>
                <td>{{ $product->quantity }}</td>
                <td>
                    <form action="{{ route('admin.products.destroy',$product->id) }}" method="POST">
    
                        <a class="btn btn_info" href="{{ route('admin.products.show',$product->id) }}">Show</a>
    
                        <a class="btn btn_primary" href="{{ route('admin.products.edit',$product->id) }}">Edit</a>
    
                        @csrf
                        @method('DELETE')
    
                        <button type="submit" class="btn btn_danger" onclick="return confirm('Удалить?')">Delete</button>
                    </form>
                </td>
            </tr>
        </tbody>
        
        @endforeach
    </table>

</div>
@endsection
