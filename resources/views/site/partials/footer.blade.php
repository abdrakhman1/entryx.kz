<footer>
    <div class="footer__top container">
        <div class="footer__left">
            <a href="/">
                <img src="/img/logo-big.svg" alt="logo" />
            </a>
        </div>
        <div class="footer__center">
            <div>
                <h4 class="black m0">Меню</h4>
                <nav class="nav">
                    <ul class="nav__list--foot">
                        <li class="nav__item">
                            <a href="{{ route('site.home') }}">Главная</a>
                        </li>
                        <li class="nav__item">
                            <a href="{{ route('site.catalog') }}">Каталог</a>
                        </li>
                        <li class="nav__item">
                            <a href="{{ route('site.about') }}">О компании</a>
                        </li>
                        <!-- <li class="nav__item">
                            <a href="{{ route('site.dealers') }}">Партнерам</a>
                        </li> -->
                        <li class="nav__item">
                            <a href="{{ route('site.branch_offices') }}">Точки продаж</a>
                        </li>
                        <li class="nav__item">
                            <a href="{{ route('site.contacts') }}">Контакты</a>
                        </li>
                    </ul>
                </nav>
            </div>

            <div>
                <h4 class="black m0">Бренд</h4>
                <ul class="nav__list--foot">
                    <li class="nav__item">
                        <a href="{{ route('site.catalog.brand', 'megi') }}">MEGI DOORS</a>
                    </li>
                    <li class="nav__item">
                        <a href="{{ route('site.catalog.brand', 'ретвизан') }}">Ретвизан</a>
                    </li>
                    <li class="nav__item">
                        <a href="{{ route('site.catalog.brand', 'STR') }}">STR</a>
                    </li>
                    <li class="nav__item">
                        <a href="{{ route('site.catalog.brand', 'phillips') }}">Phillips</a>
                    </li>
                    <li class="nav__item">
                        <a href="{{ route('site.catalog.brand', 'ela') }}">ELA</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="footer__right">
            <div>
                <a class="tel" href="tel:+77073002077">
                    <h3 class="text-grad">+7 (707) 300-20-77</h3>
                </a>
                <!-- <a class="tel" href="tel:+7 (906) 066-30-55">
                    <h3 class="text-grad">+7 (906) 066-30-55</h3>
                </a> -->
                <a class="email" href="mailto:entryx.ast@gmail.com">entryx.ast@gmail.com</a>
            </div>
            <div class="address--foot">
                <p>Отдел продаж:</p>
                <p>Казахстан, г. Астана, ул. Туран, 30А</p>
            </div>
            <div class="icon">
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
        </div>
    </div>
    <div class="container container_documents">
        <ul class="list_row">
            <li class="nav__item nav__item-img">
                <img src="/img/icon/logos_visa.svg" alt="visa">
                <img src="/img/icon/logos_mastercard.svg" alt="mastercard">
            </li>


            <li class="nav__item">
                <a href="{{ route('site.about.payment') }}">Оплата</a>
            </li>
            <li class="nav__item">
                <a href="{{ route('site.about.requisites') }}">Реквизиты</a>
            </li>

            <li class="nav__item">
                <a href="{{ route('site.about.public_contract') }}">Публичная оферта</a>
            </li>
            <li class="nav__item">
                <a href="{{ route('site.about.privacy') }}">Политика конфиденциальности</a>
            </li>
        </ul>

    </div>
    <div class="copyright container">
        <p>© {{ date('Y') }} EntryX. Все права защищены.</p>
        {{-- <a download href="/docs/Privacy_policy_entryx.docx">Политика конфиденциальности</a> --}}
    </div>
</footer>
