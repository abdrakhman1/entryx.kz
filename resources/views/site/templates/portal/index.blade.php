@extends('site.templates.portal')
@section('head')
    @parent
    <link rel="stylesheet" href="{{ asset('css/portal/style.css') }}" />
@endsection

@section('content')
    <section>
        <div class="mobile_store">
            <div class="mobile_info">
                <h2 class="title_big">У нас есть <div class="text-grad">Мобильное приложение!</div>
                </h2>
                <p>Его можно скачать в Google Play или Apple Store.</p>
                <div class="stores">
                    <a href="#!" class="store">
                        <img src="/img/app-dark.svg" alt="Appstore" />
                    </a>
                    <a href="#!" class="store">
                        <img src="/img/google-dark.svg" alt="Google Play" />
                    </a>
                </div>
            </div>
            <div class="mobile_bg"></div>
        </div>
        <div class="container__category d-grid">
            <a href="{{ route('portal.catalog.brand', 'megi') }}" class="category__item">
                <figure>
                    <img class="category__card" src="/img/portal/door1.png" alt="Megi Doors" />
                    <figcaption class="figcaption">
                        Megi Doors
                        <img src="/img/icon/link-gray.svg" alt="link" />
                    </figcaption>
                </figure>
            </a>
            <a href="{{ route('portal.catalog.brand', 'ретвизан') }}" class="category__item">
                <figure>
                    <img class="category__card" src="/img/portal/door2.png" alt="Ретвизан" />
                    <figcaption class="figcaption">
                        Ретвизан
                        <img src="/img/icon/link-gray.svg" alt="link" />
                    </figcaption>
                </figure>
            </a>
            <a href="{{ route('portal.catalog.brand', 'STR') }}" class="category__item">
                <figure>
                    <img class="category__card" src="/img/portal/door3.png" alt=" STR" />
                    <figcaption class="figcaption">
                        STR
                        <img src="/img/icon/link-gray.svg" alt="link" />
                    </figcaption>
                </figure>
            </a>
        </div>
    </section>
    <section>
        <div class="section_top ">
            <div class="title_page">Новинки</div>
            <a href="{{route('portal.catalog.index')}}" class="butn butn-green no_show_mobile">Все товары</a>
        </div>
        <div class="products products_new">
            @foreach ($last_3_products as $product)
            <div class="product">
                <a href="{{ route('portal.catalog.product', $product) }}">
                    <div class="img_box">
                        <img class="prod_img" src="{{ $product->get_main_image_path() }}" alt="Megi Doors" />
                        <img class="icon_link" src="/img/icon/link-gray.svg" alt="link" />
                    </div>

                    <div class="prod_desc">
                        <p class="title_s">{{ $product->title }}</p>
                        <p>{{ $product->category->title }}</p>
                    </div>
                </a>
                <div class="price_box">
                    <div class="price title_s">{{ $product->price }} ₸</div>
                    <a class="butn" href="{{ route('portal.catalog.product.add_to_cart', $product->id) }}"></a>
                </div>
            </div>
        @endforeach
        </div>
        <a href="{{route('portal.catalog.index')}}" class="butn butn-green show_mobile">Все товары</a>
    </section>
    <section>
        <div class="section_top section_acc">
            <div class="title_page">Часто задаваемые вопросы</div>
            <div class="accordion" id="accordionPanelsStayOpenExample">
                <div class="accordion-item">
                    <div class="accordion-header" id="panelsStayOpen-headingOne">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                            data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true"
                            aria-controls="panelsStayOpen-collapseOne">
                            <span class="text-grad">01</span> Есть ли специальные условия для партнеров при заключении
                            партнерского соглашения?
                        </button>
                    </div>
                    <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show"
                        aria-labelledby="panelsStayOpen-headingOne">
                        <div class="accordion-body">
                            Да! Мы заинтересованы в развитии нашей партнерской сети! Мы всегда готовы идти на
                            встречу, готовы слушать ваши предложения и разработаем для вас индивидуальное
                            предложение. Помимо специального предложения при заключении соглашения, мы
                            постоянно внедряем различные акции, делая наше сотрудничество незабываемым.
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <div class="accordion-header" id="panelsStayOpen-headingTwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false"
                            aria-controls="panelsStayOpen-collapseTwo">
                            <span class="text-grad">02</span> Мы уже ваш партнер, где нам взять материалы о всех товарах?
                        </button>
                    </div>
                    <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse"
                        aria-labelledby="panelsStayOpen-headingTwo">
                        <div class="accordion-body">
                            Специально для этого случая мы выгрузили все доступные фото и видео материалы на
                            Google Диск. Так же можете использовать карточки товара на сайте и обзоры на YouTube
                            Канале.
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <div class="accordion-header" id="panelsStayOpen-headingThree">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#panelsStayOpen-collapseThree" aria-expanded="false"
                            aria-controls="panelsStayOpen-collapseThree">
                            <span class="text-grad">03</span>Какой гарантийный срок на ваши двери, и какие условия
                            гарантии?
                        </button>
                    </div>
                    <div id="panelsStayOpen-collapseThree" class="accordion-collapse collapse"
                        aria-labelledby="panelsStayOpen-headingThree">
                        <div class="accordion-body">
                            Каждый завод дает гарантию на заводской брак, но скажем честно, такие случаи очень
                            редки в нашей практике. Но, если это происходит, мы запросим у вас необходимые фото/
                            видео материалы для предоставления их на завод и примем правильное решение в Вашу
                            пользу. Мы готовы идти Вам на встречу. Всегда.
                            <div class="accordion-intro">
                                Если возникли дополнительные вопросы, напишите нам в тех. поддержку!
                                <div class="accordion-into-box "><a class="text-grad link_accordion"
                                        href="{{ route('portal.tickets.create') }}">Написать в тех.поддержку</a></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <div class="accordion-header" id="panelsStayOpen-headingFour">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#panelsStayOpen-collapseFour" aria-expanded="false"
                            aria-controls="panelsStayOpen-collapseFour">
                            <span class="text-grad">04</span>Есть ли обучающие программы или тренинги для наших сотрудников
                            по продажам вашей
                            продукции?
                        </button>
                    </div>
                    <div id="panelsStayOpen-collapseFour" class="accordion-collapse collapse"
                        aria-labelledby="panelsStayOpen-headingFour">
                        <div class="accordion-body">
                            Да, мы проводим мероприятия в онлайн и офлайн разных форматов и тематик не менее
                            двух раз в месяц.
                            Для получения полной информации, подпишитесь на все наши социальные сети. Мы всегда
                            заранее уведомляем наших партнеров.
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <div class="accordion-header" id="panelsStayOpen-headingFive">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#panelsStayOpen-collapseFive" aria-expanded="false"
                            aria-controls="panelsStayOpen-collapseFive">
                            <span class="text-grad">05</span>Какие сроки и условия доставки дверей и электронных замков?
                        </button>
                    </div>
                    <div id="panelsStayOpen-collapseFive" class="accordion-collapse collapse"
                        aria-labelledby="panelsStayOpen-headingFive">
                        <div class="accordion-body">
                            К сожалению, на данный момент мы не имеем собственной доставки со склада.
                            Единственный возможный вариант САМОВЫВОЗ. Наш крупный склад находится в
                            удобнейшем месте в г Астана.
                            Адрес Щербакты 14/1 (Район вокзала Нурлы Жол) удобна для водителей доставляющих
                            товары как на межгород, так и по городу.
                            Мы имеем эксклюзивную систему умного склада, благодаря которой водителю для забора
                            товара требуется минимальное время.

                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <div class="accordion-header" id="panelsStayOpen-headingSix">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#panelsStayOpen-collapseSix" aria-expanded="false"
                            aria-controls="panelsStayOpen-collapseSix">
                            <span class="text-grad">06</span>Что делать, если возникла проблема с заказом или товаром?
                        </button>
                    </div>
                    <div id="panelsStayOpen-collapseSix" class="accordion-collapse collapse"
                        aria-labelledby="panelsStayOpen-headingSix">
                        <div class="accordion-body">
                            Нужно понять какого вида проблема возникла с Вашим заказом. Вам нужно связаться с
                            Вашим менеджером и уверяем, мы сделаем все возможное для устранения проблемы.
                            <div class="accordion-intro">
                                Напишите нам в тех. поддержку!
                                <div class="accordion-into-box "><a class="text-grad link_accordion"
                                        href="{{ route('portal.tickets.create') }}">Написать в тех.поддержку</a></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <div class="accordion-header" id="panelsStayOpen-headingSeven">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#panelsStayOpen-collapseSeven" aria-expanded="false"
                            aria-controls="panelsStayOpen-collapseSeven">
                            <span class="text-grad">07</span> Мы хотели бы оформить большой заказ. Есть ли дополнительные
                            скидки при объемных
                            закупках?
                        </button>
                    </div>
                    <div id="panelsStayOpen-collapseSeven" class="accordion-collapse collapse"
                        aria-labelledby="panelsStayOpen-headingSeven">
                        <div class="accordion-body">
                            Обязательно. Мы всегда идем на встречу нашим партнерам и готовы делать бизнес с нами
                            максимально выгодным для Вас!
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <div class="accordion-header" id="panelsStayOpen-headingEight">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#panelsStayOpen-collapseEight" aria-expanded="false"
                            aria-controls="panelsStayOpen-collapseEight">
                            <span class="text-grad">08</span> Мы интересуемся вашими электронными замками. Можете ли вы рассказать подробнее
                            о их функционале и установке?
                            закупках?
                        </button>
                    </div>
                    <div id="panelsStayOpen-collapseEight" class="accordion-collapse collapse"
                        aria-labelledby="panelsStayOpen-headingEight">
                        <div class="accordion-body">
                            Да. Вся информация о электронных замках, о том как их устанавливать, ответы на
                            интересующие Вас вопросы Вы можете найти на нашем YouTube канале и официальном
                            сайте.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section>
        <div class="section_top">
            <div class="title_page">Контактные данные</div>
        </div>
        <div class="bg-light-grey">
            @include('site.sections.contacts_map', ['iscatalog' => false])
        </div>

    </section>
@endsection
