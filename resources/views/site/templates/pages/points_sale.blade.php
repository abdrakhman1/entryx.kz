@extends('site.templates.main')

@section('head')
    @parent
    <link rel="stylesheet" href="{{ asset('css/map.css') }}">
    {{-- <script src="https://api-maps.yandex.ru/2.1/?apikey=7e7f0f64-84e3-4156-aa2b-0a3dccc291e5&lang=ru_RU" type="text/javascript"> --}}
    <script src="https://api-maps.yandex.ru/v3/?apikey=7e7f0f64-84e3-4156-aa2b-0a3dccc291e5&lang=ru_RU"></script>
    <script src="{{ asset('js/marker-map.js') }}"></script>
    <script src="{{ asset('js/points_sale.js') }}"></script>
@endsection

@section('content')
    <div>
        <div>
            <div class=" container sect__top p-top ">
                <div class="breadcrumb__container d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Назад</a></li>
                            <li class="breadcrumb-item"><a href="/">Главная</a></li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Точки продаж
                            </li>
                        </ol>
                    </nav>
                </div>
                <div class="sect__bottom align-end">
                    <h2>Точки продаж</h2>
                </div>
            </div>
        </div>
        <div class="points_container container">
            <div class="">
                <div class="points_butns">
                    <button class="butn_list butn_point">Списком</button>
                    <button class="butn_map butn_point">На карте</button>
                </div>
                <div class="search_points-sale">
                    <input type="search" name="search-points" placeholder="Найти компанию, город, адреc" />
                    <button class="search_butn"><img src="./img/search-points.svg" alt="" /></button>
                    {{-- <ul class="search_window">
                        <li> <p>Результат поиска</p> </li>
                        <li><a href="#!">Retvizan 102.3</a></li>
                        <li><a href="#!">Retvizan 102.3</a></li>
                        <li><a href="#!">Retvizan 102.3</a></li>
                        <li><a href="#!">Retvizan 102.3</a></li>
                        <li><a href="#!">Retvizan 102.3</a></li>
                        <li><a href="#!">Retvizan 102.3</a></li>
                    </ul> --}}
                </div>
                <div id="scroll" class="nano">
                    <div class="content">
                        <div class="points-item flex-col">
                            <h4 class="title-l">"ИП Двери"</h4>
                            <div class="flex-col gap-2">
                                <p class="title-sm-green">Адрес</p>
                                <a href="#!">Казахстан, г. Астана, ул. Шарбакты, 14/1 </a>
                            </div>
                            <div class="flex-col gap-2">
                                <p class="title-sm-green">Номер телефона</p>
                                <a href="#!">+7 (777) 777-77-77 </a>
                            </div>

                        </div>
                        <div class="points-item flex-col">
                            <h4 class="title-l">"ИП Двери"</h4>
                            <div class="flex-col gap-2">
                                <p class="title-sm-green">Адрес</p>
                                <a href="#!">Казахстан, г. Астана, ул. Шарбакты, 14/1 </a>
                            </div>
                            <div class="flex-col gap-2">
                                <p class="title-sm-green">Номер телефона</p>
                                <a href="#!">+7 (777) 777-77-77 </a>
                            </div>

                        </div>
                        <div class="points-item flex-col">
                            <h4 class="title-l">"ИП Двери"</h4>
                            <div class="flex-col gap-2">
                                <p class="title-sm-green">Адрес</p>
                                <a href="#!">Казахстан, г. Астана, ул. Шарбакты, 14/1 </a>
                            </div>
                            <div class="flex-col gap-2">
                                <p class="title-sm-green">Номер телефона</p>
                                <a href="#!">+7 (777) 777-77-77 </a>
                            </div>

                        </div>
                        <div class="points-item flex-col">
                            <h4 class="title-l">"ИП Двери"</h4>
                            <div class="flex-col gap-2">
                                <p class="title-sm-green">Адрес</p>
                                <a href="#!">Казахстан, г. Астана, ул. Шарбакты, 14/1 </a>
                            </div>
                            <div class="flex-col gap-2">
                                <p class="title-sm-green">Номер телефона</p>
                                <a href="#!">+7 (777) 777-77-77 </a>
                            </div>

                        </div>
                        <div class="points-item flex-col">
                            <h4 class="title-l">"ИП Двери"</h4>
                            <div class="flex-col gap-2">
                                <p class="title-sm-green">Адрес</p>
                                <a href="#!">Казахстан, г. Астана, ул. Шарбакты, 14/1 </a>
                            </div>
                            <div class="flex-col gap-2">
                                <p class="title-sm-green">Номер телефона</p>
                                <a href="#!">+7 (777) 777-77-77 </a>
                            </div>

                        </div>
                        <div class="points-item flex-col">
                            <h4 class="title-l">"ИП Двери"</h4>
                            <div class="flex-col gap-2">
                                <p class="title-sm-green">Адрес</p>
                                <a href="#!">Казахстан, г. Астана, ул. Шарбакты, 14/1 </a>
                            </div>
                            <div class="flex-col gap-2">
                                <p class="title-sm-green">Номер телефона</p>
                                <a href="#!">+7 (777) 777-77-77 </a>
                            </div>

                        </div>
                        <div class="points-item flex-col">
                            <h4 class="title-l">"ИП Двери"</h4>
                            <div class="flex-col gap-2">
                                <p class="title-sm-green">Адрес</p>
                                <a href="#!">Казахстан, г. Астана, ул. Шарбакты, 14/1 </a>
                            </div>
                            <div class="flex-col gap-2">
                                <p class="title-sm-green">Номер телефона</p>
                                <a href="#!">+7 (777) 777-77-77 </a>
                            </div>

                        </div>
                        <div class="points-item flex-col">
                            <h4 class="title-l">"ИП Двери"</h4>
                            <div class="flex-col gap-2">
                                <p class="title-sm-green">Адрес</p>
                                <a href="#!">Казахстан, г. Астана, ул. Шарбакты, 14/1 </a>
                            </div>
                            <div class="flex-col gap-2">
                                <p class="title-sm-green">Номер телефона</p>
                                <a href="#!">+7 (777) 777-77-77 </a>
                            </div>

                        </div>
                        <div class="points-item flex-col">
                            <h4 class="title-l">"ИП Двери"</h4>
                            <div class="flex-col gap-2">
                                <p class="title-sm-green">Адрес</p>
                                <a href="#!">Казахстан, г. Астана, ул. Шарбакты, 14/1 </a>
                            </div>
                            <div class="flex-col gap-2">
                                <p class="title-sm-green">Номер телефона</p>
                                <a href="#!">+7 (777) 777-77-77 </a>
                            </div>

                        </div>
                        <div class="points-item flex-col">
                            <h4 class="title-l">"ИП Двери"</h4>
                            <div class="flex-col gap-2">
                                <p class="title-sm-green">Адрес</p>
                                <a href="#!">Казахстан, г. Астана, ул. Шарбакты, 14/1 </a>
                            </div>
                            <div class="flex-col gap-2">
                                <p class="title-sm-green">Номер телефона</p>
                                <a href="#!">+7 (777) 777-77-77 </a>
                            </div>

                        </div>
                    </div>
                </div>



            </div>
            <div class="points_container_map">
                <div id="map"></div>
            </div>

        </div>
    </div>

@section('footerScripts')
    @parent

    <script src="{{ asset('js/points-sale.js') }}"></script>
@endsection

@include('site.sections.ask')
@endsection
