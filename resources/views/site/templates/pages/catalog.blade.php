@extends('site.templates.main')
@section('head')
    @parent
    <script src="{{ asset('libs/jquery/ui_1.13.2_jquery-ui.js') }}"></script>
    <script src="{{ asset('libs/jquery/jquery.ui.touch-punch.js') }}"></script>

@endsection

@section('content')
    <section class="container">
        <div class="sect__top p-top ">
            <div class="breadcrumb__container d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a class="go_back" href="#!">Назад</a></li>
                        <li class="breadcrumb-item"><a href="/">Главная</a></li>
                        <li class="breadcrumb-item" aria-current="page">
                            <a href="/catalog">Каталог товаров</a>
                        </li>
                        @if ( !isset($all_category))
                            <li class="breadcrumb-item active" aria-current="page">
                                <a href="/catalog/{{ $products[0]->category->id }}">
                                    {{ $products[0]->category->title }}
                                </a>
                            </li>
                        @endif

                    </ol>
                </nav>
            </div>
            <div class="sect__bottom align-end">
                <h2>Каталог</h2>
                <div class="method">
                    <div class="select">
                        <a class="select_open" href="#!">
                           Сортировать по:
                        </a>
                        <div class="select_noshow collapsed">
                            <ul>
                                <li> <a class="" href="?">
                                        Порядок: по умолчанию
                                    </a>
                                </li>
                                <li> <a class="" href="?orderby=created_at&direction=desc">
                                        Порядок: сперва новые
                                    </a>
                                </li>
                                <li><a class="" href="?orderby=created_at&direction=asc">
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
                        <button class="search_butn search_butn_prod"></button>

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
            <div class="overlay-black no-show-mobile">
                <div class='no-show-mobile sort_mobile'>
                    @include('site.sections.filters', [
                        'isshop' => false,
                        'filter_data' => $filter_data,
                    ])
                </div>
            </div>

            <div class="m_w-100 flex flex-column gap-5 self-start">

                <div class="catalog__cards">

                    @foreach ($products as $product)
                        <a href="/product/{{ $product->id }}" class="catalog__card">
                            <div class="card__content">
                                <img class="card__img" src="{{ $product->get_main_image_path('medium') }}"  alt="{{$product->title}}" />
                                <img class="card__link" src="/img/link.svg" alt="" />
                            </div>
                            <div class="card__desc">
                                <p class="card__title">{{ $product->title }}</p>
                                <p>{{ $product->category->title }}</p>
                            </div>
                        </a>
                    @endforeach

                </div>
                <div class="pagination">

                    {{ $products->links() }}

                </div>
            </div>
        </div>

    </section>
    @include('site.sections.ask')
@endsection
@section('footerScripts')
    @parent
    <script src="{{ asset('js/catalog.js') }}"></script>
@endsection
