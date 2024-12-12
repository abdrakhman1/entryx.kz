@extends('layouts.app')
@section('head')
    @parent
    <link rel="stylesheet" href="{{ asset('css/reset.css') }}">
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2 class="admin_title title-p">Управление городами</h2>
                </div>
                <div class="pull-right">
                    <a class="btn btn_add" href="{{ route('admin.cities.create') }}">Создание городов</a>
                </div>
            </div>
        </div>

        <table class="admin_table table table-bordered">
            <thead>
                <tr>
                    <th>Название</th>
                    <th>Описание</th>
                    <th>Долгота</th>
                    <th>Широта</th>
                    <th width="280px">Действия</th>
                </tr>
            </thead>

            @foreach ($cities as $city)
                <tbody>
                    <tr>
                        <td>{{ $city->title }}</td>
                        <td>{{ $city->description }}</td>
                        <td>{{ $city->longitude }}</td>
                        <td>{{ $city->latitude }}</td>
                        <td>
                            <form action="{{ route('admin.cities.destroy', $city->id) }}" method="POST">

                                <a class="btn btn_info" href="{{ route('admin.cities.show', $city->id) }}">Show</a>

                                <a class="btn btn_primary" href="{{ route('admin.cities.edit', $city->id) }}">Edit</a>

                                @csrf
                                @method('DELETE')

                                <button type="submit" class="btn btn_danger" onclick="return confirm('Удалить?')"> Удалить</button>
                            </form>
                        </td>
                    </tr>
                </tbody>
            @endforeach
        </table>

        {{ $cities->links() }}

    </div>
@endsection
