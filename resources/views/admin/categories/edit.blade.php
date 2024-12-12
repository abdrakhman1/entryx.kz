@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2 class="admin_title title-p">Редактирование</h2>
                </div>
                <div class="pull-right">
                    <a class="btn btn_back" href="{{ route('categories.index') }}"> <img
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

        <form class="form_admin" action="{{ route('categories.update', $category->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="row card_admin">
                <div class="form-group">
                    <label>Название:</label>
                    <input type="text" name="title" value="{{ $category->title }}" class="form-control"
                        placeholder="Название">
                </div>
                <div class="form-group">
                    <label>Parent:</label>
                    <select class="form-select" name="parent_id">
                        <option value="">--Select--</option>
                        @foreach ($categories as $parent)
                            <option value="{{ $parent->id }}" {{ $parent->id == $category->parent_id ? 'selected' : '' }}>
                                {{ $parent->title }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Сохранить</button>
            </div>
        </form>
    </div>
@endsection
