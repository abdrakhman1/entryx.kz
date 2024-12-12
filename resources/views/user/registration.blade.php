@extends('layouts.clean')

@section('content')
    <h1>Регистрация</h1>

    <div class="card_wrapper">
        <form class="form_request" method="POST" action="/user/registration">
            @csrf

            <div class="mb-3">
                <label for="" class="form-label">Имя:</label>
                <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}" required>
                @error('name')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3">
                <label for="" class="form-label">Email:</label>
                <input type="text" class="form-control" name="email" id="email" value="{{ old('email') }}" required>
                @error('email')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3">
                <label for="" class="form-label">Пароль:</label>
                <input type="password" class="form-control" name="password" id="password" value="{{ old('password') }}" required>
                @error('password')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3">
                <label for="" class="form-label">Пароль ещё раз:</label>
                <input type="password" class="form-control" name="repassword" id="repassword" value="{{ old('repassword') }}" required>
                @error('repassword')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            

            <button type="submit" class="accept_button btn btn-primary button_width">Регистрация</button>
        </form>

    </div>

@stop


