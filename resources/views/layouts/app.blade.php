<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @section('head')
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        @if (env('APP_ENV') == 'development')
            <link rel="icon" type="image/x-icon" href="/favicon_dev.ico">
        @elseif (env('APP_ENV') == 'local')
            <link rel="icon" type="image/x-icon" href="/favicon_loc.ico">
        @else
            <link rel="icon" type="image/x-icon" href="/favicon.ico">
        @endif
        
        <title>Панель администрирования | {{ env('APP_NAME') }}</title>

         
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        <script src="{{ asset('libs/jquery/jquery_3.6.0_jquery.min.js') }}"></script>
        
        <script src="{{ asset('js/app.js') }}" defer></script>
    @endsection
    @yield('head')

</head>

<body class="admin_container">
    <div class="side_menu">
        @include('layouts.admin_menu')
    </div>

    <div class="side_main">

        @if (session()->has('success'))
            <div class="alert alert-success" role="alert">
                {{ session()->get('success') }}
            </div>
        @endif

        @if (session()->has('error'))
            <div class="alert alert-danger" role="alert">
                {{ session()->get('error') }}
            </div>
        @endif

        @yield('content')
    </div>

</body>

</html>
