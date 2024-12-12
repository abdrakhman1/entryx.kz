@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2 class="admin_title title-p">Редактирование точки продаж</h2>
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

        <form
            action="{{ route('admin.branchoffices.update', ['dealer' => $dealer->id, 'branchoffice' => $branchoffice->id]) }}"
            method="POST">
            @csrf
            @method('PUT')

            <div class="form_admin form_admin-l">
                <div class="row">
                    <div class="flex ">
                        <div class="form-group_box">
                            <div class="form-group">
                                <label>Название</label>
                                <input type="text" name="title" value="{{ $branchoffice->title }}" class="form-control"
                                    placeholder="Title">
                            </div>

                            <div class="form-group">
                                <label>Телефон</label>
                                <input type="text" name="phone" value="{{ $branchoffice->phone }}" class="form-control"
                                    placeholder="Phone">
                            </div>

                            <div class="form-group">
                                <label for="address">Адрес</label>
                                <input type="text" id="address" name="address" value="{{ $branchoffice->address }}"
                                    class="form-control" placeholder="Address">
                            </div>

                            <div class="form-group">
                                <label>Описание</label>
                                <input type="text" name="description" value="{{ $branchoffice->description }}"
                                    class="form-control" placeholder="Description">
                            </div>

                            <div class="row gap-2">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="latitude">Широта (координаты) </label>
                                        <input type="text" id="latitude" name="latitude"
                                            value="{{ $branchoffice->latitude }}" class="form-control"
                                            placeholder="Latitude">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="latitude">Долгота (координаты)</label>
                                        <input type="text" id="longitude" name="longitude"
                                            value="{{ $branchoffice->longitude }}" class="form-control"
                                            placeholder="Longitude">
                                    </div>
                                </div>
                            </div>
                            <div>
                                <label for="is_visible">Показывать точку продаж в общем списке на сайте:</label>
                                <input type="checkbox" name="is_visible" id="is_visible" value="1" {{ $branchoffice->is_visible ? 'checked' : '' }}>
                            </div>
                            <button type="submit" class="btn btn_add">
                                Сохранить
                            </button>
                        </div>

                        <div id="map" style="width: 100%; height: 500px"></div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection




<script src="https://api-maps.yandex.ru/2.1/?apikey=4b6d1d89-f216-4344-babf-f343d1965770&lang=ru_RU"
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
                center: [{{ $branchoffice->latitude }}, {{ $branchoffice->longitude }}],
                zoom: 16
            }, {
                searchControlProvider: 'yandex#search'
            });

        var myGeoObject = new ymaps.GeoObject({
            geometry: {
                type: "Point", // тип геометрии - точка
                coordinates: [{{ $branchoffice->latitude }},
                    {{ $branchoffice->longitude }}
                ], // координаты точки
                preset: 'islands#blueDotIcon',
            }
        });

        myMap.geoObjects.add(myGeoObject);

        myMap.events.add('click', function(e) {
            var coords = e.get('coords');

            myMap.geoObjects.remove(myGeoObject);

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
