@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2 class="admin_title title-p">Добавление товара</h2>
                </div>
                <div class="pull-right">
                    <a class="btn btn_back" href="{{ route('admin.products.index') }}">
                        <img src="{{ asset('img/arrows-left.svg') }}" alt="">
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
                    <select name="category_id" class="form-select">
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->title }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Описание:</label>
                    <textarea class="form-control ckeditor" style="height:150px" name="description" placeholder="Описание"></textarea>
                </div>
                <div class="form-group">
                    <label>Цена:</label>
                    <input type="number" step="0.01" name="price" class="input_price form-control input-sm"
                        placeholder="Цена">
                </div>

                <div class="form-group">
                    <label>Количество:</label>
                    <div>
                        <input type="number" name="quantity" class="form-control input-sm" placeholder="Количество" />
                        <input class="custom-checkbox" type="checkbox" id="onRequest" name="onRequest" value="no">
                        <label class="label_check" for="onRequest">Под заказ</label>
                    </div>
                </div>

                <div class="form-group">
                    <label>Место на складе:</label>
                    <input type="text" name="store_place" class="form-control" placeholder="Место на складе" value="{{ old('store_place') }}">
                </div>


                <button type="submit" class="btn btn_add">Добавить</button>
            </div>
        </form>
    </div>

    <script src="//cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.ckeditor').ckeditor();
        });
    </script>
    <script type="text/javascript">
        CKEDITOR.replace('content', {
            filebrowserUploadUrl: "{{ route('ckeditor.image-upload', ['_token' => csrf_token()]) }}",
            filebrowserUploadMethod: 'form'
        });
    </script>

@endsection
