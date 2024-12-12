@extends('site.templates.portal')
@section('head')
    @parent
    <link rel="stylesheet" href="{{ asset('css/catalog.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/portal/catalog.css') }}">
    <script src="{{ asset('libs/jquery/ui_1.13.2_jquery-ui.js') }}"></script>
    <script src="{{ asset('libs/jquery/jquery.ui.touch-punch.js') }}"></script>
    {{-- оба скрипта необходимы для работы range с мобильных ус-в --}}
@endsection
@section('content')
    <section class="container container_portal">
        <div class="sect__top">
            <div class="breadcrumb__container d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#!" class="go_back">Назад</a></li>
                        <li class="breadcrumb-item"><a href="/">Главная</a></li>
                        <li class="breadcrumb-item" aria-current="page">
                            Каталог товаров
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            <a href="portal/catalog/{{ $products[0]->category->id }}">
                                {{ $products[0]->category->title }}</a>
                            </li>
                    </ol>
                </nav>
            </div>
            <div class="sect__bottom align-end">
                <div class="title_page">Каталог</div>
                <div class="cards_top">
                    <div class="select">
                        <a class="select_open" href="#!">
                            Сортировать по:
                        </a>
                        <div class="select_noshow collapsed">
                            <ul>
                                <li>
                                    <a class="" href="/portal/catalog?orderby=price&direction=desc">
                                        Цена: по убыванию
                                    </a>
                                </li>
                                <li>
                                    <a class="" href="/portal/catalog?orderby=price&direction=asc">
                                        Цена: по возрастанию
                                    </a>
                                </li>
                                <li> <a class="" href="?">
                                        Порядок: по умолчанию
                                    </a>
                                </li>
                                <li> <a class="" href="/portal/catalog?orderby=created_at&direction=desc">
                                        Порядок: сперва новые
                                    </a>
                                </li>
                                <li><a class="" href="/portal/catalog?orderby=created_at&direction=asc">
                                        Порядок: сперва старые
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="filters_butn show-mobile butn-greylight gap-4">
                        <img class="icon-search" src="/img/icon-filters.svg" alt=""> Фильтры
                        <div class="show-onclick no-display"> </div>
                    </div>
                    <div class="butn-greylight p0">
                        <input class="input-search" type="search" name="range-catalog" placeholder="Найти товар" />
                        <button class="search_butn"> </button>
                        <div class="search_window container">
                            <ul>

                            </ul>
                            <button class="search_push"></button> <button class="butn_close-search "></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="catalog__sect">
            <div class="flex flex_revers">
                <div class="overlay-black desktop">
                    <div class='sort_mobile'>
                        @include('site.sections.filters', [
                            'isshop' => true,
                            'filter_data' => $filter_data,
                        ])
                    </div>
                </div>
                <div class="w-100">
                    <div class="catalog__cards">
                        @foreach ($products as $product)
                            <div class="product_catalog {{ $product->quantity < 1 ? 'onRequest' : '' }}">
                                <a href="{{ route('portal.catalog.product', $product) }}" class="product">
                                    <div class="img_box">
                                        <img class="prod_img" src="{{ $product->get_main_image_path('medium') }}"
                                            alt="{{$product->title}}" />
                                        <img class="icon_link" src="/img/icon/link-gray.svg" alt="link" />
                                    </div>
                                    <div class="prod_desc">
                                        <p class="title_s">{{ $product->title }}</p>
                                        <p>{{ $product->category->title }}</p>
                                    </div>
                                </a>
                                <div class="price_box">
                                    <div class="price title_s">от {{ $product->price_minimum() }} ₸</div>
                                    <a class="butn"
                                        href="{{ route('portal.catalog.product.add_to_cart', $product->id) }}"></a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div>
                        {{ $products->links() }}
                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection
@section('footerScripts')
    @parent
    <script src="{{ asset('js/portal-catalog.js') }}"></script>
@endsection
