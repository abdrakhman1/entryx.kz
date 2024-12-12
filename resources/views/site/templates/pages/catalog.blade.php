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
                        <li class="breadcrumb-item"><a href="/">Назад</a></li>
                        <li class="breadcrumb-item"><a href="/">Главная</a></li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Каталог товаров
                        </li>
                    </ol>
                </nav>
            </div>
            <div class="sect__bottom align-end">
                <h2>Каталог</h2>
                <div class="method">
                    <select name="sort" id="sort">
                        <option>Цена: по возрастанию</option>
                        <option>Цена: по убыванию</option>
                        <option selected="selected">Порядок: по умолчанию</option>
                        <option>Порядок: сперва новые</option>
                        <option>Порядок: сперва старые</option>
                    </select>
                    <div class="filters_butn show-mobile butn-greylight gap-4">
                        <img class="icon-search" src="./img/icon-filters.svg" alt=""> Фильтры
                        <div class="show-onclick no-display"> </div>
                    </div>
                    <div class="butn-greylight">
                        <input class="input-search" type="search" name="range-catalog" placeholder="Найти товар" />
                        <button class="search_butn"> </button>
                       
                        <div class="search_window container">
                            <ul>
                                <li><a href="/product">Retvizan 102.3</a></li>
                                <li><a href="/product">Retvizan 1.3</a></li>
                                <li><a href="/product">Retvizan 12.3</a></li>
                                <li><a href="/product">Retvizan 2.3</a></li>
                                <li><a href="/product">Retvizan 13</a></li>
                                <li><a href="/product">Retvizan 1.3</a></li>
                            </ul>
                            <button class="search_push"></button> <button class="butn_close-search "></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="catalog__sect">
            <div class="overlay-black no-show-mobile">
                <div class='no-show-mobile sort_mobile'>@include('site.sections.filters', ['isshop' => false]) </div>
            </div>

            <div class="m_w-100 flex flex-column gap-5 self-start">

                <div class="catalog__cards">
                    <a href="/product" class="catalog__card">
                        <div class="card__content">
                            <img class="card__img" src="./img/door.png" alt="door" />
                            <img class="card__link" src="./img/link.svg" alt="" />
                        </div>
                        <div class="card__desc">
                            <p class="card__title">STR MX-45</p>
                            <p>Входная дверь</p>
                        </div>
                    </a>
                    <a href="/product" class="catalog__card">
                        <div class="card__content">
                            <img class="card__img" src="./img/door.png" alt="door" />
                            <img class="card__link" src="./img/link.svg" alt="" />
                        </div>
                        <div class="card__desc">
                            <p class="card__title">STR MX-45</p>
                            <p>Входная дверь</p>
                        </div>
                    </a>
                    <a href="/product" class="catalog__card">
                        <div class="card__content">
                            <img class="card__img" src="./img/door.png" alt="door" />
                            <img class="card__link" src="./img/link.svg" alt="" />
                        </div>
                        <div class="card__desc">
                            <p class="card__title">STR MX-45</p>
                            <p>Входная дверь</p>
                        </div>
                    </a>
                    <a href="/product" class="catalog__card">
                        <div class="card__content">
                            <img class="card__img" src="./img/door.png" alt="door" />
                            <img class="card__link" src="./img/link.svg" alt="" />
                        </div>
                        <div class="card__desc">
                            <p class="card__title">STR MX-45</p>
                            <p>Входная дверь</p>
                        </div>
                    </a>
                    <a href="/product" class="catalog__card">
                        <div class="card__content">
                            <img class="card__img" src="./img/door.png" alt="door" />
                            <img class="card__link" src="./img/link.svg" alt="" />
                        </div>
                        <div class="card__desc">
                            <p class="card__title">STR MX-45</p>
                            <p>Входная дверь</p>
                        </div>
                    </a>
                    <a href="/product" class="catalog__card">
                        <div class="card__content">
                            <img class="card__img" src="./img/door.png" alt="door" />
                            <img class="card__link" src="./img/link.svg" alt="" />
                        </div>
                        <div class="card__desc">
                            <p class="card__title">STR MX-45</p>
                            <p>Входная дверь</p>
                        </div>
                    </a>
                    <a href="/product" class="catalog__card">
                        <div class="card__content">
                            <img class="card__img" src="./img/door.png" alt="door" />
                            <img class="card__link" src="./img/link.svg" alt="" />
                        </div>
                        <div class="card__desc">
                            <p class="card__title">STR MX-45</p>
                            <p>Входная дверь</p>
                        </div>
                    </a>
                    <a href="/product" class="catalog__card">
                        <div class="card__content">
                            <img class="card__img" src="./img/door.png" alt="door" />
                            <img class="card__link" src="./img/link.svg" alt="" />
                        </div>
                        <div class="card__desc">
                            <p class="card__title">STR MX-45</p>
                            <p>Входная дверь</p>
                        </div>
                    </a>
                    <a href="#!" class="catalog__card">
                        <div class="card__content">
                            <img class="card__img" src="./img/door.png" alt="door" />
                            <img class="card__link" src="./img/link.svg" alt="" />
                        </div>
                        <div class="card__desc">
                            <p class="card__title">STR MX-45</p>
                            <p>Входная дверь</p>
                        </div>
                    </a>
                </div>
                <div class="pagination">

                    <div id="light-pagination" class="pagination"></div>

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
