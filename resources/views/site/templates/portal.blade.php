<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @section('head')
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Entryx | Портал</title>
        <link rel="stylesheet" href="{{ asset('libs/bootstrap.min.css') }}" />
        <link rel="stylesheet" href="{{ asset('css/portal/style.css') }}" />
        <script src="{{ asset('libs/jquery/jquery_3.6.0_jquery.min.js') }}"></script>
        <script src="{{ asset('libs/jquery/jquery.simplePagination.js') }}"></script>
        <script src="{{ asset('libs/jquery/jquery.maskedinput.min.js') }}"></script>

    @endsection
    @yield('head')
</head>

<body>
    @php
        $notifies = \App\Models\Notify::last10();
        $cart = \App\Models\Cart::current();
        $unreaded_count = \App\Models\Notify::unreaded_count();
    @endphp

    <div class="overlay"></div>
    <div class="main_container">
        @section('side_menu')
            @include('site.templates.portal.menu')
        @show
        <div class="header header_mobile  show_mobile">
            <div class="mobile_logo"></div>
            <button class="burger"></button>
        </div>

        <div class="content_container">
            <div>
                @section('header')
                    @include('site.templates.portal.header', [
                        'cart' => \App\Models\Cart::current(),
                        'unreaded_count' => \App\Models\Notify::unreaded_count(),
                    ])
                @show

                <div class="container">
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
                </div>

                @section('content')
                @show
            </div>

            @section('footer')
                @include('site.templates.portal.footer')
            @show
        </div>

        <div class="menu_mobile show_mobile">
            <a href="{{ route('portal.index') }}" class="menu_link">
                <img src="/img/icon/SquaresGreen.svg" alt="">
                Главная

            </a>
            <a href="{{ route('portal.user.cart') }}" class="menu_link">
                <img src="/img/icon/menu_mobile_shopbag.svg" alt="">
                Корзина
                @if ($cart->count())
                    <div class="notice_elem"> {{ $cart->count() }} </div>
                @endif
            </a>
            <a href="{{ route('portal.notifies.index') }}" class="menu_link ">
                <img src="/img/icon/message.svg" alt="">
                Уведомления
                @if ($unreaded_count > 0)
                    <div class="notice_elem">
                        {{ $unreaded_count }}
                    </div>
                @endif
            </a>
            <a href="{{ route('portal.user.profile') }}" class="menu_link">
                <img src="/img/icon/mobile_menu_user.svg" alt="">
                Профиль</a>
        </div>

        <div class="notice_field">
            <p class="h3">Уведомления</p>
            <div class="notice_items">
                @if ($notifies->isEmpty())
                    <p>Уведомлений нет</p>
                    <a class="btn_green-light" href="{{ route('portal.notifies.index') }}">Перейти во все
                        уведомления</a>
                @else
                    @foreach ($notifies as $notify)
                        <div class="notice_item">
                            <div class="notice_date">
                                {{ $notify->human_datetime() }}
                            </div>
                            <div class="notice_message">
                                <div>
                                    {{ $notify->title }}
                                </div>
                                <div>
                                    {{ $notify->message }}
                                </div>
                            </div>
                            <a class="notice_exit" href="{{ route('portal.notifies.read', $notify) }}"></a>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>

    </div>
    @section('footerScripts')
        <script src="{{ asset('libs/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('js/portal-nav.js') }}"></script>
        <script>
            const buttonElement = document.querySelector('.search_push');
            const inputElement = document.querySelector('input[name="range-catalog"]');

            buttonElement.addEventListener('click', async function(e) {
                e.preventDefault();
                let inputValue = inputElement.value; // Введенный текст

                try {
                    const response = await fetch(`/product/search/${inputValue}`);
                    if (response.ok) {
                        const data = await response.json();
                        console.log(data);
                    } else {
                        console.error('Ошибка при выполнении запроса:', response.status);
                    }
                } catch (error) {
                    console.error('Произошла ошибка:', error);
                }
            });
        </script>
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
    @show
</body>
</html>
