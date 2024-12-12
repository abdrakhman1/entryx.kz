@extends('site.templates.main')
@section('content')
@include('site.sections.company', ['isindex' => false])

    <section class="section-p bg-light-grey">
        <div class="container">
            <div class="sect__top p0">
                <div class="breadcrumb__container flex align-items-center">
                    <img src="/img/line.svg" alt="line" />
                    <p class="text-grad">О Продукции</p>
                </div>
                <div class="quality flex align-items-start">
                    <h2 class="m_w-100">Высокий уровень качества продукции</h2>
                    <div class="company__advant">
                        <div class="company__advant-card">
                            <p class="number number-sm">01</p>
                            <p>
                                Наша история началась недавно, но мы уже успели завоевать
                                доверие покупателей благодаря нашей специализации на
                                высококачественных входных дверях и быстрой, бесперебойной
                                доставке.
                            </p>
                        </div>
                        <div class="company__advant-card">
                            <p class="number">02</p>
                            <p>
                                Мы гордимся тем, что можем предложить нашим клиентам только
                                лучшие входные двери, изготовленные из высококачественных
                                материалов и соответствующие всем требованиям безопасности и
                                надежности.
                            </p>
                        </div>
                        <div class="company__advant-card">
                            <p class="number">03</p>
                            <p>
                                Мы работаем только с ведущими производителями и поставщиками
                                входных дверей, чтобы обеспечить нашим клиентам наилучший
                                выбор продукции и конкурентоспособные цены. Независимо от
                                того, нужна ли вам входная дверь для вашего дома,квартиры или
                                бизнеса, мы уверены, что у нас есть то, что вы ищете.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="container">
            <div class="cards__figure">
                <figure class="card__figure">
                    <img src="/img/company1.png" alt="company" />
                    <figcaption class=" figcaption__company--sm">
                        <p>Следим за новыми тенденциями в области дверей</p>
                    </figcaption>
                </figure>
                <figure class="card__figure">
                    <img src="/img/company2.png" alt="company" />
                    <figcaption class=" figcaption__company--sm">
                        <p>Имеем опытных экспертов в команде, которые могут помочь вам с выбором</p>
                    </figcaption>
                </figure>
                <figure class="card__figure">
                    <img src="/img/company3.png" alt="company" />
                    <figcaption class=" figcaption__company--sm">
                        <p>Занимаемся доставкой входных дверей высокого качества</p>
                    </figcaption>
                </figure>
                <figure class="card__figure">
                    <img src="/img/company4.png" alt="company" />
                    <figcaption class=" figcaption__company--sm">
                        <p>Стремимся предоставить нашим клиентам лучшее обслуживание</p>
                    </figcaption>
                </figure>
            </div>
        </div>
    </section>

    <div class="bg-light-grey">@include('site.sections.ask')</div>


    
@endsection
