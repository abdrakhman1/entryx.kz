@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2 class="admin_title title-p">Управление дилерами</h2>
                </div>
                <div class="pull-right">
                    <a class="btn btn_add" href="{{ route('admin.dealers.create') }}"> Создание дилера</a>
                </div>
            </div>
        </div>
        <table class="admin_table table">
            <thead>
                <tr>
                    <th>№</th>
                    <th>Имя</th>
                    <th>Email</th>
                    <th>Роль</th>
                    <th>Опции</th>
                    <th>Телефон</th>
                    <th width="280px">Действия</th>
                </tr>
            </thead>

            @foreach ($dealers as $dealer)
                <tbody>
                    <tr>
                        <td>{{ $dealer->id }}</td>
                        <td>{{ $dealer->name }}</td>
                        <td>{{ $dealer->email }}</td>
                        <td>{{ $dealer->role->name }}</td>
                        <td>{{ $dealer->options }}</td>
                        <td>{{ $dealer->phone }}</td>
                        <td>
                            <form action="{{ route('admin.dealers.destroy', $dealer->id) }}" method="POST">

                                <a class="btn btn_info" href="{{ route('admin.dealers.show', $dealer->id) }}">Точки продаж</a>

                                <a class="btn btn_primary" href="{{ route('admin.dealers.edit', $dealer->id) }}">Edit</a>

                                @csrf
                                @method('DELETE')

                                <button type="submit" class="btn btn_danger"
                                    onclick="return confirm('Удалить?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                </tbody>
            @endforeach
        </table>

        {!! $dealers->links() !!}
    </div>
@endsection
