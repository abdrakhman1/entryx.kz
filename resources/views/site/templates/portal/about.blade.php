@extends('site.templates.portal')
@section('head')
    @parent
    <link rel="stylesheet" href="{{ asset('css/portal/profile.css') }}">
     
@endsection


@section('content')
    <section>
        <div class="section_top-col">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#!" class="go_back">Назад</a></li>
                    <li class="breadcrumb-item"><a href="/portal/index">Главная</a></li>
                    <li class="breadcrumb-item active" aria-current="page">
                        О Компании
                    </li>
                </ol>
            </nav>
            <div class="title_page">О Компании</div>
        </div>
        <figure>
            <img class="company__img" src="/img/company.webp" alt="company" />
            <figcaption class="figcaption__company">
                <img src="/img/entryx.svg" alt="entryx" />
            </figcaption>
        </figure>
        <p class="title_page title_advantages"> EntryX - качественные двери в наличии. Всегда.</p>
        <div class="row w-100 justify-content-between advantages">
            <div class="col">
                <p class="number">50+</p>
                <p class="adv_text">разных моделей в ассортименте</p>
            </div>
            <div class="col">
                <p class="number">5+</p>
                <p class="adv_text">лет на рынке входных дверей</p>
            </div>
            <div class="col">
                <p class="number">70+</p>
                <p class="adv_text">партнеров в разных городах РК</p>
            </div>
            <div class="col">
                <p class="number">1000+</p>
                <p class="adv_text">дверей на складе ежедневно</p>
            </div>
        </div>
    </section>

    <section class="section-p">
          <div class="sect__top p0">
              <div class="breadcrumb__container">
                  <img src="/img/line.svg" alt="line" />
                  <p class="text-grad">О Продукции</p>
              </div>
              <div class="quality ">
                  <h2 class="title_page">Высокий уровень качества продукции</h2>
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
  </section>

@endsection
