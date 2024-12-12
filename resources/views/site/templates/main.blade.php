<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @section('head')
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name') }}</title>
        <link rel="stylesheet" href="{{ asset('libs/bootstrap.min.css') }}" />
        <link rel="stylesheet" href="{{ asset('libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
        {{-- <link rel="stylesheet" href="{{ asset('css/simplePagination.css') }}" /> --}}
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


        <div class="modal fade modal_form" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <form class="dealers--white form-modal" action="/feedback_submit" method="POST"
                        id="feedback_form_modal" enctype="multipart/form-data">
                        @csrf
                        <div class="form_text">
                            <h2>Получить доступ</h2>
                            <p> Пожалуйста заполните форму чтобы получить доступ к порталу </p>
                        </div>
                        <div class="inputs">
                            <div class="input">
                                <label for="name_modal">ФИО <span class="red">*</span></label>
                                <input type="text" id="name_modal" name="name" placeholder="Введите ФИО"
                                    value="{{ old('name') }}" />
                                @error('name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="input">
                                <label for="bin_modal">БИН <span class="red">*</span></label>
                                <input type="number" id="bin_modal" name="bin" placeholder="Введите БИН"
                                    value="{{ old('bin') }}" />
                                @error('bin')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="input">
                                <label for="phone--modal">Номер телефона <span class="red">*</span></label>

                                <input type="text" id="phone--modal" name="phone" placeholder="+7 (999) 999 99 99"
                                    value="{{ old('phone') }}" /> @error('phone')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="input">
                                <label>Прикрепите реквизиты</label>
                                <label class="label-file" for="requisites_modal"><img src="./img/pluse.svg"
                                        alt="+" /></label>
                                <input type="file" class="input-file" id="requisites_modal" name="user_requisites" />
                                @error('user_requisites')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="input">
                                <label for="company_name_modal">Наименование компании <span class="red">*</span></label>
                                <input type="text" id="company_name_modal" name="company_name"
                                    placeholder="Введите наименование" value="{{ old('company_name') }}" />
                                @error('company_name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="input">
                                <label>Прикрепите cправку о гос.регистрации</label>
                                <label class="label-file" for="certificate_modal"><img src="/img/pluse.svg"
                                        alt="+" /></label>
                                <input type="file" class="input-file" id="certificate_modal" name="user_certificate" />
                                @error('user_certificate')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <button type="submit" class="butn-white">Оставить заявку</button>
                    </form>
                </div>

                <button type="button" class="butn_close btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
            </div>
        </div>
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

    <div class="general-container">
        @section('content')

        @show
    </div>
    @section('footer')
        @include('site.partials.footer')
    @show
    @section('footerScripts')
        <script src="{{ asset('libs/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('js/main.js') }}"></script>
        <script async src="https://www.googletagmanager.com/gtag/js?id=G-V39CTG9WFY"></script>
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
