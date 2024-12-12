@extends('layouts.app')

@section('content')
    <h1 class="admin_title title-p">{{ $book->title }}</h1>

    @if ($book->description != null)
        <p><b>Описание:</b> {{ $book->description }} </p>
    @endif

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/refbooks">Справочники</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $book->title }}</li>
        </ol>
    </nav>

    <div class="mb-3">
        <a href="/refitems/{{ $book->id }}/add" class="btn btn-primary">Добавить элемент</a>
    </div>

        <div class="card_wrapper">
        <table class="admin_table table table-striped table-hover shadow-sm">
            <thead>
                <tr>
                <th scope="col">ID</th>
                <th scope="col">Название</th>
                <th scope="col">Управление</th>
                </tr>
            </thead>

            <tbody>
    
                @foreach ($items as $item)
                    <tr>
                        <th scope="row">{{ $item->id }}</th>
                        <td>{{ $item->title }}</td>
                        <td> 
                            <a href="/refitems/{{ $item->id }}" class="btn btn-primary btn"><i class="bi bi-eye"></i></a>
                            <a href="/refitems/{{ $item->id }}/edit" class="btn btn-primary btn"><i class="bi bi-pencil"></i></a>
                        </td>
                    </tr>
                @endforeach

        </table>

        @if ($items == [])
            <i>Пустой справочник</i>
        @endif
    
@stop