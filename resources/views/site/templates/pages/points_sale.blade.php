@extends('site.templates.main')

@section('head')
    @parent
    <link rel="stylesheet" href="{{ asset('css/map.css') }}">
    {{-- <script src="https://api-maps.yandex.ru/2.1/?apikey=7e7f0f64-84e3-4156-aa2b-0a3dccc291e5&lang=ru_RU" type="text/javascript"> --}}
    <script src="https://api-maps.yandex.ru/v3/?apikey=7e7f0f64-84e3-4156-aa2b-0a3dccc291e5&lang=ru_RU"></script>
    <script src="{{ asset('js/marker-map.js') }}"></script>
@endsection

@section('content')
    <div>
        <div>
            <div class=" container sect__top p-top ">
                <div class="breadcrumb__container d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a class="go_back" href="#!">Назад</a></li>
                            <li class="breadcrumb-item"><a href="/">Главная</a></li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Точки продаж
                            </li>
                        </ol>
                    </nav>
                </div>
                <div class="sect__bottom align-end">
                    <h2>Точки продаж</h2>
                </div>
            </div>
        </div>

        <div class="points_container container">
            <div>
                <div class="points_butns">
                    <button class="butn_list butn_point">Списком</button>
                    <button class="butn_map butn_point">На карте</button>
                </div>
                <div class="search_points-sale">
                    <input id="search_points_input" type="search" name="search-points"
                        placeholder="Найти компанию, город, адреc" />
                    <button class="search_butn"><img src="/img/search-points.svg" alt="" /></button>
                </div>

                <div id="scroll" class="nano">
                    <div class="content">

                        @foreach ($branch_offices as $office)
                            <div class="points-item flex-col" data-longitude="{{ $office->longitude }}"
                                data-latitude="{{ $office->latitude }}">
                                <h4 class="title-l">{{ $office->title }}</h4>
                                <div class="flex-col gap-2">
                                    <p class="title-sm-green">Адрес</p>
                                    <b href="{{ $office->address }}">
                                        {{ $office->address }}
                                    </b>
                                </div>
                                <div class="flex-col gap-2">
                                    <p class="title-sm-green">Номер телефона</p>
                                    <a href="tel: {{ $office->phone }}">
                                        {{ $office->phone }}
                                    </a>
                                </div>

                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="points_container_map">
                <div id="full_map" style="width: 100%; height: 500px"></div>

                <script src="https://api-maps.yandex.ru/2.1/?apikey=4b6d1d89-f216-4344-babf-f343d1965770&lang=ru_RU"
                    type="text/javascript"></script>

                <script type="text/javascript">
                    const offices = [];
                    @foreach ($branch_offices as $index => $office)
                        offices[{{ $index }}] = ({
                            title: '{{ $office->title }}',
                            companyName: '{{ $office->user->company_name }} {{ $office->title }}',
                            phone: '{{ $office->phone }}',
                            address: '{{ $office->address }}',
                            latitude: '{{ $office->latitude }}',
                            longitude: '{{ $office->longitude }}'
                        });
                    @endforeach
                    ymaps.ready(init);

                    function init() {

                        const myPlacemark = null;
                        const myMap = new ymaps.Map('full_map', {
                            center: [49.80, 73.10],
                            zoom: 4
                            
                        }, {
                            searchControlProvider: 'yandex#search'
                        });
                        const geoObjects = offices.map(({
                            title,
                            companyName,
                            phone,
                            address,
                            latitude,
                            longitude
                        }) => (
                            new ymaps.GeoObject({
                                geometry: {
                                    type: "Point",
                                    coordinates: [latitude, longitude],
                                },
                                properties: {
                                    clusterCaption: title,
                                    balloonContentHeader: companyName,
                                    balloonContentBody: phone,
                                    balloonContentFooter: address,
                                }
                            }, {
                                // preset: 'islands#blueDotIcon',
                                iconLayout: 'default#image',
                                iconImageHref: '/img/marker.svg',
                                icon_imagesize: [25, 31],
                                iconImageOffset: [-17, -40],
                                draggable: false
                            })
                        ));

                        // Создание кластера и запрещение масштабирования карты при щелчке по кластеру
                        const clusterer = new ymaps.Clusterer({
                            clusterDisableClickZoom: true,
                            clusterIcons: [{
                                href: '/img/icon/clusterIcons.svg',
                                size: [50, 50],
                                offset: [-25, -25]
                            }, ],

                        });
                        clusterer.add(geoObjects);
                        myMap.geoObjects.add(clusterer);

                        const inputSearch = document.querySelector('#search_points_input');
                        const onSearch = document.querySelector('.search_butn');
                        const officesDiv = document.querySelector('#scroll .content');

                        inputSearch.oninput = function() {
                            const query = inputSearch.value.toLocaleLowerCase();
                            const filtered = offices.filter(({
                                address,
                                companyName
                            }) => (address.toLocaleLowerCase().includes(query) || companyName.toLocaleLowerCase()
                                .includes(query)));
                            renderOffices(filtered);
                        };

                        onSearch.addEventListener('click', () => {
                            officesDiv.scrollIntoView();
                        });

                        officesDiv.addEventListener('click', (event) => {
                            const target = event.target;
                            const point = event.target.closest('.points-item.flex-col');
                            if (point) {
                                const {
                                    longitude,
                                    latitude
                                } = point.dataset;
                                myMap.setCenter([+latitude, +longitude], 17);
                            }
                        });

                        function renderOffices(offices) {
                            const html = offices.map(({
                                title,
                                address,
                                phone,
                                longitude,
                                latitude
                            }) => (
                                `<div class="points-item flex-col" data-longitude="${longitude}" data-latitude="${latitude}" >
                                <h4 class="title-l">${title}</h4>
                                <div class="flex-col gap-2">
                                    <p class="title-sm-green">Адрес</p>
                                <b href="#!">
                                        ${address}
                                    </b>
                                </div>
                                <div class="flex-col gap-2">
                                    <p class="title-sm-green">Номер телефона</p>
                                    <a href="tel: ${phone}">
                                        ${phone}
                                    </a>
                                </div>
                            </div>`)).join('');
                            officesDiv.innerHTML = html;

                            if(html == ''){
                                officesDiv.innerHTML = 'Ничего не найдено';
                            }
                        }

                    }
                </script>
            </div>

        </div>
    </div>

@section('footerScripts')
    @parent

    <script src="{{ asset('js/points-sale.js') }}"></script>
@endsection

@include('site.sections.ask')
@endsection
