@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            111
            <form action="/admin/products/try_filter_submit" method="GET">
                {{-- @foreach ($allPropertyValues as $value)
                    @if ($value->parentValue)
                        <label>
                            <input type="checkbox" name="property_values[]" value="{{ $value->id }}">
                            {{ $value->property->title }}: {{ $value->parentValue->value }} - {{ $value->value }}
                        </label>
                    @else
                        <label>
                            <input type="checkbox" name="property_values[]" value="{{ $value->id }}">
                            {{ $value->property->title }}: {{ $value->value }}
                        </label>
                    @endif
                @endforeach

                _____

                @foreach ($allPropertyValues as $value)
                    {{ $value->value }} <br>
                @endforeach --}}


                @foreach ($propertyValuesGrouped as $propertyId => $values)
                    <label>{{ $values[0]->property->title }}</label>
                    @foreach ($values as $value)
                        <label>
                            <input type="checkbox" name="property_values[]" value="{{ $value->id }}">
                            {{ $value->value }}
                        </label>
                    @endforeach
                    <br>
                @endforeach


                <button type="submit">Apply Filter</button>
            </form>
        </div>
    </div>
@endsection
