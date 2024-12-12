@php
    $isOpen = request()->is('portal/profile') || request()->is('portal/orders') || request()->is('portal/notifies');
    $isOpenCatalog = request()->is('portal/catalog/1') || request()->is('portal/catalog/2');
@endphp

<div class="portal_menu">
    <a href="{{ route('portal.index') }}" class="portal_logo">
    </a>
    <ul class="portal_nav">
        <li class='{{ request()->is('portal/index') ? 'active' : ' ' }}'>
            <a class="nav_link" href="{{ route('portal.index') }}">
                <img src="{{ asset('/img/icon/Home.svg') }}" alt="">
                Главная
            </a>
        </li>
        <li>
            <a class="nav_link nav_onclick {{ $isOpenCatalog ? '' : 'collapsed' }}" data-bs-toggle="collapse"
                href="#collapseExampleCatalog" role="button">
                <img src="{{ asset('/img/icon/Squar.svg') }}" alt="">
                Каталог
            </a>
        </li>
        <ul class="collapse {{ $isOpenCatalog ? 'show' : '' }}" id="collapseExampleCatalog">

            @foreach (\App\Models\Category::menu() as $item)

            <li class="{{ request()->is('portal/catalog/' . $item->id) ? 'active' : '' }}">
                <a class="nav_link nav_link-sub" href="{{ route('portal.catalog.category', $item->id) }}">{{ $item->title }}</a>
            </li>
            @endforeach

        </ul>
        <li class='{{ request()->is('portal/about') ? 'active' : '' }}'>
            <a class="nav_link" href="{{ route('portal.about') }}">
                <img src="{{ asset('img/icon/Inform.svg') }}" alt="">
                О Компании
            </a>
        </li>
        <li>
            <a class="nav_link nav_onclick {{ $isOpen ? '' : 'collapsed' }}" data-bs-toggle="collapse"
                href="#collapseExample" role="button">
                <img src="{{ asset('img/icon/user.svg') }}" alt="">
                Личный кабинет
            </a>
        </li>
        <ul class="collapse {{ $isOpen ? 'show' : '' }}" id="collapseExample">
            <li class='{{ request()->is('portal/profile') ? 'active' : '' }}'>
                <a class="nav_link nav_link-sub" href="{{ route('portal.user.profile') }}">
                    Профиль компании
                </a>
            </li>
            <li class='{{ request()->is('portal/orders') ? 'active' : '' }}'>
                <a class="nav_link nav_link-sub" href="{{ route('portal.user.orders') }}">
                    Текущие заказы
                </a>
            </li>
            <li class='{{ request()->is('portal/notifies') ? 'active' : '' }}'>
                <a class="nav_link nav_link-sub" href="{{ route('portal.notifies.index') }}">
                    Уведомления
                </a>
            </li>
        </ul>

        <li class='{{ request()->is('portal/posts') ? 'active' : '' }}'>
            <a class="nav_link" href="{{ route('portal.posts.index') }}">
                <img src="{{ asset('img/icon/Megaphone.svg') }}" alt="">
                Статьи и новости</a>
        </li>
        <li class='d-none'>
            <a class="nav_link" href="{{ route('portal.index') }}">
                <img src="{{ asset('/img/icon/program.svg') }}" alt="">
                Программа лояльности</a>
        </li>
        <li class='{{ request()->is('portal/contacts') ? 'active' : '' }}'>
            <a class="nav_link" href="{{ route('portal.contacts') }}">
                <img src="{{ asset('/img/icon/map.svg') }}" alt="">
                Контакты</a>
        </li>
        <li class='{{ request()->is('portal/tickets') ? 'active' : '' }}'>
            <a class="nav_link" href="{{ route('portal.tickets.index') }}">
                <img src="{{ asset('/img/icon/Chat.svg') }}" alt="">
                Тех.поддержка</a>
        </li>
        <li class="exit">
            <a class="nav_link" href="/logout">
                <img src="{{ asset('/img/logout.svg') }}" alt="">
                Выход</a>
        </li>
    </ul>

</div>
