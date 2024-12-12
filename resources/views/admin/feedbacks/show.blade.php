@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2 class="admin_title title-p">Просмотр заявки </h2>
                </div>
                <div class="pull-right">
                    <a class="btn btn_back"href="{{ route('admin.feedbacks.index') }}">
                        <img src="{{ asset('img/arrows-left.svg') }}" alt="">
                        Назад</a>
                </div>
            </div>
        </div>

        <div class="form_admin card_admin card">
            <div class="card-body">
                <h5 class="card_title mb-3">ID: {{ $feedback->id }}</h5>
                <p class="card_item"><strong>Имя:</strong> {{ $feedback->name }}</p>
                <p class="card_item"><strong>Телефон:</strong> {{ $feedback->phone }}</p>
                <p class="card_item"><strong>Сообщение:</strong> {{ $feedback->message }}</p>
                @if ($feedback->filepath1)
                    <p class="card_item"><strong>File 1:</strong>
                        <a href="{{ route('admin.feedbacks.download_file', [$feedback->id, 1]) }}">
                            Скачать реквизиты
                        </a>
                    </p>
                @endif

                @if ($feedback->filepath2)
                    <p class="card_item"><strong>File 2:</strong>
                        <a href="{{ route('admin.feedbacks.download_file', [$feedback->id, 2]) }}">
                            Скачать cправку о гос.регистрации
                        </a>
                    </p>
                @endif

                <p class="card_item"><strong>Прочитано:</strong> {{ $feedback->read_at }}</p>
            </div>
        </div>

    </div>
@endsection
