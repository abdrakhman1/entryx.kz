@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h1 class="admin_title title-p">Product Details</h1>
                </div>
                <div class="pull-right">
                    <a class="btn btn_back" href="{{ route('admin.products.index') }}">
                        <img src="{{ asset('img/arrows-left.svg') }}" alt="">
                        Назад</a>
                </div>
            </div>
        </div>
        <div class="form_admin">
            <div class="card_admin">
                <h3 class="card_title">ID: {{ $product->id }}</h5>
                    <div class="card-text">
                        <h4>Название:</h4> {{ $product->title }}
                    </div>
                    <div class="card-text">
                        <h4>Описание:</h4> {!! $product->description !!}
                    </div>
                    <div class="card-text">
                        <h4>Цена:</h4> {{ $product->price }}
                    </div>
                    <div class="card-text">
                        <h4>Категория:</h4> {{ $product->category->title }}
                    </div>
                    <div class="card-text">
                        <h4>Отображение:</h4> {{ $product->visible ? 'Yes' : 'No' }}
                    </div>
            </div>

            <div class="card_admin">
                <h3 class="card_title">Файлы</h3>
                <ul>
                    @foreach ($product->documents as $document)
                        <li>
                            {{ $document->id }}, {{ $document->documentType->name }}
                            
                            @if ($document->documentType->machine_title == "product_image")
                                <img src="{{ $document->getImagePublicPath() }}" alt="" style="width: 50px">
                            @elseif ($document->documentType->machine_title == "product_video_link")
                                <a href="{{ $document->link }}" target="_blank"> 
                                    Ссылка
                                </a>
                            @endif

                            @if ($document->documentType->machine_title == "product_image")
                                @if (!$document->main)
                                    <a href="{{ route('admin.products.documents.make_main', [$product, $document]) }}">
                                        Сделать главным
                                    </a>
                                @else
                                    Главный документ
                                @endif
                            @endif


                            <form action="{{ route('admin.products.documents.destroy', $document) }}" method="POST"
                                class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Are you sure you want to delete this post?')">Delete</button>
                            </form>
                        </li>
                    @endforeach
                </ul>

                <a class="btn_add" href="{{ route('admin.products.documents.create', [$product->id]) }}">Добавить
                    изображение или видео
                    Youtube</a>
            </div>
            <div class="card_admin">
            <div class="card_title">
                Варианты:</div>
                <ul class="card_table">
                    @foreach ($product->variants as $variant)
                        <li class="card-text">
                            {{ $variant->title }},
                            {{ $variant->price }} тенге,
                            {{ $variant->quantity }} шт,
                           <div>
                            <a class="btn" href="{{ route('admin.products.variants_edit', [$product->id, $variant->id]) }}">
                                Изменить
                            </a> 
                            <a class="btn" href="{{ route('admin.products.variants_delete', [$product->id, $variant->id]) }}"
                                onclick="return confirm('Удалить?')">
                                Удалить
                            </a>
                           </div>
                        </li>
                    @endforeach
                </ul>
                <a class="btn_add" href="{{ route('admin.products.variants_create', [$product->id]) }}">
                    Добавить вариант
                </a>
            
        </div>

        <div class="card_admin">
            <div class="card_title">
                Свойства:</div>
                <ul class="card_table">
                    @foreach ($properties as $property)
                        <li>
                            {{ $property->property->title }}:
                            {{ $property->value }}
                        </li>
                    @endforeach
                </ul>
            </div>

        </div>

    </div>
@endsection
