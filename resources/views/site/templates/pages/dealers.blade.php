@extends('site.templates.main')

@section('content')
    <div>
        <div class=" container sect__top p-top ">
            <div class="breadcrumb__container d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a class="go_back" href="#!">Назад</a></li>
                        <li class="breadcrumb-item"><a href="/">Главная</a></li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Партнерам
                        </li>
                    </ol>
                </nav>
            </div>
            <div class="sect__bottom align-end">
                <h2>Партнерам</h2>
            </div>
        </div>
        @include('site.sections.for_dealers', ['isindex' => false])
    </div>

    <section class="dealers dealers--white section-p">
        <div class="container">
            <div class="sect__top">
                <div class="breadcrumb__container d-flex align-items-center">
                    <img src="/img/line.svg" alt="line" />
                    <p class="text-grad">Форма заявки</p>
                </div>
                <div class="sect__bottom">
                    <h4 class="black title-l">Хотите стать партнером?</h4>
                    <p class="text">
                        Оформите заявку и наши менеджеры Вам перезвонят!
                    </p>
                </div>
            </div>
            <div class="dl-container">
                @include('site.partials.feedback_form')

                <div class="container-login">
                    <h4 class="black">У вас уже есть аккаунт?</h4>
                    <a href="{{ route('portal.login') }}" class="butn-white">Войти</a>
                    <img src="/img/decor.svg" alt="" />
                    <p>ДОСТУП ПО ПАРОЛЮ ДЛЯ ОРГАНИЗАЦИЙ, ИП и ЮР.ЛИЦ</p>
                </div>
            </div>
        </div>
    </section>

    <section class="container  ">
        <h4 class="title_benefits">Преимущества работы с нами</h4>
        <div class="benefits">
            <div class="benefit">
                <img src="/img/bulk.svg" alt="" />
                <h4 class="black">Возможность самостоятельного заказа</h4>
                <p>
                    Такая возможность исключает возможность ошибок при формировании
                    заказа со стороны менеджеров компании и трат на замену товаров.
                </p>
            </div>
            <div class="benefit">
                <img src="/img/bulk1.svg" alt="" />
                <h4 class="black">Возможность избежать ошибки</h4>
                <p>
                    Умный конфигуратор изделий позволяет избежать ошибок партнеров в
                    вариативных параметрах допустимости и совместимости опций изделий.
                </p>
            </div>
            <div class="benefit">
                <img src="/img/bulk2.svg" alt="" />
                <h4 class="black">Постоянная поддержка партнеров</h4>
                <p>
                    Наше стремление быть не только поставщиком, но и настоящим другом для наших партнеров, делает наше сотрудничество особенным и ценным.
                </p>

            </div>
        </div>
    </section>

    <div class="bg-light-grey">
        @include('site.sections.ask')
    </div>
@endsection
