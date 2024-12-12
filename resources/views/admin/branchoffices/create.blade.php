@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2 class="admin_title title-p">Создание точки продаж</h2>
                </div>
                <div class="pull-right">
                    <a class="btn btn_back" href="{{ route('admin.dealers.show', ['dealer' => $dealer->id]) }}">
                        <img src="{{ asset('img/arrows-left.svg') }}" alt="">
                        Назад</a>
                </div>
            </div>
        </div>


        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('admin.branchoffices.store', [$dealer->id]) }}">
            @csrf
            <div class="form_admin form_admin-l ">
                <div class="flex gap-4">
                    <div class="form_admin info_box">
                        <div class="form-group ">
                            <label for="title">Название</label>
                            <input id="title" type="text"
                                class="form-control @error('title') is-invalid @enderror" name="title"
                                value="{{ old('title') }}" required autocomplete="title" autofocus>

                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                        </div>

                        <div class="form-group">
                            <label for="phone">Телефон</label>

                            <input id="phone" type="text"
                                class="form-control @error('phone') is-invalid @enderror" name="phone"
                                value="{{ old('phone') }}" required autocomplete="phone" autofocus>

                            @error('phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                        </div>

                        <div class="form-group">
                            <label for="address">Адрес</label>

                            <input id="address" type="text"
                                class="form-control 
                                @error('address') is-invalid @enderror"
                                name="address" value="{{ old('address') }}" required autocomplete="address">

                            @error('address')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                        </div>

                        <div class="form-group">
                            <label for="description">Описание</label>

                            <input id="description" type="text"
                                class="form-control @error('description') is-invalid @enderror" name="description"
                                autocomplete="description">

                            @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="flex gap-3 ">
                            <div class="form-group ">
                                <label for="latitude">Широта (координаты) </label>

                                <input id="latitude" type="number" step="any" class="form-control" name="latitude"
                                    required autocomplete="latitude">
                            </div>
                            <div class="form-group ">
                                <label for="latitude">Долгота (координаты)</label>

                                <input id="longitude" type="number" step="any" class="form-control" name="longitude"
                                    required autocomplete="longitude">
                            </div>
                        </div>
                        <button type="submit" class="btn btn_add">
                            Добавить
                        </button>

                    </div>









                    <div class="map_points">

                        <div id="map" style="width: 100%; height: 500px"></div>


                        <script src="https://api-maps.yandex.ru/2.1/?apikey=03997265-6c97-4ebc-9605-ee6a0a1acc83&lang=ru_RU"
                            type="text/javascript"></script>

                        <script type="text/javascript">
                            ymaps.ready(init);

                            function init() {
                                // Создание карты.
                                // var myMap = new ymaps.Map("map", {
                                //     // Координаты центра карты.
                                //     // Порядок по умолчанию: «широта, долгота».
                                //     // Чтобы не определять координаты центра карты вручную,
                                //     // воспользуйтесь инструментом Определение координат.
                                //     center: [55.76, 37.64],
                                //     // Уровень масштабирования. Допустимые значения:
                                //     // от 0 (весь мир) до 19.
                                //     zoom: 7
                                // });

                                var myPlacemark,
                                    myMap = new ymaps.Map('map', {
                                        center: [49.81, 73.10],
                                        zoom: 9
                                    }, {
                                        searchControlProvider: 'yandex#search'
                                    });

                                myMap.events.add('click', function(e) {
                                    var coords = e.get('coords');

                                    // Если метка уже создана – просто передвигаем ее.
                                    if (myPlacemark) {
                                        myPlacemark.geometry.setCoordinates(coords);
                                    }
                                    // Если нет – создаем.
                                    else {
                                        myPlacemark = createPlacemark(coords);
                                        myMap.geoObjects.add(myPlacemark);
                                        // Слушаем событие окончания перетаскивания на метке.
                                        myPlacemark.events.add('dragend', function() {
                                            getAddress(myPlacemark.geometry.getCoordinates());
                                        });
                                    }
                                    getAddress(coords);
                                });

                                // Создание метки.
                                function createPlacemark(coords) {
                                    return new ymaps.Placemark(coords, {
                                        iconCaption: 'поиск...'
                                    }, {
                                        preset: 'islands#blueDotIcon',
                                        draggable: true
                                    });
                                }

                                // Определяем адрес по координатам (обратное геокодирование).
                                function getAddress(coords) {
                                    myPlacemark.properties.set('iconCaption', 'поиск...');
                                    ymaps.geocode(coords).then(function(res) {
                                        var firstGeoObject = res.geoObjects.get(0);
                                        // console.log(firstGeoObject);
                                        console.log(firstGeoObject.properties._data.metaDataProperty.GeocoderMetaData.text);
                                        // console.log(firstGeoObject.geometry._coordinates[0]);
                                        // var city_name = firstGeoObject.properties._data.metaDataProperty.GeocoderMetaData.AddressDetails.Country.AdministrativeArea.Locality.LocalityName
                                        // document.getElementById('address').value = city_name + ', ' + firstGeoObject.properties._data.name;
                                        document.getElementById('address').value = firstGeoObject.properties._data.metaDataProperty
                                            .GeocoderMetaData.text.replaceAll("Казахстан, ", "");
                                        document.getElementById('latitude').value = firstGeoObject.geometry._coordinates[0];
                                        document.getElementById('longitude').value = firstGeoObject.geometry._coordinates[1];
                                        // firstGeoObject.geometry._coordinates[1];
                                        myPlacemark.properties
                                            .set({
                                                // Формируем строку с данными об объекте.
                                                iconCaption: [
                                                    // Название населенного пункта или вышестоящее административно-территориальное образование.
                                                    firstGeoObject.getLocalities().length ? firstGeoObject.getLocalities() :
                                                    firstGeoObject.getAdministrativeAreas(),
                                                    // Получаем путь до топонима, если метод вернул null, запрашиваем наименование здания.
                                                    firstGeoObject.getThoroughfare() || firstGeoObject.getPremise()
                                                ].filter(Boolean).join(', '),
                                                // В качестве контента балуна задаем строку с адресом объекта.
                                                balloonContent: firstGeoObject.getAddressLine()
                                            });
                                    });
                                }

                            }
                        </script>


                    </div>

                </div>



            </div>
        </form>

    </div>
@endsection
