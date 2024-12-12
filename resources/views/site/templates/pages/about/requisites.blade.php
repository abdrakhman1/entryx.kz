@extends('site.templates.main')
@section('content')
    <div class="container  sect__top p-top">
        <div class="breadcrumb__container d-flex align-items-center">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a class="go_back" href="#!">Назад</a></li>
                    <li class="breadcrumb-item"><a href="#">Главная</a></li>
                    <li class="breadcrumb-item active" aria-current="page">
                        Реквизиты
                    </li>
                </ol>
            </nav>
        </div>
        <div class="sect__bottom">
            <h2>Реквизиты</h2>
        </div>
        <ul class="requisites_list">
            <li>
                ТОО «EntryX»
            </li>
            <li><span>БИН:</span> 220140000424
            </li>
            <li><span>ИИК:</span> КZ598562203130549176
            </li>
            <li>В АО "Банк ЦентрКредит"
            </li>
            <li><span>БИК:</span> КСJВКZКХ
            </li>
            <li><span>Юридический адрес:</span> г.Астана, р-он
                Байконыр, Республик дангылы, 4/2, кв 3.
            </li>
            <li><span>Фактический адрес:</span> г. Астана, р-он
                Есиль, проспект Туран д.ЗОА н.п. 2
                Мадибеков Е.Ж.</li>

        </ul>
    </div>
@endsection
