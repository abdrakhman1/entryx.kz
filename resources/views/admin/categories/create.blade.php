@extends('layouts.app')

@section('content')
    <div class="container">
        
        <div>

            <div class="pull-left">
                <h2 class="admin_title title-p">Добавить категорию</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn_back" href="{{ route('categories.index') }}"> <img src="{{asset('img/arrows-left.svg')}}" alt="">
                    Назад</a>
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

        <form action="{{ route('categories.store') }}" method="POST">
            @csrf

            <div class="row form_admin">
               <div class="form-group">
                <label>Название:</label>
                <input type="text" name="title" class="form-control" placeholder="Название">
               </div>
                <div class="form-group"><label>Parent:</label>
                    <select class="form-control" name="parent_id">
                        <option value="">--Select--</option>
                        @foreach ($categories as $parent)
                            <option value="{{ $parent->id }}">{{ $parent->title }}</option>
                        @endforeach
                    </select></div>
                <button type="submit" class="btn btn_add">Добавить</button>
            </div>
        </form>
    </div>
@endsection
