@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2 class="admin_title title-p"> Редактирование</h2>
                </div>
                <div class="pull-right">
                    <a class="btn btn_back" href="{{ route('admin.properties.index') }}"> 
                        <img src="{{asset('img/arrows-left.svg')}}" alt="">
                        Назад</a>
                </div>
            </div>
        </div> 
       

        <form class="form_admin" action="{{ route('admin.properties.update', $property) }}" method="POST">
            @csrf
            @method('PUT')

            {{-- <div class="mb-3"> --}}
                <div class="form-group">
                    <label for="title" class="form-label">Property Title:</label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" id="title" value="{{ old('title', $property->title) }}">
                </div>
               
                @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            {{-- </div> --}}

            {{-- <div class="mb-3"> --}}
                <div class="form-group">
                    <label for="category_id" class="form-label">Category:</label>
                <select class="form-select @error('category_id') is-invalid @enderror" name="category_id" id="category_id">
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" @if($category->id == $property->category_id) selected @endif>{{ $category->title }}</option>
                    @endforeach
                </select>
                </div>
                @error('category_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            {{-- </div> --}}

            <button type="submit" class="btn btn_add">Сохранить</button>
        </form>
    </div>
@endsection
