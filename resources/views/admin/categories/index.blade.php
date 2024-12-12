@extends('layouts.app')
@section('head')
    @parent
    <link rel="stylesheet" href="{{ asset('css/reset.css') }}">
@endsection
@section('content')
    <div class="container">
        <div class="row">
                <div class="pull-left">
                    <h2 class="admin_title title-p">Категории</h2>
                </div>
                <div class="pull-right">
                    <a class="btn btn_add" href="{{ route('categories.create') }}">Создать категорию</a>
                </div>
        </div>

        <table class="table admin_table">
            <thead>
                <tr>
                    <th>№</th>
                    <th>Название</th>
                    <th>Действия</th>
                </tr>
            </thead>
            
            @foreach ($categories as $category)
            <tbody>
                <tr>
                    <td>{{ $category->id }}</td>
                    <td>{{ $category->title }}</td>
                    <td>
                        <form action="{{ route('categories.destroy',$category->id) }}" method="POST">
                            <a class="btn btn_info" href="{{ route('categories.show',$category->id) }}">Show</a>
                            <a class="btn btn_primary" href="{{ route('categories.edit',$category->id) }}">Edit</a>
                            @csrf
                            @method('DELETE')
                            <button 
                                type="submit" 
                                class="btn btn_danger" 
                                onclick="return confirm('Удалить?')"
                            >
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
            </tbody>
            
            @endforeach
        </table>

        {!! $categories->links() !!}
    </div>  
@endsection
