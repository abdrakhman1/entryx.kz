@extends('layouts.app')
@section('head')
    @parent
    <link rel="stylesheet" href="{{ asset('css/reset.css') }}">
@endsection
@section('content')
    <div class="container">
        <h1 class="admin_title title-p">Свойства товаров</h1>
        <a href="{{ route('admin.properties.create') }}" class="btn btn_add ">Создать свойство</a>
        <table class="table admin_table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Название</th>
                    <th>Категория</th>
                    <th>Действия</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($properties as $property)
                    <tr>
                        <td>{{ $property->id }}</td>
                        <td>{{ $property->title }}</td>
                        <td>{{ $property->category->title }}</td>
                        <td>
                            <a href="{{ route('admin.properties.show', $property) }}" class="btn btn_info btn-sm">View</a>
                            <a href="{{ route('admin.properties.edit', $property) }}" class="btn btn_primary btn-sm">Edit</a>
                            <form action="{{ route('admin.properties.destroy', $property) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn_danger btn-sm" onclick="return confirm('Are you sure you want to delete this post?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
