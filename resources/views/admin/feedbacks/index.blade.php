@extends('layouts.app')
@section('head')
    @parent
    <link rel="stylesheet" href="{{ asset('css/reset.css') }}">
@endsection
@section('content')
    <div class="container">
        <h1 class="admin_title title-p">Заявки</h1>
        @if ($feedbacks->isEmpty())
            <p>Список заявок пуст.</p>
        @else
            <table class="table admin_table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Название</th>
                        <th>Телефон</th>
                        <th>Комментарий</th>
                        <th>Создан в</th>
                        <th>Прочитано</th>
                        <th>Действия</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($feedbacks as $feedback)
                        <tr>
                            <td>{{ $feedback->id }}</td>
                            <td>{{ $feedback->name }}</td>
                            <td>{{ $feedback->phone }}</td>
                            <td>
                                <div class="comment">{{ $feedback->message }}</div>
                            </td>
                            <td>@datetime($feedback->created_at)</td>
                            <td>@datetime($feedback->read_at) </td>
                            <td>
                                <a href="{{ route('admin.feedbacks.show', $feedback) }}" class="btn btn_info  ">View</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif

        {{ $feedbacks->links() }}

    </div>
@endsection
