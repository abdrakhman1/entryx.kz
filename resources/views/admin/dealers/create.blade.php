@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2 class="admin_title title-p">Добавление дилера</h2>
                </div>
                <div class="pull-right">
                    <a class="btn btn_back" href="{{ route('admin.dealers.index') }}">
                        <img src="{{ asset('img/arrows-left.svg') }}" alt="">
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

        <form method="POST" action="{{ route('admin.dealers.store') }}" id="checking_form">
            @csrf
            <div class="row form_admin">
                <div class="form-group ">
                    <label for="name">Имя</label>
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                        name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="phone">Телефон</label>
                    <input id="phone" type="text"
                        class="form-control @error('phone') is-invalid @enderror phone_mask" name="phone"
                        value="{{ old('phone') }}" required autocomplete="phone" autofocus placeholder="7 (***) *******">

                    @error('phone')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                </div>
                <div class="form-group">
                    <label for="bin">БИН</label>
                    <input id="bin" type="text" class="form-control @error('bin') is-invalid @enderror"
                        name="bin" value="{{ old('bin') }}" required autocomplete="bin" autofocus maxlength="12">

                    @error('bin')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                </div>
                <div class="form-group">
                    <label for="company_name">Название компании</label>
                    <input id="company_name" type="text" class="form-control @error('company_name') is-invalid @enderror"
                        name="company_name" value="{{ old('company_name') }}" required autocomplete="company_name"
                        autofocus>

                    @error('company_name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                </div>

                <div class="form-group">
                    <label for="email"> Email </label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                        name="email" value="{{ old('email') }}" required autocomplete="email">

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                </div>

                <div class="form-group">
                    <label for="password">Пароль</label>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                        name="password" required autocomplete="new-password">

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group ">
                    <label for="repassword">Подтвердите пароль</label>
                    <input id="repassword" type="password" class="form-control" name="repassword" required
                        autocomplete="new-password">
                </div>


                <button type="submit" class="btn btn_add" id="submit_btn">Добавить</button>
            </div>
        </form>
    </div>


    <script>
        document.getElementById('submit_btn').addEventListener('click', function() {
            event.preventDefault();
            var form = document.getElementById('checking_form');
            this.disabled = true;
            form.submit();
            // if (form.checkValidity()) {
            //     this.disabled = true;
            //     form.submit();
            // }
        });
    </script>

@endsection
