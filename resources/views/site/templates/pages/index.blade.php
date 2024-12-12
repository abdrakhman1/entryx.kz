@extends('site.templates.main')
@section('head')
    @parent
    <link rel="stylesheet" href="{{ asset('css/map.css') }}">
    <script src="https://api-maps.yandex.ru/v3/?apikey=7e7f0f64-84e3-4156-aa2b-0a3dccc291e5&lang=ru_RU"></script>
    <script>
      // При успешной загрузке API доступен промис `ymaps3.ready`
      ymaps3.ready.then(() => {
         …
      });
    </script>
@endsection 

@section('content')
    <section class="hiro">
        <div class="container w-100 h-100 d-flex align-items-center justify-content-between">
            <div class="w-100">
                <h1 class="upper">Современные двери для вашего бизнеса</h1>
                <p>
                    ENTRYX - это компания, основанная группой предпринимателей,
                    заинтересованных в индустрии входных дверей.
                </p>
                <a href="/catalog" class="butn butn__hiro upper">В каталог</a>
            </div>
            <div class="hiro__social flex-column">
                <a href="#!" class="social__item">
                    <img src="./img/youtube.svg" alt="youtube" />
                </a>
                <a href="#!" class="social__item">
                    <img src="./img/telegram.svg" alt="telegram" />
                </a>
                <a href="#!" class="social__item">
                    <img src="./img/instagram.svg" alt="instagram" />
                </a>
            </div>
        </div>
    </section>
    <section class="category">
        <div class="container container__gap">
            <div class="sect__top">
                <div class="breadcrumb__container d-flex align-items-center">
                    <img src="./img/line.svg" alt="line" />
                    <p class="text-grad">Категории товаров</p>
                </div>
                <div class="sect__bottom">
                    <h2>Торговая марка</h2>
                    <a href="/catalog" class="butn upper no-show-mobile">Все товары</a>
                </div>
            </div>
            <div class="container__category d-grid">
                <a href="#!" class="category__item">
                    <figure>
                        <img class="category__card" src="./img/megi.png" alt="Megi Doors" />
                        <figcaption class="figcaption">
                            Megi Doors
                            <img src="./img/link-icon.svg" alt="link" />
                        </figcaption>
                    </figure>
                </a>
                <a href="#!" class="category__item">
                    <figure>
                        <img class="category__card" src="./img/retv.png" alt="Ретвизан" />
                        <figcaption class="figcaption">
                            Ретвизан
                            <img src="./img/link-icon.svg" alt="link" />
                        </figcaption>
                    </figure>
                </a>
                <a href="#!" class="category__item">
                    <figure>
                        <img class="category__card" src="./img/megi.png" alt=" STR" />
                        <figcaption class="figcaption">
                            STR
                            <img src="./img/link-icon.svg" alt="link" />
                        </figcaption>
                    </figure>
                </a>
            </div>
            <button class="butn upper show-mobile">Все товары</button>
        </div>
    </section>
    <section>

        @include('site.sections.company', ['isindex' => true])

    </section>
    <section>
        <div class="container">
            <div class="sect__top">
                <div class="breadcrumb__container flex align-items-center">
                    <img src="./img/line.svg" alt="line" />
                    <p class="text-grad">Дилерам</p>
                </div>
                <div class="sect__bottom">
                    <h2>Портал для дилеров</h2>
                    <p class="text">
                        Информация по использованию портала и личного кабинета для
                        дилеров
                    </p>
                </div>
            </div>

            @include('site.sections.for_dealers', ['isindex' => true ])

        </div>
    </section>
    <section>
        <section class="dealers  section-p">
            <div class="container">
                <div class="sect__top">
                    <div class="breadcrumb__container flex align-items-center">
                        <img src="./img/line.svg" alt="line" />
                        <p class="text-grad">Форма заявки</p>
                    </div>
                    <div class="sect__bottom">
                        <h2 class="white">Хотите стать дилером?</h2>
                        <p class="text white">
                            Оформите заявку и наши менеджеры Вам перезвонят!
                        </p>
                    </div>
                </div>
                <div class="dl-container">

                    @include('site.partials.feedback_form')

                    <div class="container-login">
                        <h4>У вас уже есть аккаунт?</h4>
                        <a href="/user/login" class="butn-white">Войти</a>
                        <img src="./img/decor.svg" alt="" />
                        <p>ДОСТУП ПО ПАРОЛЮ ДЛЯ ОРГАНИЗАЦИЙ, ИП и ЮР.ЛИЦ</p>
                    </div>
                </div>
            </div>
        </section>
    </section>
    <section class="social">
        <div class="bg-w">
            <div class="container sect__top sect__top--social ">
                <div class="breadcrumb__container d-flex align-items-center">
                    <img src="./img/line.svg" alt="line" />
                    <p class="text-grad">Cвязаться с нами</p>
                </div>
                <div class="sect__bottom">
                    <h2>Контакты</h2>
                </div>
            </div>
        </div>

        @include('site.sections.contacts_map')

        @include('site.sections.ask')

    </section>
@endsection
 