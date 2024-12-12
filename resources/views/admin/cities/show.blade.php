@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2 class="admin_title title-p">Просмотр данных города</h2>
                </div>
                <div class="pull-right">
                    <a class="btn btn_back" href="{{ route('admin.cities.index') }}"> <img
                            src="{{ asset('img/arrows-left.svg') }}" alt=""> Назад </a>
                </div>
            </div>
        </div>

        <div class="container_post card_admin">
            <div class="card_item">
                <span>Название:</span>
                {{ $city->title }}
            </div>
            <div class="card_item">
                <span>Описание:</span>
                {{ $city->description }}
            </div>
            <div class="card_item">
                <span>Долгота:</span>
                {{ $city->longitude }}
            </div>
            <div class="card_item">
                <span>Широта:</span>
                {{ $city->latitude }}
            </div>
        </div>
    </div>
@endsection
