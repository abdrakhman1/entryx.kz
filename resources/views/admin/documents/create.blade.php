@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2 class="admin_title title-p">Добавление файлов</h2>
                </div>
                <div class="pull-right">
                    <a class="btn btn_back"href="{{ route('categories.index') }}"> 
                        <img src="{{asset('img/arrows-left.svg')}}" alt=""> Назад</a>
                </div>
            </div>
        </div>
        
                <form class="form_admin" action="{{ route('admin.products.documents.store', $product) }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="title" class="form-label">Название:</label>
                <input type="text" class="form-control" name="title" id="title" value="{{ old('title') }}">
                @error('title')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label for="document_type_id">Тип</label>
                <select class="form-control" id="document_type_id" name="document_type_id">
                    <option value="">-- выберите тип ---</option>
                    @foreach ($document_types as $type)
                        <option value="{{ $type->id }}">{{ $type->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3" id="upload_image_input">
                <label for="file" class="form-label">Загрузить файл:</label>
                <input type="file" class="form-control" name="file" id="file">
                @error('file')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3" id="url_input">
                <label for="url" class="form-label">Файл URL:</label>
                <input type="text" class="form-control" name="url" id="url" value="{{ old('url') }}">
                @error('url')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <input type="hidden" name="product_id" value="{{ $product->id }}">
            <button type="submit" class="btn btn_add">Добавить</button>
        </form>

        
        
    </div>
@endsection
