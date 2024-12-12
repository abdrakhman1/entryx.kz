@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2 class="admin_title title-p">Редактирование дилера: {{ $dealer->name }}</h2>
                </div>
                <div class="pull-right">
                    <a class="btn btn_back" href="{{ route('admin.dealers.show', $dealer->id) }}"> <img
                            src="{{ asset('img/arrows-left.svg') }}" alt="">
                        Назад</a>
                </div>
            </div>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form class="form_admin" action="{{ route('admin.dealers.update', $dealer->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="card_admin">
                <div class="form-group">
                    <label>Имя:</label>
                    <input type="text" name="name" value="{{ $dealer->name }}" class="form-control"
                        placeholder="Имя" />
                </div>
                <div class="form-group">
                    <label>Название компании:</label>
                    <input type="text" name="company_name" value="{{ $dealer->company_name }}" class="form-control"
                        placeholder="Название компании" />
                </div>
                <div class="form-group">
                    <label>Email:</label>
                    <input type="text" name="email" value="{{ $dealer->email }}" class="form-control"
                        placeholder="Email" />
                </div>
                <div class="form-group">
                    <label>Телефон:</label>
                    <input type="text" name="phone" value="{{ $dealer->phone }}" class="form-control phone_mask"
                        placeholder="7 (***) *******">
                </div>
                <div class="form-group">
                    <label>БИН:</label>
                    <input type="text" name="bin" value="{{ $dealer->bin }}" class="form-control" placeholder="БИН" readonly>
                </div>
                <div class="btn_box">
                    <button type="submit" class="btn btn_add">Сохранить</button>
                    <a class="btn_change" href="{{ route('admin.users.change_pass', $dealer) }}">Изменить пароль</a>
                </div>
        </form>


    </div>
@endsection
