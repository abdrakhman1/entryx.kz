@extends('site.templates.portal')
@section('head')
    @parent
    <link rel="stylesheet" href="{{ asset('css/portal/profile.css') }}" />
@endsection

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a class="go_back" href="#!">Назад</a></li>
            <li class="breadcrumb-item"><a href="/portal/index">Главная</a></li>
            <li class="breadcrumb-item active" aria-current="page">
                Профиль компании
            </li>
        </ol>
    </nav>
    <div class="title_page">Профиль компании</div>
    <div class="field_company">
        <form action="">
            <div class="info_items">
                <div class="info_item_row">
                    <div class="info_item_col">
                        <div class="info_item">
                            <div class="label">ФИО </div>
                            <div class="item">{{ $user->name }} </div>
                        </div>
                        <div class="info_item info_item_tel">
                            <div class="label">Номер телефона </div>
                            <div class="item profile_phone">{{ $user->phone }}</div>
                        </div>

                    </div>
                    <div class="info_item_col">
                        <div class="info_item">
                            <div class="label">БИН </div>
                            <div class="item"> {{ $user->bin }} </div>
                        </div>
                        <div class="info_item">
                            <div class="label">Наименование компании </div>
                            <div class="item">{{ $user->company_name }}</div>
                        </div>
                    </div>
                </div>
                @if ($user->branchoffices->isEmpty())
                @else
                    <div class="info_item info_item-points">
                        <div class="item_info-title">Точки продаж </div>
                        <div class="items_grid ">
                            @foreach ($user->branchoffices as $branchoffice)
                                <div class="item_grid">
                                    <ul class="item_info-points">
                                        <li class="item_info_title"> {{ $branchoffice->title }}</li>
                                        <li class="item_info"> <span>Адрес:</span> {{ $branchoffice->address }}</li>
                                        <li class="item_info"> <span>Телефон:</span> {{ $branchoffice->phone }}</li>
                                    </ul>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
                <a class="butn_change" href="{{route('portal.user.profile.change_pass')}}">Изменить пароль</a>
            </div>
        </form>
    </div>


@section('footerScripts')
    @parent


    <script src="{{ asset('js/form-file.js') }}"></script>

@show
@endsection
