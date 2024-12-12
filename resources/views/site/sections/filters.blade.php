@php
    $isshop = isset($isshop) ? $isshop : false;
@endphp

<div class="filters__container" data-role="page">
    <div class="filters">
        <div class="accordion" id="accordionPanelsStayOpenExample">

            <div class="accordion-item mobile-sort">
                {{-- <h2 class="accordion-header" id="heading-sort"> --}}
                <h4 class="black m0">Фильтры
                </h4>
                <button class="butn-exit"><img src="./img/icon/exit.svg" alt=""></button>
                {{-- </h2> --}}

            </div>

            <div class="accordion-item mobile-sort">
                <h2 class="accordion-header" id="heading-sort">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapse-sort" aria-expanded="true" aria-controls="collapse-sort">
                        Сортировка
                    </button>
                </h2>
                <div id="collapse-sort" class="accordion-collapse collapse  " aria-labelledby="heading-sort">
                    <div class="accordion-body">

                        <a class='sort__link' href="#!">Цена: по возрастанию</a>
                        <a class='sort__link' href="#!">Цена: по умолчанию</a>
                        <a class='sort__link' href="#!">Порядок: по умолчанию</a>
                        <a class='sort__link' href="#!">Порядок: сперва новые</a>
                        <a class='sort__link' href="#!">Порядок: сперва старые</a>

                    </div>
                </div>
            </div>

            @if ($isshop)
                <div class="accordion-item">
                    <h2 class="accordion-header" id="panelsStayOpen-headingTwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false"
                            aria-controls="panelsStayOpen-collapseTwo">
                            Цена
                        </button>
                    </h2>
                    <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse"
                        aria-labelledby="panelsStayOpen-headingTwo">
                        <div class="accordion-body accordion-body--price">
                            <p>
                            <div class="filter-price" id="amount"></div>
                            </p>

                            <div>
                                <div id="slider-range"></div>
                            </div>
                        </div>

                    </div>
                </div>
            @else
            @endif


            <div class="accordion-item">
                <h2 class="accordion-header" id="headingOne">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        Размер
                    </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne">
                    <div class="accordion-body">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="sizeOne" />
                            <label class="form-check-label" for="sizeOne">
                                860х2050; 960х2050
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="sizeTwo" />
                            <label class="form-check-label" for="sizeTwo">
                                870х2050; 970х2050
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="sizeTree" />
                            <label class="form-check-label" for="sizeTree">
                                1200х2050
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingContour">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseContour" aria-expanded="false" aria-controls="collapseContour">
                        Количество контуров уплотнения
                    </button>
                </h2>
                <div id="collapseContour" class="accordion-collapse collapse" aria-labelledby="headingContour">
                    <div class="accordion-body">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="contourOne" />
                            <label class="form-check-label" for="contourOne">
                                1 контур
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="contourTwo" />
                            <label class="form-check-label" for="contourTwo">
                                2 контура
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="contourTree" />
                            <label class="form-check-label" for="contourTree">
                                3 контура
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="panelsStayOpen-headingFour">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#panelsStayOpen-collapseFour" aria-expanded="true"
                        aria-controls="panelsStayOpen-collapseFour">
                        Наполнитель
                    </button>
                </h2>
                <div id="panelsStayOpen-collapseFour" class="accordion-collapse collapse"
                    aria-labelledby="panelsStayOpen-headingFour">
                    <div class="accordion-body">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="mineralPlate" />
                            <label class="form-check-label" for="mineralPlate">
                                Минеральная плита
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="basaltPlate" />
                            <label class="form-check-label" for="basaltPlate">
                                Базальтовая плита
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="styrofoam" />
                            <label class="form-check-label" for="styrofoam">
                                Пенополистерол
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="panelsStayOpen-headingFive">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#panelsStayOpen-collapseFive" aria-expanded="true"
                        aria-controls="panelsStayOpen-collapseFive">
                        Основной замок
                    </button>
                </h2>
                <div id="panelsStayOpen-collapseFive" class="accordion-collapse collapse"
                    aria-labelledby="panelsStayOpen-headingFive">
                    <div class="accordion-body">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="guardian3211" />
                            <label class="form-check-label" for="guardian3211">
                                Гардиан 3211
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="kale252" />
                            <label class="form-check-label" for="kale252">
                                Кале 252
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="guardian2514" />
                            <label class="form-check-label" for="guardian2514">
                                Гардиан 2514
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="galleon811" />
                            <label class="form-check-label" for="galleon811">
                                Галеон 811
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="guardian32-15" />
                            <label class="form-check-label" for="guardian32-15">
                                Гардиан 32.15
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="border3b-k5" />
                            <label class="form-check-label" for="border3b-k5">
                                Border 3b-8-6/K5
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="galleon816" />
                            <label class="form-check-label" for="galleon816">
                                Галеон 816
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="guardian30-11" />
                            <label class="form-check-label" for="guardian30-11">
                                Гардиан 30.11
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="kale" />
                            <label class="form-check-label" for="kale"> KALE </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="guardian30-15" />
                            <label class="form-check-label" for="guardian30-15">
                                Гардиан 30.15
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="border3b-13" />
                            <label class="form-check-label" for="border3b-13">
                                Border 3B 8-8X/13
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="suvaldny" />
                            <label class="form-check-label" for="suvaldny">
                                Сувальдный ПРОсам
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="panelsStayOpen-headingSix">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#panelsStayOpen-collapseSix" aria-expanded="true"
                        aria-controls="panelsStayOpen-collapseSix">
                        Дополнительный замок
                    </button>
                </h2>
                <div id="panelsStayOpen-collapseSix" class="accordion-collapse collapse"
                    aria-labelledby="panelsStayOpen-headingSix">
                    <div class="accordion-body">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="guardian3001" />
                            <label class="form-check-label" for="guardian3001">
                                Гардиан 3001
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="kale257" />
                            <label class="form-check-label" for="kale257">
                                Кале 257
                            </label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="kale-d" />
                            <label class="form-check-label" for="kale-d">
                                KALE
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="border-3b8-6k5" />
                            <label class="form-check-label" for="border-3b8-6k5">
                                Border 3b8-6k5
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="galleon812" />
                            <label class="form-check-label" for="galleon812">
                                Галеон 812
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="border3b4-3" />
                            <label class="form-check-label" for="border3b4-3">
                                Border 3b4-3/85Г
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="galleon817" />
                            <label class="form-check-label" for="galleon817">
                                Галеон 817
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="panelsStayOpen-headingSeven">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#panelsStayOpen-collapseSeven" aria-expanded="true"
                        aria-controls="panelsStayOpen-collapseSeven">
                        Толщина полотна
                    </button>
                </h2>
                <div id="panelsStayOpen-collapseSeven" class="accordion-collapse collapse"
                    aria-labelledby="panelsStayOpen-headingSeven">
                    <div class="accordion-body">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="thick50" />
                            <label class="form-check-label" for="thick50">
                                50 мм
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="thick60" />
                            <label class="form-check-label" for="thick60">
                                60 мм
                            </label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="thick70" />
                            <label class="form-check-label" for="thick70">
                                70 мм
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="thick80" />
                            <label class="form-check-label" for="thick80">
                                80 мм
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="thick90" />
                            <label class="form-check-label" for="thick90">
                                90 мм
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="thick95" />
                            <label class="form-check-label" for="thick95">
                                95 мм
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="thick100" />
                            <label class="form-check-label" for="thick100">
                                100 мм
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="thick105" />
                            <label class="form-check-label" for="thick105">
                                105 мм
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="thick115" />
                            <label class="form-check-label" for="thick115">
                                115 мм
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="thick120" />
                            <label class="form-check-label" for="thick120">
                                120 мм
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="thick125 " />
                            <label class="form-check-label" for="thick125 ">
                                125 мм
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="thick131 " />
                            <label class="form-check-label" for="thick131 ">
                                131 мм
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="panelsStayOpen-headingdeepBox">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#panelsStayOpen-collapseDeepBox" aria-expanded="true"
                        aria-controls="panels-collapseDeepBox">
                        Глубина короба
                    </button>
                </h2>
                <div id="panelsStayOpen-collapseDeepBox" class="accordion-collapse collapse"
                    aria-labelledby="panelsStayOpen-headingdeepBox">
                    <div class="accordion-body">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="depth120" />
                            <label class="form-check-label" for="depth120">
                                120 мм
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="depth135" />
                            <label class="form-check-label" for="depth135">
                                135 мм
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="depth140" />
                            <label class="form-check-label" for="depth140">
                                140 мм
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="depth145" />
                            <label class="form-check-label" for="depth145">
                                145 мм
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="depth150" />
                            <label class="form-check-label" for="depth150">
                                150 мм
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="depth160" />
                            <label class="form-check-label" for="depth160">
                                160 мм
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="depth165" />
                            <label class="form-check-label" for="depth165">
                                165 мм
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="panelsStayOpen-headingEight">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#panelsStayOpen-collapseEight" aria-expanded="true"
                        aria-controls="panelsStayOpen-collapseEight">
                        Цвет полимерного покрытия
                    </button>
                </h2>
                <div id="panelsStayOpen-collapseEight" class="accordion-collapse collapse"
                    aria-labelledby="panelsStayOpen-headingEight">
                    <div class="accordion-body">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="plasterGraphite" />
                            <label class="form-check-label" for="plasterGraphite">
                                Штукатурка графит
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="sofAnthracite" />
                            <label class="form-check-label" for="sofAnthracite">
                                Антрацит соф
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="darkMarble" />
                            <label class="form-check-label" for="darkMarble">
                                Мрамор темный
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="wengeTransverse" />
                            <label class="form-check-label" for="wengeTransverse">
                                Венге поперечный
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="ashGraphite" />
                            <label class="form-check-label" for="ashGraphite">
                                Ясень графит
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="quartzBlack" />
                            <label class="form-check-label" for="quartzBlack">
                                Кварц черный
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="alberoNoche" />
                            <label class="form-check-label" for="alberoNoche">
                                Альберо ноче
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="wenge" />
                            <label class="form-check-label" for="wenge">
                                Венге
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="softGray" />
                            <label class="form-check-label" for="softGray">
                                Софт серый
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="concreteDark" />
                            <label class="form-check-label" for="concreteDark">
                                Бетон темный
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="antiqueSilver" />
                            <label class="form-check-label" for="antiqueSilver">
                                Антик серебро
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="satinBlack" />
                            <label class="form-check-label" for="satinBlack">
                                Сатин черный
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="antiqueCopper" />
                            <label class="form-check-label" for="antiqueCopper">
                                Медь-антик
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="boucleDarkGrey" />
                            <label class="form-check-label" for="boucleDarkGrey">
                                Букле темно-серый
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="boucleBlack" />
                            <label class="form-check-label" for="boucleBlack">
                                Букле черный
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="matteShagreen" />
                            <label class="form-check-label" for="matteShagreen">
                                Шагрень матовая
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="silverOnBlack" />
                            <label class="form-check-label" for="silverOnBlack">
                                Серебро на черном
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="panelsStayOpen-headingNine">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#panelsStayOpen-collapseNine" aria-expanded="true"
                        aria-controls="panelsStayOpen-collapseNine">
                        Цвет внутренней панели
                    </button>
                </h2>
                <div id="panelsStayOpen-collapseNine" class="accordion-collapse collapse"
                    aria-labelledby="panelsStayOpen-headingNine">
                    <div class="accordion-body">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="whiteSoft" />
                            <label class="form-check-label" for="whiteSoft">
                                Белый софт
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="whiteMatte" />
                            <label class="form-check-label" for="whiteMatte">
                                Белый матовый
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="concreteLight" />
                            <label class="form-check-label" for="concreteLight">
                                Бетон светлый
                            </label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="ashWhite" />
                            <label class="form-check-label" for="ashWhite">
                                Ясень белый
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="quartzBlack-v" />
                            <label class="form-check-label" for="quartzBlack-v">
                                Кварц черный
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="whiteCanvas" />
                            <label class="form-check-label" for="whiteCanvas">
                                Холст белый
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value=""
                                id="creamPhiladelphiaOak " />
                            <label class="form-check-label" for="creamPhiladelphiaOak">
                                Дуб филадельфия крем
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="nutDark" />
                            <label class="form-check-label" for="nutDark">
                                Орех темный
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="iceSoft" />
                            <label class="form-check-label" for="iceSoft">
                                Софт айс
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="loftbeigeConcrete" />
                            <label class="form-check-label" for="loftbeigeConcrete">
                                Бетон лофт бежевый
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value=""
                                id="horizontalOakArctic" />
                            <label class="form-check-label" for="horizontalOakArctic">
                                Дуб арктик горизонтальный
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="pacificOakArctic" />
                            <label class="form-check-label" for="pacificOakArctic">
                                Дуб пацифик горизонтальный
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="bleached-DarkOak" />
                            <label class="form-check-label" for="bleached-DarkOak">
                                Дуб темный, дуб беленый
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="whiteNP" />
                            <label class="form-check-label" for="whiteNP">
                                Белый НП
                            </label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="polarOakNP" />
                            <label class="form-check-label" for="polarOakNP">
                                Дуб полярный НП
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="antiqueCopper-v" />
                            <label class="form-check-label" for="antiqueCopper-v">
                                Медь-антик
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="nutMilanese" />
                            <label class="form-check-label" for="nutMilanese">
                                Миланский орех
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="panelsStayOpen-headingTen">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#panelsStayOpen-collapseTen" aria-expanded="true"
                        aria-controls="panelsStayOpen-collapseTen">
                        Фурнитура
                    </button>
                </h2>
                <div id="panelsStayOpen-collapseTen" class="accordion-collapse collapse"
                    aria-labelledby="panelsStayOpen-headingTen">
                    <div class="accordion-body">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="peep" />
                            <label class="form-check-label" for="peep">
                                Глазок
                            </label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="klyuchevina" />
                            <label class="form-check-label" for="klyuchevina">
                                Ключевина
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="liningArmor" />
                            <label class="form-check-label" for="liningArmor">
                                Броненакладка
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="latch" />
                            <label class="form-check-label" for="latch">
                                Задвижка
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="eccentric" />
                            <label class="form-check-label" for="eccentric">
                                Эксцентрик
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <button class="butn butn__open m_w-100">Применить</button>
    <a href="/catalog" class="butn-reset m_w-100">Сбросить все фильтры</a>
</div>
