@extends('site.templates.main')
@section('head')
    @parent

    <script src="{{ asset('libs/fansybox/fancybox.umd.js') }}"></script>
    <script src="{{ asset('libs/fansybox/carousel.thumbs.umd.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('libs/fansybox/carousel.css') }}" />
    <link rel="stylesheet" href="{{ asset('libs/fansybox/fancybox.css') }}" />
    <link rel="stylesheet" href="{{ asset('libs/fansybox/carousel.thumbs.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/products.css') }}" />
@endsection

@section('content')
    <div>
        <div class=" container sect__top p-top">
            <div class="breadcrumb__container flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a class="go_back" href="#!">Назад</a></li>
                        <li class="breadcrumb-item"><a href="/">Главная</a></li>
                        <li class="breadcrumb-item"><a href="/catalog">Каталог товаров</a></li>
                        <li class="breadcrumb-item"><a href="/catalog/{{ $product->category->id }}">
                                {{ $product->category->title }}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">
                            {{ $product->title }}
                        </li>
                    </ol>
                </nav>
            </div>
            <div class="sect__bottom align-end">
                <h2>{{ $product->title }}</h2>
            </div>
        </div>

        <div class="container container_product">
            <div class="fansy_carousel">
                <div id="productCarousel" class="f-carousel">

                    @if ($product->documents->isEmpty())
                        <div class="f-carousel__slide" data-thumb-src="/img/noimg.jpg" data-fancybox="gallery"
                            data-src="/img/noimg.jpg">
                            <img alt="" data-lazy-src="/img/noimg.jpg" />
                        </div>
                    @endif

                    @foreach ($product->documents as $document)
                        @if ($document->documentType->machine_title == 'product_image')
                            <div class="f-carousel__slide" data-thumb-src="{{ $document->getImagePublicPath() }}"
                                data-fancybox="gallery" data-src="{{ $document->getImagePublicPath() }}">
                                <img alt="" data-lazy-src="{{ $document->getImagePublicPath() }}" />
                            </div>
                        @elseif ($document->documentType->machine_title == 'product_video_link')
                            <a data-label='1' class="f-carousel__slide"
                                data-thumb-src="{{ $document->getYoutubeThumbnailPath() }}" href="{{ $document->link }}"
                                data-fancybox="gallery">
                                <div class="f-carousel__slide--video"></div>
                                <img alt="" src="{{ $document->getYoutubeThumbnailPath() }}">
                            </a>
                        @endif
                    @endforeach

                </div>
            </div>

            <div class="flex-col">
                <div class="flex-col product_card-desc">

                    @if ($product->variants->count() > 0)
                        <div>
                            <h4 class="black">Размер:</h4>
                            <div class="container_size">
                                @foreach ($product->variants as $variant)
                                    <div class="size-item">
                                        {{ $variant->title }}
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    @if ($product->description)
                        <div>
                            <h4 class="black ">Описание:</h4>
                            <p>
                                {!! $product->description !!}
                            </p>
                        </div>
                    @endif

                </div>

                <a href="{{ route('site.branch_offices') }}" class="butn ">
                    <img src="/img/icon-points.svg">
                    Точки продаж
                </a>
            </div>
        </div>
    </div>
    <div class="container">

        <h4 class="title-l title-prod">Общие характеристики:</h4>
        <div class="properties flex-col">
            @foreach ($product->get_properties() as $property)
                <div class="property_item">
                    <div class="item_name">{{ $property->property->title }}:</div>
                    <div class="item_value">{{ $property->value }}</div>
                </div>
            @endforeach
        </div>
    </div>
    @include('site.sections.ask')
@endsection
@section('footerScripts')
    @parent
    <script src="{{ asset('js/product.js') }}"></script>
@endsection
