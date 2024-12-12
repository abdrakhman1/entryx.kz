<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @section('head')
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ env('APP_NAME') }}</title>
        <link rel="stylesheet" href="{{ asset('libs/bootstrap.min.css') }}" />
        <link rel="stylesheet" href="{{ asset('css/simplePagination.css') }}" />
        <link rel="stylesheet" href="{{ asset('css/portal/style.css') }}" />
        <script src="{{ asset('libs/jquery/jquery_3.6.0_jquery.min.js') }}"></script>
        <script src="{{ asset('libs/jquery/jquery.simplePagination.js') }}"></script>
        <script src="{{ asset('libs/jquery/jquery.maskedinput.min.js') }}"></script>

    @endsection
    @yield('head')
</head>

<body>
    <div class="main_container">
        @section('side_menu')
            @include('site.templates.portal.menu')
        @show

        <div class="content_container">
            @section('header')
                @include('site.templates.portal.header')
            @show


            @section('content')

            @show

            @section('footer')

                @include('site.partials.footer')
            @show
        </div>
    </div>
    @section('footerScripts')
        <script src="{{ asset('libs/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('js/index.js') }}"></script>
    @show
</body>

</html>
