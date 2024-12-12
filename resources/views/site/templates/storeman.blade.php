<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @section('head')
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ env('APP_NAME') }}</title>
        <link rel="stylesheet" href="{{ asset('libs/bootstrap.min.css') }}" />
        <link rel="stylesheet" href="{{ asset('/css/store/style.css') }}" />
        {{-- <link rel="stylesheet" href="{{ asset('css/simplePagination.css') }}" /> --}}
        <link rel="stylesheet" href="{{ asset('css/portal/style.css') }}" />
        <script src="{{ asset('libs/jquery/jquery_3.6.0_jquery.min.js') }}"></script>
        <script src="{{ asset('libs/jquery/jquery.simplePagination.js') }}"></script>
        <script src="{{ asset('libs/jquery/jquery.maskedinput.min.js') }}"></script>

    @endsection
    @yield('head')
</head>

<body>
    <div class="overlay"></div>
    <div class="main_container">
        @section('side_menu')
            @include('site.templates.store.menu')
        @show
        <div class="header header_mobile  show_mobile">
            <div class="mobile_logo"></div>
            <button class="burger"></button>

        </div>

        <div class="content_container">
            <div class="div">
                @section('content')
                @show
            </div>

            @section('footer')

                @include('site.templates.portal.footer')
            @show
        </div>

      
 



    </div>
    @section('footerScripts')
        <script src="{{ asset('libs/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('js/portal-nav.js') }}"></script>
    @show
</body>

</html>
