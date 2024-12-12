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
                        <li class="breadcrumb-item"><a href="/catalog">Назад</a></li>
                        <li class="breadcrumb-item"><a href="/">Главная</a></li>
                        <li class="breadcrumb-item"><a href="/catalog">Каталог товаров</a></li>
                        <li class="breadcrumb-item active" aria-current="page">
                            STR MX-45
                        </li>
                    </ol>
                </nav>
            </div>
            <div class="sect__bottom align-end">
                <h2>Карточка товара</h2>
            </div>
        </div>

        <div class="container container_product">


             
            <div class="fansy_carousel">
                <div id="productCarousel" class="f-carousel">

                    <div class="f-carousel__slide" data-thumb-src="/img/door1.webp" data-fancybox="gallery" data-src="/img/door1.webp">
                        <img alt="" data-lazy-src="/img/door1.webp" />
                    </div>
                    <div class="f-carousel__slide" data-thumb-src="/img/door2.webp" data-fancybox="gallery"
                        data-src="/img/door2.webp">
                        <img alt="" data-lazy-src="/img/door2.webp" />
                    </div>

                    <a class="f-carousel__slide"  data-thumb-src="/img/preview-s.png" href="https://youtu.be/DujkHoIhWco" data-fancybox="gallery"><img alt="" width="200" 
                          src="/img/preview-s.png" ></a>
                    
                    <div class="f-carousel__slide" data-thumb-src="/img/door3.webp" data-fancybox="gallery" data-src="/img/door3.webp">
                        <img alt="" data-lazy-src="/img/door3.webp" />
                    </div>
                    <div class="f-carousel__slide" data-thumb-src="/img/door1.webp" data-fancybox="gallery"
                        data-src="/img/door1.webp">
                        <img alt="" data-lazy-src="/img/door1.webp" />
                    </div>
                    <div class="f-carousel__slide" data-thumb-src="/img/door1.webp" data-fancybox="gallery" data-src="/img/door1.webp">
                        <img alt="" data-lazy-src="/img/door1.webp" />
                    </div>
                    <div class="f-carousel__slide" data-thumb-src="/img/door2.webp" data-fancybox="gallery"
                        data-src="/img/door2.webp">
                        <img alt="" data-lazy-src="/img/door2.webp" />
                    </div>
                </div>
            </div>
 
            <div class="flex-col">
                <h4 class="title-mupper black">дверь STR MX-45</h4>
                <div class="flex-col gap-3">
                    <p>Размер</p>
                    <div class="container_size">
                        <div class="size-item">860х2050 L</div>
                        <div class="size-item">860х2050 R</div>
                        <div class="size-item">960х2050 L</div>
                        <div class="size-item">960х2050 R</div>
                    </div>
                </div>
                <a href="/points_sale" class="butn "><img src="./img/icon-points.svg">Точки продаж</a>
            </div>
        </div>
    </div>
    <div class="container">

        <h4 class="title-l title-prod">Общие характеристики:</h4>
        <div class="properties flex-col">
            <div class="property_item">
                <div class="item_name">Количество контуров уплотнения:</div>
                <div class="item_value">3 контура</div>
            </div>
            <div class="property_item">
                <div class="item_name">Толщина полотна:</div>
                <div class="item_value">90 мм</div>
            </div>
            <div class="property_item">
                <div class="item_name">Наполнитель:</div>
                <div class="item_value">Базальтовая плита Isover + пенополистерол</div>
            </div>
            <div class="property_item">
                <div class="item_name">Уплотнитель:</div>
                <div class="item_value">Специализированный дверной уплотнитель</div>
            </div>
            <div class="property_item">
                <div class="item_name">Основной замок:</div>
                <div class="item_value">Кале 252 (цилиндровый)</div>
            </div>
            <div class="property_item">
                <div class="item_name">Дополнительный замок:</div>
                <div class="item_value">Кале 257 (сувальдный)</div>
            </div>
            <div class="property_item">
                <div class="item_name">Фурнитура:</div>
                <div class="item_value">Ночная задвижка</div>
            </div>
            <div class="property_item">
                <div class="item_name">Цвет полимерного покрытия:</div>
                <div class="item_value">Антрацит софт</div>
            </div>
            <div class="property_item">
                <div class="item_name">Цвет внутренней панели:</div>
                <div class="item_value">Белый матовый</div>
            </div>
        </div>
    </div>
    @include('site.sections.ask')
@endsection
@section('footerScripts')
    @parent
    <script src="{{ asset('js/product.js') }}"></script>
@endsection
