@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2 class="admin_title title-p">Редактирование города</h2>
                </div>
                <div class="pull-right">
                    <a class="btn btn_back" href="{{ route('admin.cities.index') }}"> 
                        <img src="{{asset('img/arrows-left.svg')}}" alt="">
                        Назад</a>
                </div>
            </div>
        </div> 

        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Ooops!</strong> There were some problems with your input.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form class="form_admin" action="{{ route('admin.cities.update', $city->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="card_admin">
                    <div class="form-group">
                        <label>Название:</label>
                        <input type="text" name="title" value="{{ $city->title }}" class="form-control"
                            placeholder="Title">
                    </div>
                    <div class="form-group">
                        <label>Описание:</label>
                        <input type="text" name="description" value="{{ $city->description }}" class="form-control"
                            placeholder="Description">
                    </div>
                    <div class="form-group">
                        <label>Долгота:</label>
                        <input type="text" name="longitude" value="{{ $city->longitude }}" class="form-control"
                            placeholder="Longitude">
                    </div>
                    <div class="form-group">
                        <label>Широта:</label>
                        <input type="text" name="latitude" value="{{ $city->latitude }}" class="form-control"
                            placeholder="Latitude">
                    </div>
                    <button type="submit" class="btn btn-primary">Сохранить</button>
            </div>
        </form>
    </div>
@endsection
