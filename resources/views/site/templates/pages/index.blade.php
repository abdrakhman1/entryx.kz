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
                <h1 class="upper"><span class="brand-color">ENTRYX</span> - Соединяя пространства</h1>
                <p>
                ООО «EntryX» - это ведущий поставщик
                качественных входных дверей на рынках
                Узбекистана и Казахстана,
                специализирующийся на предложении
                широкого ассортимента продукции для
                создания безопасных и стильных
                интерьеров. <br><br>
                Компания является официальным
                представителем крупнейших
                производителей дверей и предоставляет
                своим клиентам более 100 моделей дверей,
                включая решения с умными замками и
                электронными системами безопасности. В
                Узбекистане нашими партнерами являются
                крупнейшие застройщики: BI Group и NRG.
                </p>
                <a href="/catalog" class="butn butn__hiro upper">В каталог</a>
            </div>
            <div class="hiro__social flex-column">
                @foreach([
                    ['youtube', 'https://www.youtube.com/@entryx'],
                    ['telegram', 'https://t.me/EntryX'],
                    ['instagram', 'https://www.instagram.com/entryx_kz']
                ] as [$icon, $url])
                <a href="{{ $url }}" class="social__item" target="_blank" rel="noopener">
                    <img src="/img/{{ $icon }}.svg" alt="{{ $icon }}" loading="lazy" />
                </a>
                @endforeach
                <div class="row w-100 justify-content-between advantages">
            </div>
        </div>
    </section>
    <section class="company">
            <div class="row w-100 justify-content-between advantages">
            <div class="col">
                <p class="number">5+</p>
                <p>лет на рынке входных дверей</p>
            </div>
            <div class="col">
                <p class="number">20 000+</p>
                <p>установлено дверей</p>
            </div>
            <div class="col">
                <p class="number">10 000+</p>
                <p>установлено электронных замков</p>
            </div>
            <div class="col">
                <p class="number">100+</p>
                <p>моделей дверей и электронных замков</p>
            </div>
        </div>
    </section>
    <section class="category">
        <div class="container">
            <div class="sect__top">
                <div class="breadcrumb__container d-flex align-items-center">
                    <img src="/img/line.svg" alt="line" />
                    <p class="text-grad">Категории дверей</p>
                </div>
                <div class="sect__bottom">
                    <h2>Двери</h2>
                    <a href="/catalog/1" class="butn upper no-show-mobile">Все двери</a>
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
                
            <a href="/catalog/1" class="butn fansy_btn show-mobile">Все двери</a>
        </div>
    </section>
    
    <section class="category">
    <div class="container">
        <div class="sect__top">
            <div class="breadcrumb__container d-flex align-items-center">
                <img src="/img/line.svg" alt="line" />
                <p class="text-grad">Категории умных электронных замков</p>
            </div>
            <div class="sect__bottom">
                <h2>Электронные биометрические замки</h2>
                <a href="/catalog/2" class="butn upper no-show-mobile">Все замки</a>
            </div>
            <p class="h1-desc">Наши электронные замки - это инновационные устройства, которые обеспечивают удобство использования и контроль доступа в реальном времени.</p>
        </div>

        <div class="catalog__grid">
            @foreach($locks as $lock)
                <div class="catalog__item">
                    <a href="{{ route('site.product_show', $lock->id) }}">
                        <div class="image-container">
                            <img src="{{ $lock->image }}" alt="{{ $lock->title }}" />
                        </div>
                        <div class="item-info">
                            <h3>{{ $lock->title }}</h3>
                            @if($lock->price)
                                <p class="price">{{ number_format($lock->price, 0, ',', ' ') }} ₸</p>
                            @endif
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
        <a href="/catalog/2" class="butn fansy_btn show-mobile">Все замки</a>
    </div>
</section>

    <!-- <div class="locks-description">
                <p>Электронные биометрические замки пришли на
                замену традиционным врезным, навесным и кодовым
                замкам.</p>
                <p>Они представляют собой подобные устройства замки,
                в которых вместо ключа для открытия используется
                метод идентификации по отпечаткам пальцев.</p> 
                <p>Сегодня такие замки смело можно назвать наиболее
                практичными, надежными и обеспечивающими
                высокий уровень защиты.</p> 
                <p>Наши электронные замки - это не только надежное
                средство защиты вашего дома, офиса или
                коммерческого объекта, но и инновационные
                устройства, которые обеспечивают удобство
                использования и контроль доступа в реальном
                времени. Мы предлагаем широкий выбор моделей
                электронных замков, от простых автономных
                устройств до современных смарт-замков с
                возможностью управления через мобильное
                приложение.</p>
                </div> -->


    <section class="projects">
        <div class="container">
            <div class="sect__top">
                <div class="breadcrumb__container d-flex align-items-center">
                    <img src="/img/line.svg" alt="line" />
                    <p class="text-grad">Предложения для строительных компаний</p>
                </div>
                <div class="sect__bottom">
                    <h2>Реализованные проекты</h2>
                    <a href="/projects" class="butn upper no-show-mobile">Все проекты</a>
                </div>
            </div>

            <div class="container__projects">
                <div class="f-carousel" id="myCarouselProjects">
                    <div class="f-carousel__viewport">
                        @php
                            $projects = [
                                [
                                    'slug' => 'renesans',
                                    'name' => 'ЖК «RENESANS»',
                                    'h2' => 'ELIT STROY GROUP, АСТАНА',
                                    'image' => 'https://static.tildacdn.pro/tild3463-6137-4465-a437-373761356362/1.jpeg',
                                    'description' => 'В ЖК «Renesans» представлена модель двери 
                                    с&nbsp;фальш-фрамугой. Двери изготовлены по&nbsp;индивидуальному 
                                    дизайнерскому проекту. Дверь выделяется своей строгостью и&nbsp;лаконичностью.'
                                ],
                                [
                                    'slug' => 'turan-palace',
                                    'name' => 'ЖК «TURAN PALACE»',
                                    'h2' => 'SAFI-K-GROUP, АСТАНА',
                                    'image' => 'https://static.tildacdn.pro/tild3936-3135-4338-b239-336338386131/noroot.jpg',
                                    'description' => 'В&nbsp;ЖК «Turan Palace» представлена модель двери 
                                    с&nbsp;фальш-фрамугой. Двери изготовлены по&nbsp;индивидуальному 
                                    дизайнерскому проекту. Главным акцентом становятся древесные мотивы, 
                                    придающие спокойствие и&nbsp;тепло, а&nbsp;строгий дизайн разбавлен 
                                    небольшими декоративными элементами.'
                                ],
                                [
                                    'slug' => 'respublika',
                                    'name' => 'ЖК «RESPUBLIKA»',
                                    'h2' => 'SAT-NS, АСТАНА',
                                    'image' => 'https://static.tildacdn.pro/tild3132-3237-4139-a539-646136393134/resbublika.jpg',
                                    'description' => 'В ЖК «RESPUBLIKA» представлена модель двери 
                                    с&nbsp;фальш-фрамугой. Двери изготовлены по&nbsp;индивидуальному 
                                    дизайнерскому проекту. Всего в&nbsp;ЖК «RESPUBLIKA» было установлено 2795 дверей.'
                                ],
                                [
                                    'slug' => 'grand-victoria',
                                    'name' => 'ЖК «GRAND VICTORIA»',
                                    'h2' => 'Шар-Құрылыс, АСТАНА',
                                    'image' => 'https://static.tildacdn.pro/tild6332-3439-4239-b734-316137323639/grand_viktoria.jpg',
                                    'description' => 'В ЖК «Grand Victoria» представлены двери, изготовленные 
                                    по&nbsp;индивидуальному дизайнерскому проекту. Сочетание минимализма 
                                    и&nbsp;классики позволяет сделать гармоничным и&nbsp;стильным 
                                    практически любой интерьер. При этом такие двери никогда не&nbsp;смотрятся скучно, 
                                    а&nbsp;передают помещению определенное настроение и&nbsp;по-своему виду являются достаточно современными.'
                                ],
                                [
                                    'slug' => 'greenline-flora',
                                    'name' => 'ЖК «GREENLINE FLORA»',
                                    'h2' => 'BI GROUP, АСТАНА',
                                    'image' => '/img/greenlineflora.webp',
                                    'description' => 'ЖК «GreenLine.Flora» - жилой комплекс в бигвилле GreenLine. 
                                    Здесь особая атмосфера единства с природой, где ландшафтный дизайн гармонично 
                                    сочетается с активностями во дворе, дизайном фасадов и повседневными делами.'
                                ],
                                [
                                    'slug' => 'greenline-aqua',
                                    'name' => 'ЖК «GREENLINE AQUA»',
                                    'h2' => '',
                                    'image' => '/img/greenlineaqua.webp',
                                    'description' => 'Жилой Квартал GreenLine.Aqua находится в самом центре 
                                    города, расположенный на пересечении улиц EK-32 и EK-15/2, является частью 
                                    идейно-тематического ансамбля GreenLine, обширного концептуального бигвилля 
                                    с удивительным и комфортабельным мироустройством и широким выбором развлечений.'
                                ],
                                [
                                    'slug' => 'riviera-de-luxe',
                                    'name' => 'ЖК «RIVIERA DE LUXE»',
                                    'h2' => 'ЖЕЗГАЗГАН',
                                    'image' => '/img/riviera-de-luxe.jpg',
                                    'description' => 'В ЖК "Riviera De Luxe" представлены двери, 
                                    изготовленные под заказ по уникальному дизайнерскому проекту. 
                                    Элегантное сочетание стиля минимализма и классики делает их 
                                    идеальным выбором для тех, кто ценит стиль и функциональность 
                                    в интерьере своего дома.<br><br>Всего в ЖК "Riviera De Luxe" 
                                    было установлено 212 дверей'
                                ],
                                [
                                    'slug' => 'sardar-city',
                                    'name' => 'ЖК «SARDAR CITY»',
                                    'h2' => 'SARDAR CONSTRUCTION GROUP, АСТАНА',
                                    'image' => '/img/sardar-city.jpg',
                                    'description' => 'Двери в ЖК "Sardar city" отличаются не только
                                    индивидуальным дизайном, но и изысканным стилем,
                                    который сочетает в себе лаконичность и изысканность. Эти
                                    двери не только функциональны, но и добавляют
                                    изысканности и роскоши вашему интерьеру.<br><br>
                                    Всего в ЖК "Sardar city"
                                    было установлено 395 дверей и 395 электронных замков.'
                                ],
                                [
                                    'slug' => 'compas-sever',
                                    'name' => 'ЖК «КОМПАС СЕВЕР»',
                                    'h2' => 'FERRUM, АСТАНА',
                                    'image' => '/img/kompas-sever.jpg',
                                    'description' => 'В ЖК "Компас Север" представлены двери с фальш-
                                    фрамугой, которые отличаются изысканным дизайном и
                                    высоким качеством исполнения. Их минималистичный
                                    стиль и классические элементы добавляют интерьеру
                                    роскоши и элегантности, при этом подчеркивая его
                                    современность.<br><br>
                                    Всего в ЖК "Компас Север"
                                    было установлено 376 дверей'
                                ],
                                [
                                    'slug' => 'triumph-exclusive',
                                    'name' => 'ЖК «TRIUMPH EXCLUSIVE»',
                                    'h2' => 'NAK, АСТАНА',
                                    'image' => '/img/triumph-exclusive.jpg',
                                    'description' => 'Двери в ЖК "Triumph Exclusive" созданы с использованием
                                    фальшфрамуги, что придает им особую изысканность и
                                    шарм. Их стильный дизайн в сочетании с классическими
                                    элементами делает их идеальным выбором для создания
                                    уютного и элегантного интерьера.<br><br>
                                    Всего в ЖК "Triumph Exclusive"
                                    было установлено 60 дверей'
                                ],
                                [
                                    'slug' => 'auen',
                                    'name' => 'ЖК «AUEN»',
                                    'h2' => 'TEVIS GROUP, АСТАНА',
                                    'image' => '/img/auen.jpg',
                                    'description' => 'В ЖК «AUEN» представлены двери, выполненные с
                                        использованием фальш-фрамуги, которые придают им
                                        утонченный вид. Их минималистичный дизайн в
                                        сочетании с классическими элементами делает их
                                        идеальным решением для создания стильного интерьера
                                        любого помещения.<br><br>
                                        Всего в ЖК "AUEN"
                                        было установлено 550 дверей'
                                ],
                                [
                                    'slug' => 'atamura',
                                    'name' => 'ЖК «ATAMURA»',
                                    'h2' => 'JETISU, АСТАНА',
                                    'image' => '/img/atamura.jpg',
                                    'description' => 'В ЖК «АТAMURA» представлены двери с фальш-фрамугой,
                                    которые обладают изысканным и стильным дизайном. Их
                                    сочетание минимализма с классическими элементами
                                    делает их идеальным выбором для современных
                                    интерьеров, придавая помещению особый шарм и уют.<br><br>
                                    Всего в ЖК "ATAMURA"
                                    было установлено 600 дверей'
                                ],
                                [
                                    'slug' => 'onay',
                                    'name' => 'ЖК «ОНАЙ»',
                                    'h2' => 'BI GROUP, АСТАНА',
                                    'image' => '/img/onay.jpg',
                                    'description' => 'Двери в ЖК "Онай" созданы по индивидуальному
                                    дизайнерскому проекту, что делает каждую из них
                                    уникальной. Их современный и стильный внешний вид
                                    добавляет интерьеру элегантности и изыска, при этом
                                    сохраняя функциональность и практичность.<br><br>
                                    Всего в ЖК "Онай"
                                    было установлено 252 дверей'
                                ],
                                [
                                    'slug' => 'aksu',
                                    'name' => 'ЖК «АКСУ»',
                                    'h2' => 'BI GROUP, АСТАНА',
                                    'image' => '/img/aksu.jpg',
                                    'description' => 'Двери в ЖК "Аксу" созданы по индивидуальному дизайну,
                                    что делает каждую из них уникальной. Их стильное
                                    сочетание минимализма и классики придает интерьеру
                                    изысканность и шарм, делая помещение уютным и
                                    элегантным.<br><br>
                                    Всего в ЖК "Аксу"
                                    было установлено 365 дверей'
                                ],
                                [
                                    'slug' => 'baitas',
                                    'name' => 'ЖК «BAITAS»',
                                    'h2' => 'TUMAR GROUP, АСТАНА',
                                    'image' => '/img/baitas.jpg',
                                    'description' => 'В ЖК "BAITAS" представлены двери с фальш-фрамугой,
                                    которые обладают изысканным дизайном и высоким
                                    качеством исполнения. Их минималистичный стиль и
                                    стильные элементы придают интерьеру элегантность и
                                    шарм, делая его привлекательным и современным.<br><br>
                                    Всего в ЖК "BAITAS"
                                    было установлено 200 дверей и 200 электронных замков.'
                                ],
                                [
                                    'slug' => 'tengri',
                                    'name' => 'ЖК «TENGRI»',
                                    'h2' => 'TUMAR GROUP, АСТАНА',
                                    'image' => '/img/tengri.jpg',
                                    'description' => 'В ЖК "TENGRI" установлено самые современные и
                                    технологичные электронные замки нового поколения.<br><br>
                                    Всего в ЖК "TENGRI"
                                    было установлено 252 электронных замков.'
                                ],
                                [
                                    'slug' => 'eva',
                                    'name' => 'ЖК «EVA»',
                                    'h2' => 'ESTA GROUP, АСТАНА',
                                    'image' => '/img/eva.jpg',
                                    'description' => 'В ЖК "EVA" представлены двери, изготовленные по
                                        индивидуальному дизайнерскому проекту, что делает
                                        каждую из них уникальной. Их стильный дизайн и
                                        изысканные элементы придают интерьеру элегантность и
                                        шарм, делая его уютным и стильным.<br><br>
                                        Всего в ЖК "EVA"
                                        было установлено 180 дверей и 180 электронных замков.'
                                ],
                                [
                                    'slug' => 'delta',
                                    'name' => 'ЖК «DELTA»',
                                    'h2' => 'SAT-NS, АСТАНА',
                                    'image' => '/img/delta.jpg',
                                    'description' => 'Двери в ЖК "DELTA" представлены в индивидуальном
                                    дизайнерском исполнении, что придает каждой из них
                                    неповторимый характер. Их стильное сочетание
                                    минимализма и классических элементов придает интерьеру
                                    изысканность и утонченность, делая его привлекательным и
                                    стильным.<br><br>
                                    Всего в ЖК "DELTA"
                                    было установлено 3500 квартирных и технических дверей.'
                                ]
                            ];
                        @endphp

                        @foreach($projects as $project)
                            <div class="project__card-wrapper f-carousel__slide">
                                <a href="/projects/{{ $project['slug'] }}" class="project__item">
                                    <h3 class>{{ $project['name'] }}</h3>
                                    <h3 class="h3-h2">{{ $project['h2'] }}</h3>  
                                    
                                    <figure>
                                        <img class="project__card" src="{{ $project['image'] }}" alt="{{ $project['name'] }}" />
                                    </figure>
                                     
                                    
                                    <div class="project__description">
                                        <p>{!! $project['description'] !!}</p>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <a href="/projects" class="butn fansy_btn show-mobile">Все проекты</a>
        </div>
    </section>
    
    <section>
        <section class="dealers section-p">
            <div class="container">
                <div class="dealers-content">
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
                    </div>
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