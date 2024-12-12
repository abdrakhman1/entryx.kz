@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2 class="admin_title title-p">Дилер: {{ $dealer->name }}</h2>
                </div>

                <div class="pull-right">
                    <a class="btn btn_back" href="{{ route('admin.dealers.index') }}">
                        <img src="{{ asset('img/arrows-left.svg') }}" alt="">
                        Назад</a>
                    <a class="btn btn_primary flex" href="{{ route('admin.dealers.edit', $dealer->id) }}">
                        Редактировать
                    </a>
                    <a class="btn btn_primary flex gap-2"
                        href="{{ route('admin.branchoffices.create', ['dealer' => $dealer->id]) }}">
                        <img src="{{ asset('img/icon/map.svg') }}" alt="">
                        Добавить точку продаж
                    </a>
                </div>
            </div>
        </div>
        <div class="form_admin form_admin--separat ">
            <div class="card_admin">
                <h3 class="card_title">О Дилере</h3>
                <div class="card_item">
                    <h4>Имя: </h4> {{ $dealer->name }}
                </div>
                <div class="card_item">
                    <h4>Название компании: </h4> {{ $dealer->company_name }}
                </div>
                <div class="card_item">
                    <h4>Email:</h4> {{ $dealer->email }}
                </div>
                <div class="card_item">
                    <h4>Телефон: </h4> {{ $dealer->phone }}
                </div>
                <div class="card_item">
                    <h4>БИН: </h4> {{ $dealer->bin }}
                </div>
                
            </div>
            <div class="points_box">
                @foreach ($branchoffices as $branchoffice)
                    <div class="card_admin">
                        <h3 class="card_title"> Точка продаж: {{ $branchoffice->title }}</h3>
                        <div class="card_item">
                            <h4> Адрес: </h4> {{ $branchoffice->address }}
                        </div>
                        <div class="card_item">
                            <h4> Описание: </h4> {{ $branchoffice->description }}
                        </div>
                        <form action="{{ route('admin.branchoffices.destroy', [$dealer->id, $branchoffice->id]) }}"
                            method="POST">

                            <a class="btn btn_primary btn_intro"
                                href="{{ route('admin.branchoffices.edit', [$dealer->id, $branchoffice->id]) }}">Редактировать</a>

                            @csrf
                            @method('DELETE')

                            <button type="submit" class="btn btn_danger btn_intro"
                                onclick="return confirm('Удалить?')">Удалить</button>
                        </form>
                    </div>
                @endforeach
            </div>
        </div>
        {{ $branchoffices->links() }}
    </div>
@endsection
