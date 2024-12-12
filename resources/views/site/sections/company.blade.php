@php
    $ismain = isset($isindex) ? $isindex : false;
@endphp

@if ($ismain)
    <section class="company bg-light-grey">
    @else
        <section class="company no-bg">
@endif

@if ($ismain)
<div class="container flex flex-column w-100 section-p">
    @else
    <div class="container flex flex-column w-100 p-top">
@endif
 
    <div class="sect__top">

        <div class='breadcrumb__container flex align-items-center'>
            @if ($ismain)
                <img src="./img/line.svg" alt="line" />
                <p class="text-grad">О Компании</p>
            @else
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/">Назад</a></li>
                        <li class="breadcrumb-item"><a href="/">Главная</a></li>
                        <li class="breadcrumb-item active" aria-current="page">
                            О Компании
                        </li>
                    </ol>
                </nav>
            @endif
        </div>

        <div class="sect__bottom">
            @if ($ismain)
                <h2>
                    ENTRYX - это компания, основанная группой предпринимателей
                </h2>
                <p class="text">
                    Мы заинтересованны в индустрии входных дверей. Наша компания
                    занимается доставкой входных дверей высокого качества для
                    домов и бизнеса. Более подробную информацию вы можете
                    <a href="/about"> посмотреть тут</a>
                </p>
            @else
                <h2 class="m_w-100"> ENTRYX - это компания, основанная группой предпринимателей</h2>
            @endif

        </div>
    </div>
    <div>
        <figure>
            <img class="company__img" src="./img/company.webp" alt="company" />
            <figcaption class="figcaption__company">
                <img src="./img/entryx.svg" alt="entryx" />
            </figcaption>
        </figure>
    </div>
    <div class="row w-100 justify-content-between advantages">
        <div class="col">
            <p class="number">100</p>
            <p>разных дверей в ассортименте</p>
        </div>
        <div class="col">
            <p class="number">5+</p>
            <p>лет на рынке входных дверей</p>
        </div>
        <div class="col">
            <p class="number">150</p>
            <p>клиентов предпринимателе</p>
        </div>
        <div class="col">
            <p class="number">1000+</p>
            <p>дилеров закупаются на нашем сайте</p>
        </div>
    </div>
</div>
</section>
