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
                <button class="butn-exit"><img src="/img/icon/exit.svg" alt=""></button>
                {{-- </h2> --}}
            </div>

            <div class="accordion-item show-mobile">
                <h2 class="accordion-header" id="heading-sort">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapse-sort" aria-expanded="true" aria-controls="collapse-sort">
                        Сортировка
                    </button>
                </h2>
                
                <div id="collapse-sort" class="accordion-collapse collapse" aria-labelledby="heading-sort">
                    <div class="accordion-body">
                        @if ($isshop)
                        <a class='sort__link' href="/portal/catalog?orderby=price&direction=desc">Цена: по убыванию</a>
                        <a class='sort__link' href="/portal/catalog?orderby=price&direction=asc">Цена: по возрастанию</a>
                        <a class='sort__link' href="?">Порядок: по умолчанию</a>
                        <a class='sort__link' href="/portal/catalog?orderby=created_at&direction=desc">Порядок: сперва новые</a>
                        <a class='sort__link' href="/portal/catalog?orderby=created_at&direction=asc">Порядок: сперва старые</a>
                        @else
                        <a class='sort__link' href="?">Порядок: по умолчанию</a>
                        <a class='sort__link' href="/portal/catalog?orderby=created_at&direction=desc">Порядок: сперва новые</a>
                        <a class='sort__link' href="/portal/catalog?orderby=created_at&direction=asc">Порядок: сперва старые</a>
                        @endif
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

                {{-- фильтрация для портала --}}

                <form action="{{ route('portal.catalog.filter') }}" method="post">
                    @csrf
    
                    @foreach ($filter_data as $propertyId => $values)
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#proprty_{{ $propertyId }}" aria-expanded="true"
                                    aria-controls="proprty_{{ $propertyId }}">
                                    {{ $values[0]->property->title }}
                                </button>
                            </h2>
    
                            <div id="proprty_{{ $propertyId }}" class="accordion-collapse collapse"
                                aria-labelledby="headingOne">
                                <div class="accordion-body">
    
                                    @foreach ($values as $index => $value)
                                        @if ($value->value)
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="{{ $value->value }}"
                                                    id="prop_{{ $propertyId }}_{{ $index }}"
                                                    name="prop[{{ $propertyId }}][{{ $index }}]" />
                                                <label class="form-check-label"
                                                    for="prop_{{ $propertyId }}_{{ $index }}">
                                                    {{ $value->value }}
                                                </label>
                                            </div>
                                        @endif
                                    @endforeach
    
                                </div>
                            </div>
    
                        </div>
                    @endforeach
    
                    <input type="hidden" name="hidden" value="111">
    
                    <button class="butn butn__open m_w-100">Применить</button>
                    <a href="{{route('portal.catalog.index')}}" class="butn-reset m_w-100">Сбросить все фильтры</a>
                </form>
            @else

            {{-- фильтрация для каталога --}}

            <form action="{{ route('catalog.filter') }}" method="post">
                @csrf

                @foreach ($filter_data as $propertyId => $values)
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingOne">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#proprty_{{ $propertyId }}" aria-expanded="true"
                                aria-controls="proprty_{{ $propertyId }}">
                                {{ $values[0]->property->title }}
                            </button>
                        </h2>

                        <div id="proprty_{{ $propertyId }}" class="accordion-collapse collapse"
                            aria-labelledby="headingOne">
                            <div class="accordion-body">

                                @foreach ($values as $index => $value)
                                    @if ($value->value)
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="{{ $value->value }}"
                                                id="prop_{{ $propertyId }}_{{ $index }}"
                                                name="prop[{{ $propertyId }}][{{ $index }}]" />
                                            <label class="form-check-label"
                                                for="prop_{{ $propertyId }}_{{ $index }}">
                                                {{ $value->value }}
                                            </label>
                                        </div>
                                    @endif
                                @endforeach

                            </div>
                        </div>

                    </div>
                @endforeach

                <input type="hidden" name="hidden" value="111">

                <button class="butn butn__open m_w-100">Применить</button>
                <a href="/catalog" class="butn-reset m_w-100">Сбросить все фильтры</a>
            </form>
            @endif

            
        </div>
    </div>
</div>
