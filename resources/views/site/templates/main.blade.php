<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @section('head')
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ env('APP_NAME') }}</title>
        <link rel="stylesheet" href="{{ asset('libs/bootstrap.min.css') }}" />
        <link rel="stylesheet" href="{{ asset('libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
 
        <link rel="stylesheet" href="{{ asset('css/simplePagination.css') }}" />
        <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
        <script src="{{ asset('libs/jquery/jquery_3.6.0_jquery.min.js') }}"></script>
        <script src="{{ asset('libs/perfect-scrollbar/perfect-scrollbar.jquery.js') }}"></script>
        <script src="{{ asset('libs/jquery/jquery.simplePagination.js') }}"></script>
        <script src="{{ asset('libs/jquery/jquery.maskedinput.min.js') }}"></script>

    @endsection
    @yield('head')
</head>

<body>
    @section('header')
        @include('site.partials.header')


        <!-- Модальное окно -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered ">
                    <div class="modal-content">
                    <form class="form-modal">

                        <div class="form_text">
                            <h2>Оставьте заявку</h2>
                            <p>Введите свои данные и мы Вам перезвоним в ближайшее время! </p>
                        </div>

                        <div class="input input-white">
                            <label for="name--reg">Введите имя <span class="red">*</span></label>
                            <input type="text" id="name--reg" name="user_name" placeholder="Введите имя" />
                        </div>
            
                        <div class="input input-white">
                            <label for="phone--reg">Номер телефона <span class="red">*</span></label>
                            </label>
                            <input type="tel" id="phone--reg" placeholder="+7 (999) 999 99 99" />
                        </div>
            
                        <div class="input w-100 input-white">
                            <label for="bin--reg">Введите комментарий</label>
                            <input type="text" id="bin--reg" name="user_bin" placeholder="Комментарий (не обязательно)" />
                        </div>
            
                        <button class="butn black-bg  upper">Оставить заявку</button>
                    </form>
                    <button type="button" class="butn_close" data-bs-dismiss="modal"></button>
                    </div>
            </div>
        </div>


    @show


    <div class="general-container">
        @section('content')

        @show
    </div>
    @section('footer')
        @include('site.partials.footer')
    @show
    @section('footerScripts')
        <script src="{{ asset('libs/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('js/index.js') }}"></script>
    @show
</body>

</html>
