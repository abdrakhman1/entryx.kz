<div class="portal_menu">
    <a href="{{ route('portal.index') }}" class="portal_logo">
    </a>
    
    <ul class="portal_nav">
        <li class='{{ request()->is('storeman/index') ? 'active' : '' }}'>
            <a class="nav_link" href="{{ route('storeman.index') }}">
                <img src="{{ asset('/img/icon/Home.svg') }}" alt=""> 
                Главная
            </a>
        </li>
        <li class="exit">
            <a class="nav_link" href="/logout">
                <img src="{{ asset('/img/logout.svg') }}" alt="">
                Выход</a>
        </li>
    </ul>

</div>
