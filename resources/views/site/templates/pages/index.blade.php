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
    <section class="hiro">
        <div class="container w-100 h-100 d-flex align-items-center justify-content-between">
            <div class="w-100">
                {{-- <h1 class="upper">Современные двери для вашего бизнеса</h1> --}}
                <h1 class="upper">Первое впечатление, которое не забудется </h1>
                {{-- <p>
                    ENTRYX - это компания, основанная группой предпринимателей,
                    заинтересованных в индустрии входных дверей.
                </p> --}}
                <p>
                    Ваш выбор - EntryX, официальный представитель крупнейших заводов! Ведущий поставщик входных дверей. Доверьтесь нам и создайте безопасное и приветливое пространство.
                </p>
                <a href="/catalog" class="butn butn__hiro upper">В каталог</a>
            </div>
            <div class="hiro__social flex-column">
                <a href="https://www.youtube.com/@entryx" class="social__item">
                    <img src="/img/youtube.svg" alt="youtube" />
                </a>
                <a href="https://t.me/EntryX" class="social__item">
                    <img src="/img/telegram.svg" alt="telegram" />
                </a>
                <a href="https://www.instagram.com/entryx_kz" class="social__item">
                    <img src="/img/instagram.svg" alt="instagram" />
                </a>
            </div>
        </div>
    </section>


    <section class="projects">
        <div class="container">
            <div class="sect__top">
                <div class="breadcrumb__container d-flex align-items-center">
                    <img src="/img/line.svg" alt="line" />
                    <p class="text-grad">Наши проекты</p>
                </div>
                <div class="sect__bottom">
                    <h2>Реализованные проекты</h2>
                </div>
            </div>

            <div class="container__projects">
                <div class="f-carousel" id="myCarouselProjects">
                    <div class="f-carousel__viewport">
                        <!-- Первый слайд -->
                        <div class="project__card-wrapper f-carousel__slide">
                            <a href="/projects/project1" class="project__item">
                                <figure>
                                    <img class="project__card" src="https://static.tildacdn.pro/tild3463-6137-4465-a437-373761356362/1.jpeg" alt="Project 1" />
                                </figure>
                                <h3>ЖК «RENESANS»</h3>
                                <div class="project__description">
                                    <p>В ЖК «Renesans» представлена модель двери с&nbsp;фальш-фрамугой. Двери изготовлены по&nbsp;индивидуальному дизайнерскому проекту. Дверь выделяется своей строгостью и&nbsp;лаконичностью.</p>
                                </div>
                            </a>
                        </div>

                        <!-- Второй слайд -->
                        <div class="project__card-wrapper f-carousel__slide">
                            <a href="/projects/project2" class="project__item">
                                <h3>ЖК «TURAN PALACE»</h3>
                                <figure>
                                    <img class="project__card" src="https://static.tildacdn.pro/tild3936-3135-4338-b239-336338386131/noroot.jpg" alt="Project 2" />
                                </figure>
                                <div class="project__description">
                                    <p class="turan">В&nbsp;ЖК «Turan Palace» представлена модель двери с&nbsp;фальш-фрамугой. Двери изготовлены по&nbsp;индивидуальному дизайнерскому проекту. Главным акцентом становятся древесные мотивы, придающие спокойствие и&nbsp;тепло, а&nbsp;строгий дизайн разбавлен небольшими декоративными элементами.</p>
                                </div>
                            </a>
                        </div>

                        <!-- Третий слайд -->
                        <div class="project__card-wrapper f-carousel__slide">
                            <a href="/projects/project3" class="project__item">
                                <h3>ЖК «RESPUBLIKA»</h3>
                                <figure>
                                    <img class="project__card" src="https://static.tildacdn.pro/tild3132-3237-4139-a539-646136393134/resbublika.jpg" alt="Project 3" />
                                </figure>
                                <div class="project__description">
                                    <p>В ЖК «RESPUBLIKA» представлена модель двери с&nbsp;фальш-фрамугой. Двери изготовлены по&nbsp;индивидуальному дизайнерскому проекту. Всего в&nbsp;ЖК «RESPUBLIKA» было установлено 2795 дверей.</p>
                                </div>
                            </a>
                        </div>
                        <div class="project__card-wrapper f-carousel__slide">
                            <a href="/projects/project3" class="project__item">
                                <h3>ЖК «GRAND VICTORIA»</h3>
                                <figure>
                                    <img class="project__card" src="https://static.tildacdn.pro/tild6332-3439-4239-b734-316137323639/grand_viktoria.jpg" alt="Project 3" />
                                </figure>
                                <div class="project__description">
                                    <p>В ЖК «Grand Victoria» представлены двери, изготовленные по&nbsp;индивидуальному дизайнерскому проекту. Сочетание минимализма и&nbsp;классики позволяет сделать гармоничным и&nbsp;стильным практически любой интерьер. При этом такие двери никогда не&nbsp;смотрятся скучно, а&nbsp;передают помещению определенное настроение и&nbsp;по-своему виду являются достаточно современными.</p>
                                </div>
                            </a>
                        </div>
                        <div class="project__card-wrapper f-carousel__slide">
                            <a href="/projects/project3" class="project__item">
                                <h3>ЖК «GREENLINE FLORA»</h3>
                                <figure>
                                    <img class="project__card" src="https://static.tildacdn.pro/tild6332-3439-4239-b734-316137323639/grand_viktoria.jpg" alt="Project 3" />
                                </figure>
                                <div class="project__description">
                                    <p>В ЖК «GreenLine.Flora» - 
                                        жилой комплекс в бигвилле GreenLine.
                                    Здесь особая атмосфера единства с природой,
                                где ландшафтный дизайн гармонично сочетается с активностями во дворе, дизайном
                            фасадов и повседневными делами</p>
                                </div>
                            </a>
                        </div>
                        <div class="project__card-wrapper f-carousel__slide">
                            <a href="/projects/project3" class="project__item">
                                <h3>ЖК «GREENLINE AQUA»</h3>
                                <figure>
                                    <img class="project__card" src="https://static.tildacdn.pro/tild3463-6137-4465-a437-373761356362/1.jpeg" alt="Project 3" />
                                </figure>
                                <div class="project__description">
                                    <p>Жилой Квартал GreenLine.Aqua находится в самом центре
                                        города, расположенный на пересечении улиц EK-32 и EK-15/2,
                                        является частью  идейно-тематического ансамбля GreenLine, обширного
                                        концептуального бигвилля с удивительным и комфортабельным мироустройством
                                        и широким выбором развлечений. 
                                    </p>
                                </div>
                            </a>
                        </div>
                        <div class="project__card-wrapper f-carousel__slide">
                            <a href="/projects/project3" class="project__item">
                                <h3>ЖК «RIVIERA DE LUXE»</h3>
                                <figure>
                                    <img class="project__card" src="https://static.tildacdn.pro/tild3463-6137-4465-a437-373761356362/1.jpeg" alt="Project 3" />
                                </figure>
                                <div class="project__description">
                                    <p>
                                        В ЖК "Riviera De Luxe" представлены двери,
                                        изготовленные под заказ по уникальному дизайнерскому проекту.
                                        Элегантное сочетание стиля минимализма и классики 
                                        делает их идеальным выбором для тех, кто ценит стиль
                                        и функциональность в интерьере своего дома.
                                        <br><br>
                                        Всего в ЖК "Riviera De Luxe"<br>
                                        было установлено 212 дверей
                                    </p>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="category">
        <div class="container">
            <div class="sect__top">
                <div class="breadcrumb__container d-flex align-items-center">
                    <img src="/img/line.svg" alt="line" />
                    <p class="text-grad">Категории товаров</p>
                </div>
                <div class="sect__bottom">
                    <h2>Торговая марка</h2>
                    <a href="/catalog" class="butn upper no-show-mobile">Все товары</a>
                </div>
            </div>

            <div class="container__category f-carousel" id="myCarouselBrand">
                <a href="{{ route('site.catalog.brand', 'megi') }}" class="category__item f-carousel__slide">
                    <figure>
                        <img class="category__card" src="/img/fansy-index1.webp" alt="Megi Doors" />
                        <figcaption class="figcaption">
                            Megi Doors
                            <img src="/img/link-icon.svg" alt="link" />
                        </figcaption>
                    </figure>
                </a>
                <a href="{{ route('site.catalog.brand', 'ретвизан') }}" class="category__item f-carousel__slide">
                    <figure>
                        <img class="category__card" src="/img/fansy-index2.webp" alt="Ретвизан" />
                        <figcaption class="figcaption">
                            Ретвизан
                            <img src="/img/link-icon.svg" alt="link" />
                        </figcaption>
                    </figure>
                </a>
                <a href="{{ route('site.catalog.brand', 'STR') }}" class="category__item f-carousel__slide">
                    <figure>
                        <img class="category__card" src="/img/fansy-index3.webp" alt=" STR" />
                        <figcaption class="figcaption">
                            STR
                            <img src="/img/link-icon.svg" alt="link" />
                        </figcaption>
                    </figure>
                </a>
                <a href="{{ route('site.catalog.brand', 'phillips') }}" class="category__item f-carousel__slide">
                    <figure>
                        <img class="category__card" src="/img/fansy-index4.webp" alt=" Philips" />
                        <figcaption class="figcaption">
                            Phillips
                            <img src="/img/link-icon.svg" alt="link" />
                        </figcaption>
                    </figure>
                </a>
                <a href="{{ route('site.catalog.brand', 'ela') }}" class="category__item f-carousel__slide">
                    <figure>
                        <img class="category__card" src="/img/fansy-index5.webp" alt="ela" />
                        <figcaption class="figcaption">
                            ELA
                            <img src="/img/link-icon.svg" alt="link" />
                        </figcaption>
                    </figure>
                </a>
                <a href="{{ route('site.catalog.brand', 'tenon') }}" class="category__item f-carousel__slide">
                    <figure>
                        <img class="category__card" src="/img/fansy-index6.png" alt="ela" />
                        <figcaption class="figcaption">
                            Tenon
                            <img src="/img/link-icon.svg" alt="link" />
                        </figcaption>
                    </figure>
                </a>
            </div>
            <a href="/catalog" class="butn fansy_btn show-mobile">Все товары</a>
        </div>
    </section>
    

    
    <section>

        @include('site.sections.company', ['isindex' => true])

    </section>
    <!-- <section>
        <div class="container">
            <div class="sect__top">
                <div class="breadcrumb__container flex align-items-center">
                    <img src="/img/line.svg" alt="line" />
                    <p class="text-grad">Партнерам</p>
                </div>
                <div class="sect__bottom">
                    <h2>Портал для партнеров</h2>
                    <p class="text">
                        Информация по использованию портала и личного кабинета для
                        партнеров
                    </p>
                </div>
            </div>

            @include('site.sections.for_dealers', ['isindex' => true ])

        </div>
    </section> -->
    <section>
        <section class="dealers section-p">
            <div class="container flex items-center">
                <div class="sect__top">
                    <div class="breadcrumb__container flex align-items-center">
                        <img src="/img/line.svg" alt="line" />
                        <p class="text-grad">Форма заявки</p>
                    </div>
                    <div class="sect">
                        <h2 class="white">Хотите стать партнером?</h2><br>
                        <p class="white">
                            Оформите заявку и наши менеджеры Вам перезвонят!
                        </p>
                    </div>
                </div>
                <div class="dl-container">

                    @include('site.partials.feedback_form')

                    <!-- <div class="container-login">
                        <h4>У вас уже есть аккаунт?</h4>
                        <a href="/user/login" class="butn-white">Войти</a>
                        <img src="/img/decor.svg" alt="" />
                        <p>ДОСТУП ПО ПАРОЛЮ ДЛЯ ОРГАНИЗАЦИЙ, ИП и ЮР.ЛИЦ</p>
                    </div> -->
                </div>
            </div>
        </section>
    </section>
    <section class="social">
        <div class="bg-w">
            <div class="container sect__top sect__top--social ">
                <div class="breadcrumb__container d-flex align-items-center">
                    <img src="/img/line.svg" alt="line" />
                    <p class="text-grad">Cвязаться с нами</p>
                </div>
                <div class="sect__bottom">
                    <h2>Контакты</h2>
                </div>
            </div>
        </div>

        @include('site.sections.contacts_map', ['iscatalog' => true ])

        @include('site.sections.ask')

    </section>
@endsection
@section('footerScripts')
@parent
<script src="{{ asset('js/index.js') }}"></script>

@endsection