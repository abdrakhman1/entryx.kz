@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-body">
        <h5 class="card_title">ID: {{ $feedback->id }}</h5>
        <p class="card-text"><strong>Имя:</strong> {{ $feedback->name }}</p>
        <p class="card-text"><strong>Email:</strong> {{ $feedback->email }}</p>
        <p class="card-text"><strong>Телефон:</strong> {{ $feedback->phone }}</p>
        <p class="card-text"><strong>Сообщение:</strong> {{ $feedback->message }}</p>
        <p class="card-text"><strong>Read at:</strong> {{ $feedback->read_at }}</p>
    </div>
</div>

    <div class="mt-3">
        <a href="{{ route('admin.feedbacks.index') }}" class="btn btn_back">Back to List</a>
    </div>
@endsection
