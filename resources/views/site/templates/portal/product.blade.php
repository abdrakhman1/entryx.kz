@extends('site.templates.portal')

@section('head')
    @parent
    <script src="{{ asset('libs/fansybox/fancybox.umd.js') }}"></script>
    <script src="{{ asset('libs/fansybox/carousel.thumbs.umd.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('libs/fansybox/carousel.css') }}" />
    <link rel="stylesheet" href="{{ asset('libs/fansybox/fancybox.css') }}" />
    <link rel="stylesheet" href="{{ asset('libs/fansybox/carousel.thumbs.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/products.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/portal/product-catalog.css') }}">
@endsection

@section('content')
    <section class="container container_prod">
        <div>
            <div class="sect__top">
                <div class="breadcrumb__container d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#!" class="go_back">Назад</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('portal.index') }}">Главная</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('portal.catalog.index') }}">Каталог товаров</a>
                            </li>
                            <li class="breadcrumb-item"><a href="/portal/catalog/{{ $product->category->id }}">
                                {{ $product->category->title }}</a></li>
                            <li class="breadcrumb-item active"><a
                                    href="{{ route('portal.catalog.product', $product) }}">{{ $product->title }}</a></li>
                        </ol>
                    </nav>
                </div>
                <div class="sect__bottom align-end">
                    <div class="title_page">{{ $product->title }}</div>
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
                                    data-thumb-src="{{ $document->getYoutubeThumbnailPath() }}"
                                    href="{{ $document->link }}" data-fancybox="gallery">
                                    <div class="f-carousel__slide--video"></div>
                                    <img alt="" src="{{ $document->getYoutubeThumbnailPath() }}">
                                </a>
                            @endif
                        @endforeach

                    </div>
                </div>

                <div class="flex-col">
                    <div class="flex-col product_card-desc">
                        @if ($product->description)
                            <div>
                                <h4 class="title_s">Описание:</h4>
                                <p class="product_desc">
                                    {!! $product->description !!}
                                </p>
                            </div>
                        @endif
                        ----
                        @if ($product->variants->count() > 0)
                            <div id="prod_price-value"
                                class="prod_price {{ $product->variants->first()->quantity < 1 ? 'no-display' : '' }}">
                                {{ $product->variants->first()->price }} ₸ <span> / в наличии</span>
                            </div>

                            <div id="prod_quantity-zero"
                                class="prod_price flex gap-3 {{ $product->variants->first()->quantity > 0 ? 'no-display' : '' }}">
                                <div class="flex-col gap-2">
                                    <div class="small">Последняя цена </div>{!! $product->variants->first()->price !!} ₸
                                </div> <span> / под заказ</span>
                            </div>
                        @else
                            <div class="prod_price {{ $product->quantity <= 0 ? 'flex gap-3' : '' }}">
                                @if ($product->quantity > 0)
                                    {!! $product->price !!} ₸ <span> / в наличии</span>
                                @else
                                    <div class="flex-col gap-2">
                                        <div class="small">Последняя цена </div>{!! $product->price !!} ₸
                                    </div> <span> / под заказ</span>
                                @endif
                            </div>
                        @endif


                        @if ($product->variants->count() > 0)
                            <div>
                                <h4 class="title_s">Размер:</h4>
                                <div class="container_size">
                                    @foreach ($product->variants as $variant)
                                        <div>
                                            <input {{ $loop->first ? 'checked' : '' }} type="radio"
                                                id="{{ $variant->id }}" name='variant' data-price="{{ $variant->price }}"
                                                data-quantity="{{ $variant->quantity }}"
                                                data-url-variant="{{ route('portal.catalog.product.add_to_cart_variant', $variant->id) }}"
                                            >
                                            <label for="{{ $variant->id }}" class="size-item">
                                                {{ $variant->title }}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                        <div class="flex gap-3">
                            <button id="butnToCart" data-url="{{ route('portal.catalog.product.add_to_cart', $product->id) }}"
                                class="butn butn-green {{ $product->quantity == 0 ? 'no-display' : '' }}">
                                В корзину
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container_parameter">

            <h4 class="title_s">Общие характеристики:</h4>
            <div class="properties flex-col">
                @foreach ($product->get_properties() as $property)
                    <div class="property_item">
                        <div class="item_name">{{ $property->property->title }}:</div>
                        <div class="item_value">{{ $property->value }}</div>
                    </div>
                @endforeach
            </div>
        </div>

    </section>
@endsection
@section('footerScripts')
    @parent
    <script src="{{ asset('js/portal-product.js') }}"></script>

    <script>
        const radioButtons = document.querySelectorAll('input[name="variant"]');
        const valuePrice = document.querySelector('#prod_price-value');
        const valuePriceZero = document.querySelector('#prod_quantity-zero');
        const butnToCart = document.querySelector('#butnToCart');

        radioButtons.forEach(radio => {
            radio.addEventListener('change', event => {
                let {
                    price,
                    quantity
                } = event.target.dataset;
                quantity = parseInt(quantity);
                valuePriceZero.classList.toggle("no-display", quantity > 0);
                valuePrice.classList.toggle("no-display", quantity == 0);
                butnToCart.classList.toggle("no-display", quantity < 1);

                if (quantity > 0) {
                    valuePrice.innerHTML = `${price} ₸ <span> / в наличии ${quantity} шт </span>`;
                } else {
                    valuePriceZero.innerHTML = `<div class="flex-col gap-2">
                <div class="small">Последняя цена </div>${price} ₸
            </div> <span> / под заказ</span>`;
                }
            });
        });

        butnToCart.addEventListener('click', () => {

            if (document.querySelectorAll('[name="variant"]').length > 0) {
                const selectedVariant = document.querySelector('[name="variant"]:checked');
                const urlVariant = selectedVariant.dataset.urlVariant;
                window.location.href = urlVariant;
            } else {
                const urlProd = butnToCart.dataset.url;
                window.location.href = urlProd;
            }
        });
    </script>
@endsection
