@php
$iscatalog = isset($iscatalog) ? $iscatalog : false;
$contacts = [
    [
        'title' => 'Номер телефона:',
        'link' => 'tel:+7 (707) 300-20-77',
        'text' => '+7 (707) 300-20-77'
    ],
    [
        'title' => 'Электронная почта:',
        'link' => 'mailto:entryx.ast@gmail.com',
        'text' => 'entryx.ast@gmail.com'
    ],
    [
        'title' => 'Адрес:',
        'link' => '#!',
        'text' => 'Казахстан, г. Астана, ул. Туран, 30А'
    ]
];

$social = [
    [
        'link' => 'https://www.youtube.com/@entryx',
        'img' => '/img/you.svg',
        'alt' => 'youtube'
    ],
    [
        'link' => 'https://t.me/EntryX',
        'img' => '/img/telegr.svg',
        'alt' => 'telegram'
    ],
    [
        'link' => 'https://www.instagram.com/entryx_kz',
        'img' => '/img/inst.svg',
        'alt' => 'instagram'
    ]
];
@endphp

<div>
    <div class="social__info container">
        @if ($iscatalog)
            <div class="social__item">
                <p>Мы онлайн:</p>
                <div class="icon">
                    @foreach($social as $item)
                        <a href="{{ $item['link'] }}" class="icon-item">
                            <img src="{{ $item['img'] }}" alt="{{ $item['alt'] }}" />
                        </a>
                    @endforeach
                </div>
            </div>
            @foreach($contacts as $contact)
                <div class="social__item">
                    <p>{{ $contact['title'] }}</p>
                    <a href="{{ $contact['link'] }}">{{ $contact['text'] }}</a>
                </div>
            @endforeach
        @else
            <div class="social__item">
                <p>Мы онлайн:</p>
                <div class="icon">
                    @foreach($social as $item)
                        <a href="{{ $item['link'] }}" class="icon-item">
                            <img src="{{ $item['img'] }}" alt="{{ $item['alt'] }}" />
                        </a>
                    @endforeach
                </div>
            </div>
            @foreach($contacts as $contact)
                <div class="social__item">
                    <p>{{ $contact['title'] }}</p>
                    <a href="{{ $contact['link'] }}">{{ $contact['text'] }}</a>
                </div>
            @endforeach
        @endif
    </div>
    <div>
        <div id="map1"></div>
        <div class="points_container_map">
            <a class="map_index" href="https://yandex.ru/maps/163/astana/?utm_medium=mapframe&utm_source=maps"
                style="position: absolute">Астана</a>
            <a href="https://yandex.ru/maps/163/astana/house/Y0gYcwRkSEwDQFtrfX1zc39kbQ==/?ll=71.406192%2C51.128292&utm_medium=mapframe&utm_source=maps&z=17.13"
                style="position: absolute">
                Улица 
                Туран, 30А — Яндекс Карты</a>
            <iframe src="https://yandex.ru/map-widget/v1/?ll=71.406192%2C51.128292&z=17.13&mode=whatshere&whatshere[point]=71.406192,51.128292&whatshere[zoom]=17.13"
                width="100%" height="400" frameborder="1" allowfullscreen="true" style="position: relative"></iframe>
        </div>
    </div>
</div>