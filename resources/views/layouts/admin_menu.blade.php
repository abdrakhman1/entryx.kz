<div class="nav">

    <div class="user_name">
        <a href="/" target="_blank" rel="noopener noreferrer">
            <img class="admin_logo" src="{{ asset('/img/logo-big.svg') }}" alt="">
        </a>
        <span> {{ Auth::user()->name }}</span>
    </div>

    <ul>
        <li class='{{ request()->is('admin/dashboard') ? 'active' : '' }}'>
            <a class="admin-link" href="/admin/dashboard">
                <img src="{{ asset('/img/icon/Home.svg') }}" alt=""> Главная
            </a>
        </li>
        <li class='{{ request()->is('admin/categories*') ? 'active' : '' }}'>
            <a class="admin-link" href="/admin/categories">
                <img src="{{ asset('/img/icon/categories.svg') }}" alt="">
                Категории
            </a>
        </li>
        <li class='{{ request()->is('admin/products*') ? 'active' : '' }}'>
            <a class="admin-link" href="/admin/products">
                <img src="{{ asset('img/icon/Squar.svg') }}" alt="">
                Товары
            </a>
        </li>
        <li class='{{ request()->is('admin/properties*') ? 'active' : '' }}'>
            <a class="admin-link" href="/admin/properties">
                <img src="{{ asset('img/icon/properties.svg') }}" alt="">
                Свойства товаров
            </a>
        </li>
        @if (Auth::user()->role_id == 1)
            <li class='{{ request()->is('admin/users*') ? 'active' : '' }}'>
                <a class="admin-link" href="/admin/users">
                    <img src="{{ asset('img/icon/user.svg') }}" alt="">
                    Пользователи</a>
            </li>
        @endif

        <li class='{{ request()->is('admin/orders*') ? 'active' : '' }}'>
            <a class="admin-link" href="/admin/orders">
                <img src="{{ asset('/img/icon/shop.svg') }}" alt="">
                Заказы</a>
        </li>

        <li class='{{ request()->is('admin/posts*') ? 'active' : '' }}'>
            <a class="admin-link" href="/admin/posts">
                <img src="{{ asset('/img/icon/page.svg') }}" alt="">
                Публикации</a>
        </li>
        <li class='{{ request()->is('admin/feedbacks*') ? 'active' : '' }}'>
            <a class="admin-link" href="/admin/feedbacks">
                <img src="{{ asset('/img/icon/Megaphone.svg') }}" alt="">
                Заявки</a>
        </li>
        <li class='{{ request()->is('admin/sync*') ? 'active' : '' }}'>
            <a class="admin-link" href="/admin/sync">
                <img src="{{ asset('/img/icon/icon1c.svg') }}" alt="">
                Работа с 1С</a>
        </li>
        <li class='{{ request()->is('admin/cities*', 'admin/cities*') ? 'active' : '' }}'>
            <a class="admin-link" href="/admin/cities">
                <img src="{{ asset('/img/icon/city.svg') }}" alt="">
                Города</a>
        </li>
        <li class='{{ request()->is('admin/dealers*', 'admin/dealers*') ? 'active' : '' }}'>
            <a class="admin-link" href="/admin/dealers">
                <img src="{{ asset('/img/icon/briefcase.svg') }}" alt="">
                Дилеры</a>
        </li>
        <li class='{{ request()->is('admin/tickets*') ? 'active' : '' }}'>
            <a class="admin-link" href="/admin/tickets">
                <img src="{{ asset('/img/icon/Chat.svg') }}" alt="">
                Обращения</a>
        </li>
        <li>
            <a class="admin-link" href="/logout">
                <img src="{{ asset('/img/logout.svg') }}" alt="">
                Выход</a>
        </li>
    </ul>
</div>
