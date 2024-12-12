@extends('site.templates.main')

@section('content')
    <div>
        <div class=" container sect__top p-top ">
            <div class="breadcrumb__container d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Назад</a></li>
                        <li class="breadcrumb-item"><a href="#">Главная</a></li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Дилерам
                        </li>
                    </ol>
                </nav>
            </div>
            <div class="sect__bottom align-end">
                <h2>Дилерам</h2>
            </div>
        </div>
        @include('site.sections.for_dealers', ['isindex' => false])
    </div>




    <section class="dealers dealers--white section-p">
        <div class="container">
            <div class="sect__top">
                <div class="breadcrumb__container d-flex align-items-center">
                    <img src="./img/line.svg" alt="line" />
                    <p class="text-grad">Форма заявки</p>
                </div>
                <div class="sect__bottom">
                    <h4 class="black title-l">Хотите стать дилером?</h4>
                    <p class="text">
                        Оформите заявку и наши менеджеры Вам перезвонят!
                    </p>
                </div>
            </div>
            <div class="dl-container">
                @include('site.partials.feedback_form')

                <div class="container-login">
                    <h4 class="black">У вас уже есть аккаунт?</h4>
                    <button type="button" class="butn-white">Войти</button>
                    <img src="./img/decor.svg" alt="" />
                    <p>ДОСТУП ПО ПАРОЛЮ ДЛЯ ОРГАНИЗАЦИЙ, ИП и ЮР.ЛИЦ</p>
                </div>
            </div>
        </div>
    </section>

    <section class="container  ">
        <h4 class="title_benefits">Преимущества работы с нами</h4>
        <div class="benefits">
            <div class="benefit">
                <img src="./img/bulk.svg" alt="" />
                <h4 class="black">Возможность самостоятельного заказа</h4>
                <p>
                    Такая возможность исключает возможность ошибок при формировании
                    заказа со стороны менеджеров компании и трат на замену товаров.
                </p>
            </div>
            <div class="benefit">
                <img src="./img/bulk1.svg" alt="" />
                <h4 class="black">Возможность избежать ошибки</h4>
                <p>
                    Умный конфигуратор изделий позволяет избежать ошибок дилеров в
                    вариативных параметрах допустимости и совместимости опций изделий.
                </p>
            </div>
            <div class="benefit">
                <img src="./img/bulk2.svg" alt="" />
                <h4 class="black">Удобная система просмотра товаров</h4>
                <p>
                    В каталоге дилер может увидеть фотографию готового изделия. Это
                    позволяет розничному клиенту и повысить средний чек.
                </p>
            </div>
        </div>
    </section>

    <div class="bg-light-grey">
        @include('site.sections.ask')
    </div>
@endsection
