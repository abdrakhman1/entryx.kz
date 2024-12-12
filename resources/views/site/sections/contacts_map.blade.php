@php
$iscatalog = isset($iscatalog) ? $iscatalog : false;
@endphp
<div>
    <div class="social__info container ">
        @if ($iscatalog)
        <div class="social__item">
            <p>Мы онлайн:</p>
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
        <div class="social__item">
            <p>Номер телефона:</p>
            <a href="tel:+7 (707) 300-20-77">+7 (707) 300-20-77</a>
            <a href="tel:+7 (906) 066-30-55">+7 (906) 066-30-55</a>
        </div>
        <div class="social__item">
            <p>Электронная почта:</p>
            <a href="mailto:entryx.ast@gmail.com">entryx.ast@gmail.com</a>
        </div>
        <div class="social__item">
            <p>Адрес:</p>
            <a href="#!">Казахстан, г. Астана, ул. Шарбакты, 14/1</a>
        </div>
        @else
        <div class="social__item">
            <p>Номер телефона:</p>
            <a href="tel:+7 (707) 300-20-77">+7 (707) 300-20-77</a>
            <a href="tel:+7 (906) 066-30-55">+7 (906) 066-30-55</a>
        </div>
        <div class="social__item">
            <p>Электронная почта:</p>
            <a href="mailto:entryx.ast@gmail.com">entryx.ast@gmail.com</a>
        </div>
        <div class="social__item">
            <p>Адрес:</p>
            <a href="#!">Казахстан, г. Астана, ул. Шарбакты, 14/1</a>
        </div>
        <div class="social__item">
            <p>Мы онлайн:</p>
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
        @endif
    </div>
    <div>
        <div id="map1" ></div>
        <div class="points_container_map">
            <a class="map_index" href="https://yandex.ru/maps/163/astana/?utm_medium=mapframe&utm_source=maps"
                style=" position: absolute">Астана</a><a
                href="https://yandex.ru/maps/163/astana/house/Y0gYcwRkSEwDQFtrfX1zc39kbQ==/?ll=71.533886%2C51.122692&utm_medium=mapframe&utm_source=maps&z=17.56"
                style="position: absolute;">
                Улица
                Шарбакты, 14/1 — Яндекс Карты</a><iframe
                src="https://yandex.ru/map-widget/v1/?ll=71.533886%2C51.122692&mode=search&ol=geo&ouri=ymapsbm1%3A%2F%2Fgeo%3Fdata%3DCgo0MDkwMjk0MjU5EnfSmtCw0LfQsNKb0YHRgtCw0L0sINCQ0YHRgtCw0L3QsCwg06jQvdC10YDQutOZ0YHRltC_0YLRltC6INGI0LDSk9GL0L0g0LDRg9C00LDQvdGLLCDQqNCw0YDQsdCw0pvRgtGLINC606nRiNC10YHRliwgMTQvMSIKDYIRj0IVUX1MQg%2C%2C&z=17.56"
                width="100%" height="400" frameborder="1" allowfullscreen="true" style="position: relative"></iframe>
        </div>
    </div>

</div>
