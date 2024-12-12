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

        <link rel="stylesheet" href="{{ asset('/libs/fansybox/fansybox.css') }}">
        <link rel="stylesheet" href="{{ asset('/css/app.css') }}">
        <script src="{{ asset('/libs/jquery/jquery_3.6.0_jquery.min.js') }}"></script>
        <script src="{{ asset('/libs/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('/libs/fansybox/fansybox.umd.js') }}" ></script>
        <script src="{{ asset('/libs/jquery/jquery.maskedinput.min.js') }}"></script>
        <script src="{{ asset('/js/app.js') }}" defer></script>
        <script>
            window.dataLayer = window.dataLayer || [];

            function gtag() {
                dataLayer.push(arguments);
            }
            gtag('js', new Date());

            gtag('config', 'G-V39CTG9WFY');
        </script>
        <script type="text/javascript">
            (function(m, e, t, r, i, k, a) {
                m[i] = m[i]

                function() {
                    (m[i].a = m[i].a[]).push(arguments)
                };
                m[i].l = 1 * new Date();
                for (var j = 0; j < document.scripts.length; j++) {
                    if (document.scripts[j].src === r) {
                        return;
                    }
                }
                k = e.createElement(t), a = e.getElementsByTagName(t)[0], k.async = 1, k.src = r, a.parentNode.insertBefore(
                    k, a)
            })
            (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

            ym(95107812, "init", {
                clickmap: true,
                trackLinks: true,
                accurateTrackBounce: true,
                webvisor: true
            });
        </script>
        <noscript>
            <div><img src="https://mc.yandex.ru/watch/95107812" style="position:absolute; left:-9999px;" alt="" />
            </div>
        </noscript>
    @endsection
    @yield('head')

</head>

<body class="admin_container">
    <div class="side_menu">
        @if (request()->user()->role_id == 1)
            @include('layouts.admin_menu')
        @else
            @include('layouts.manager_menu')
        @endif

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
