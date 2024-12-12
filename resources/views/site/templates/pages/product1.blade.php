@extends('site.templates.main')
@section ('head')
@parent
<script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>
<link
  rel="stylesheet"
  href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css"
/>
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
            <div class="container_slider">
                <div class="slider slider-for">
                    <div><img src="./img/pages06.png" alt=""></div>
                    <div><img src="./img/pages07.png" alt=""></div>
                    <div><img src="./img/pages06.png" alt=""></div>
                    <div><img src="./img/pages07.png" alt=""></div>
                    <div><img src="./img/pages06.png" alt=""></div>
                </div>
                <div class="relative">
                    <div class="slider slider-nav">
                        <div><img src="./img/pages06.png" alt=""></div>
                        <div><img src="./img/pages07.png" alt=""></div>
                        <div><img src="./img/pages06.png" alt=""></div>
                        <div><img src="./img/pages07.png" alt=""></div>
                        <div class="video"><a target="_blank" href="https://youtu.be/DujkHoIhWco"><img class="video_img"
                                    src="./img/pages06.png" alt="">
                                <div class="video_icon"><img src="../img/Play.svg" alt=""></div>
                            </a> </div>
                        <div><img src="./img/pages07.png" alt=""></div>
                        <div><img src="./img/pages07.png" alt=""></div>
                    </div>
                    <div class="arrows"></div>
                </div>

            </div>
            <div class="flex-col">
                <h4 class="title-mupper black">дверь STR MX-45</h4>
                <div class="flex-col gap-3">
                    <p>Размер</p>
                    <div class="container_size">
                        <a href="#!">860х2050 L</a>
                        <a href="#!">860х2050 R</a>
                        <a href="#!">960х2050 L</a>
                        <a href="#!">960х2050 R</a>
                    </div>
                </div>
                <a href="/points_sale" class="butn "><img src="./img/icon-points.svg">Точки продаж</a>
            </div>
        </div>
    </div>
    <div class="container">

        <h4 class="title-l">Общие характеристики:</h4>
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