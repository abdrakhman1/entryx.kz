@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h1 class="admin_title title-p"> Товар: {{ $product->title }}</h1>
                </div>
                <div class="pull-right">
                    <a class="btn btn_back" href="{{ route('admin.products.index') }}">
                        <img src="{{ asset('img/arrows-left.svg') }}" alt="">
                        Назад</a>
                    <a class="btn btn_primary flex"
                        href="{{ route('admin.products.edit', $product->id) }}">Редактировать</a>
                </div>
            </div>
        </div>

        <div class="form_admin form_admin--product">
            <div class="card_admin card_admin-product">
                <div class="flex flex-between">
                    <div class="card_top">
                        <h3 class="card_title">{{ $product->title }}</h3>
                        <div class="card_subtext">{{ $product->category->title }}</div>
                    </div>
                    <div class="flex-col">
                        <div class="visible_box">
                            <h4>Видимость:</h4>
                            <a href="{{ $product->visible ? route('admin.products.set_hidden', $product) : route('admin.products.set_visible', $product) }}">
                                <img src="/img/icon/quill_eye{{ $product->visible ? '' : '-closed' }}.svg">
                            </a>

                        </div>
                        @if ($product->store_place)
                            <div class="flex gap-2">
                                <h4>Место на складе:</h4>
                                {{ $product->store_place }}
                            </div>
                        @endif
                    </div>
                </div>
                <div class="price_quanty_box">
                    <div class="upper_text">{{ $product->price }} ₸</div> <span>/ остаток {{ $product->quantity }}
                        шт</span>
                </div>

                <div class="card_desc">
                    <h4>Описание товара:</h4>
                    @if (!empty($product->description))
                        {!! $product->description !!}
                    @else
                        <p>Описание не добавлено</p>
                    @endif
                </div>

                <div class="card_desc">
                    <h4>Артикул:</h4>
                    @if (!empty($product->article))
                        {{ $product->article }}
                    @else
                        <p>Артикул отсутствует</p>
                    @endif
                </div>

                <div class="card_desc">
                    <h4>Реквизит:</h4>
                    @if (!empty($product->requisite))
                        {{ $product->requisite }}
                    @else
                        <p>Реквизит отсутствует</p>
                    @endif
                </div>

                <div class="card_desc">
                    <h4>Свойства товара:</h4>
                    <ul class="list_property">
                        @forelse ($properties as $property)
                            <li class="property_item">
                                <p>{{ $property->property->title }}:</p>
                                <p>{{ $property->value }}</p>
                            </li>
                        @empty
                            <li>
                                <p>Свойства не добавлены</p>
                            </li>
                        @endforelse
                    </ul>
                </div>

                @if ($product->documents->isEmpty())
                @else
                    <div class="card_desc">
                        <h4>Изображения и видео:</h4>
                        <div class="card_images_box">

                            @foreach ($product->documents as $document)
                                <div class="card_image">
                                    @if ($document->documentType->machine_title == 'product_image')
                                        <div>
                                            <a href="{{ $document->getImagePublicPath() }}" data-fancybox="gallery">
                                                <img src="{{ $document->getImagePublicPath('thumbnail') }}" alt=""
                                                    style="height: 100px" />
                                            </a>
                                        </div>
                                    @elseif ($document->documentType->machine_title == 'product_video_link')
                                        <div>
                                            <a class="link_video" href="{{ $document->link }}" target="_blank">
                                                <img alt="" src="{{ $document->getYoutubeThumbnailPath() }}">
                                            </a>
                                        </div>
                                    @endif
                                    <div class="text_docType"> {{ $document->documentType->name }}</div>
                                    <div class="flex gap-2">
                                        @if ($document->documentType->machine_title == 'product_image')
                                            @if (!$document->main)
                                                <div><a class="btn-grey"
                                                        href="{{ route('admin.products.documents.make_main', [$product, $document]) }}">
                                                        Сделать главным
                                                    </a></div>
                                            @else
                                                <div class="main_doc">Главный документ</div>
                                            @endif
                                        @endif
                                        <form action="{{ route('admin.products.documents.destroy', $document) }}"
                                            method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn_del"
                                                onclick="return confirm('Are you sure you want to delete this post?')">
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <div class="flex  flex-end"><a class="btn_add btn_add-img"
                        href="{{ route('admin.products.documents.create', [$product->id]) }}">
                        Добавить
                        изображение или видео
                        Youtube</a>
                </div>
            </div>
        </div>

        <div class="form_admin">
            <div class="card_admin">
                <h3 class="card_title">
                    Варианты:</h3>
                <a class="btn_add--variant" href="{{ route('admin.products.variants_create', [$product->id]) }}">
                    Добавить вариант
                </a>
                @if ($product->variants->isEmpty())
                @else
                    <table class="admin_table table table_intro">
                        <thead class="black">
                            <tr>
                                <th>Название</th>
                                <th>Цена</th>
                                <th>Количество </th>
                                <th>Артикул </th>
                                <th>Действия</th>
                            </tr>
                        </thead>


                        @foreach ($product->variants as $variant)
                            <tbody>
                                <tr>
                                    <td>{{ $variant->title }}</td>
                                    <td> {{ $variant->price }} тенге</td>
                                    <td> {{ $variant->quantity }} шт</td>
                                    <td> {{ $variant->article }} </td>
                                    <td>
                                        <a class="btn-grey"
                                            href="{{ route('admin.products.variants_edit', [$product->id, $variant->id]) }}">
                                            Изменить
                                        </a>
                                        <a class="btn_danger btn-grey"
                                            href="{{ route('admin.products.variants_delete', [$product->id, $variant->id]) }}"
                                            onclick="return confirm('Удалить?')">
                                            Удалить
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        @endforeach
                    </table>
                @endif

            </div>
        </div>
    </div>


@endsection
