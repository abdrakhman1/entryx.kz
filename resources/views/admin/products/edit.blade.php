@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2 class="admin_title title-p">Редактировать товар</h2>
                </div>
                <div class="pull-right">
                    <a class="btn btn_back" href="{{ route('admin.products.show', $product->id) }}"> <img
                            src="{{ asset('img/arrows-left.svg') }}" alt="">
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

        <form class="form_admin" action="{{ route('admin.products.update', $product->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="card_admin">
                <div class="form-group">
                    <label>Название:</label>
                    <input type="text" name="title" value="{{ $product->title }}" class="form-control"
                        placeholder="Название">
                </div>
                <div class="form-group">
                    <label>Категория:</label>
                    <select name="category_id" class="form-select">
                        @foreach ($all_categories as $category)
                            <option
                                value="{{ $category->id }}"
                                @if ($product->category->id == $category->id)
                                    selected
                                @endif
                            >
                                {{ $category->title }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Описание:</label>
                    <textarea class="form-control ckeditor" style="height:150px" name="description" placeholder="Description">{{ $product->description }}</textarea>
                </div>
                <div class="form-group">
                    <label>Артикул:</label>
                    <input type="text" name="article" value="{{ $product->article }}" class="form-control"
                        placeholder="">
                </div>
                <div class="form-group">
                    <label>Реквизит:</label>
                    <input type="text" name="requisite" value="{{ $product->requisite }}" class="form-control"
                        placeholder="">
                </div>
                <div class="form-group">
                    <label>Цена:</label>
                    <input type="number" step="0.01" name="price" value="{{ $product->price }}" class="form-control"
                        placeholder="Цена">
                </div>
                <div class="form-group">
                    <label>Количество:</label>
                    <input type="number" name="quantity" value="{{ $product->quantity }}" class="form-control"
                        placeholder="Количество">
                </div>

                <div class="form-group">
                    <label>Место на складе:</label>
                    <input type="text" name="store_place" class="form-control" placeholder="Место на складе" value="{{ $product->store_place }}">
                </div>


                <div class="flex flex-col gap-sm">
                    <h4 class="title-sub">Свойства:</h4>
                    @foreach ($all_properties as $prop)
                        <div class="form-group">
                            <label> {{ $prop->title }}: </label>
                            <input class="form-control" type="text" name="property[{{ $prop->id }}]"
                                value="{{ $product_properties->where('property_id', $prop->id)->first()->value ?? '' }}">
                        </div>
                    @endforeach
                </div>

                <button type="submit" class="btn btn_add">Сохранить</button>
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
