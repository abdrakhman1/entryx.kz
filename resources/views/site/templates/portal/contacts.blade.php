@extends('site.templates.portal')


@section('content')
    <section>
        <div class="section_top-col">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#!" class="go_back">Назад</a></li>
                    <li class="breadcrumb-item"><a href="/portal/index">Главная</a></li>
                    <li class="breadcrumb-item active" aria-current="page">
                        Контакты
                    </li>
                </ol>
            </nav>
            <div class="title_page">Контакты</div>
        </div>
        <div class="bg-light-grey">
            @include('site.sections.contacts_map', ['iscatalog' => false])
        </div>

    </section>
@endsection
