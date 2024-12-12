@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2 class="admin_title title-p">Просмотр категории</h2>
                </div>
                <div class="pull-right">
                    <a class="btn btn_back"href="{{ route('categories.index') }}"> 
                        <img src="{{asset('img/arrows-left.svg')}}" alt="">
                        Назад</a>
                </div>
            </div>
        </div>
        

        <div class="form_admin card_admin">
                <div class="card_item">
                    <span>Название:</span>
                    {{ $category->title }}
                </div>
                <div class="card_item">
                    <span>Parent:</span>
                    {{ $category->parent ? $category->parent->title : 'None' }}
                </div>
        </div>
    </div>
@endsection
