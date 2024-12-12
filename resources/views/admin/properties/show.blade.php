@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h1 class="admin_title title-p">{{ $property->title }}</h1>
                </div>
                <div class="pull-right">
                    <a class="btn btn_back" href="{{ route('admin.properties.index') }}"> 
                        <img src="{{asset('img/arrows-left.svg')}}" alt="">
                        Назад</a>
                </div>
            </div>
        </div> 
       <form class="form_admin" action="">
        <p>{{ $property->category->title }}</p>
        </form>
    </div>
@endsection
