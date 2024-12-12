<header class="header ">
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light w-100">
            <div class="container-fluid">
                <a class="navbar-brand" href="/">
                    <img src="/img/Union.svg" alt="logo" /></a>
                <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <div class="nav-wrap">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                            <li class="nav-item {{ route_is_active('site.home') }}">
                                <a class="nav-link" href="{{ route('site.home') }}">Главная</a>
                            </li>

                            <li class="nav-item relative">
                                <a class="nav-link">Каталог</a>
                                <ul class="nav-item nav-item--open">
                                    @foreach (\App\Models\Category::menu() as $item)
                                        <li> <a class="nav-link" href="{{ route('site.catalog.category', $item->id) }}">{{ $item->title }}</a> </li>
                                    @endforeach
                                </ul>
                            </li>
                            <li class="nav-item {{ route_is_active('site.about') }}">
                                <a class="nav-link" href="{{ route('site.about') }}">
                                    О компании
                                </a>
                            </li>
                            <!-- <li class="nav-item {{ route_is_active('site.dealers') }}">
                                <a class="nav-link" href="{{ route('site.dealers') }}">
                                    Партнерам
                                </a>
                            </li> -->
                            <li class="nav-item {{ route_is_active('site.branch_offices') }}">
                                <a class="nav-link" href="{{ route('site.branch_offices') }}">
                                    Точки продаж
                                </a>
                            </li>
                            <li class="nav-item {{ route_is_active('site.contacts') }}">
                                <a class="nav-link" href="{{ route('site.contacts') }}">
                                    Контакты
                                </a>
                            </li>
                        </ul>
                        <div class="d-flex header__contacts">
                            <div class="header__contact">
                                <a class="tel" href="tel:+77073002077">+7 (707) 300-20-77</a>
                                <a class="tel" href="tel:+7 (906) 066-30-55">+7 (906) 066-30-55</a>
                                <a class="email" href="mailto:entryx.ast@gmail.com">entryx.ast@gmail.com</a>
                            </div>
                            <div class="icon icon-mobile">
                                <a href="https://www.youtube.com/@entryx" class="icon-item">
                                    <img src="/img/you.svg" alt="youtube" />
                                </a>
                                <a href="https://t.me/EntryX" class="icon-item">
                                    <img src="/img/telegr.svg" alt="telegram" />
                                </a>
                                <a href="https://www.instagram.com/entryx_kz" class="icon-item">
                                    <img src="/img/inst.svg" alt="instagram" />
                                </a>
                            </div>
                            <button class="butn butn_reg" type="button" data-bs-toggle="modal"
                                data-bs-target="#exampleModal">Стать партнером</button>
                            <!-- <a href="{{ route('portal.login') }}" class="butn_header butn">Вход для партнеров</a> -->
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </div>
</header>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var navItem = document.querySelector(".nav-item.relative");

        navItem.addEventListener("click", function(event) {
            if (navItem.classList.contains("open")) {
                navItem.classList.remove("open");
            } else {
                navItem.classList.add("open");
            }
            event.stopPropagation();
        });

        document.body.addEventListener("click", function() {
            navItem.classList.remove("open");
        });
    });
</script>
