@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2 class="admin_title title-p">Редактирование пользователя</h2>
                </div>
                <div class="pull-right">
                    <a class="btn btn_back" href="{{ route('admin.users.index') }}"> 
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

        <form class="form_admin" action="{{ route('admin.users.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="card_admin">
                    <div class="form-group">
                        <label>Name:</label>
                        <input type="text" name="name" value="{{ $user->name }}" class="form-control"
                            placeholder="Name">
                    </div>
                    <div class="form-group">
                        <label>Email:</label>
                        <input type="text" name="email" value="{{ $user->email }}" class="form-control"
                            placeholder="Email">
                    </div>
                    <div class="form-group">
                        <label>Phone:</label>
                        <input type="text" name="phone" value="{{ $user->phone }}" class="form-control"
                            placeholder="Phone">
                    </div>
                    <button type="submit" class="btn btn-primary">Сохранить</button>
            </div>
        </form>
    </div>
@endsection
