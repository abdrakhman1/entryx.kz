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
                    <h2 class="admin_title title-p">Управление пользователями</h2>
                </div>
                <div class="pull-right">
                    <a class="btn btn_add" href="{{ route('admin.users.create') }}">Создание пользователя</a>
                </div>
            </div>
        </div>

        <table class="admin_table table table-bordered">
            <thead>
                <tr>
                    <th>№</th>
                    <th>Имя</th>
                    <th>Email</th>
                    <th>Роль</th>
                    <th>Опции</th>
                    <th>Срок действия</th>
                    <th width="280px">Действия</th>
                </tr>
            </thead>

            @foreach ($users as $user)
                <tbody>
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            @if ($user->role)
                                {{ $user->role->name }}
                            @else  
                                <i>не указано</i>
                            @endif
                        </td>
                        <td>{{ $user->options }}</td>
                        <td>{{ $user->expiration_date }}</td>
                        <td>
                            <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST">

                                <a class="btn btn_info" href="{{ route('admin.users.show', $user->id) }}">Show</a>

                                <a class="btn btn_primary" href="{{ route('admin.users.edit', $user->id) }}">Edit</a>

                                @csrf
                                @method('DELETE')

                                <button type="submit" class="btn btn_danger" onclick="return confirm('Удалить?')"> Удалить</button>
                            </form>
                        </td>
                    </tr>
                </tbody>
            @endforeach
        </table>

        {!! $users->links() !!}

    </div>
@endsection
