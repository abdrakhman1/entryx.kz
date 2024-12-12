@extends('site.templates.main')

@section('content')
    <div>
        <div class="bg-w">
            <div class="container  sect__top p-top">
                <div class="breadcrumb__container d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a class="go_back" href="#!">Назад</a></li>
                            <li class="breadcrumb-item"><a href="#">Главная</a></li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Контакты
                            </li>
                        </ol>
                    </nav>
                </div>
                <div class="sect__bottom">
                    <h2>Контакты</h2>
                </div>
            </div>
        </div>

        <div class="bg-light-grey">
            @include('site.sections.contacts_map')
            @include('site.sections.ask')
        </div>

    </div>
@endsection
