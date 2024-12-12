@extends('layouts.app')

@section('content')
    <h1 class="admin_title title-p">Новый справочник</h1>

    <div class="card_wrapper">
        <form class="" method="POST" action="/refbooks/store">
            @csrf

            <div class="mb-3">
                <label for="title" class="form-label">Название:</label>
                <input type="text" class="form-control" name="title" id="title" value="{{ old('title') }}">
                @error('title')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3">
                <label for="alias" class="form-label">Машинное имя (на английском):</label>
                <input type="text" class="form-control" name="alias" id="alias" value="{{ old('alias') }}">
                @error('alias')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3">
                <label for="" class="form-label">Описание:</label>
                <input type="text" class="form-control" name="description" id="description" value="{{ old('description') }}">
                @error('description')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3">
                <label for="order" class="form-label">Порядок:</label>
                <input type="number" class="form-control" name="order" id="order" value="{{ old('order') }}">
                @error('order')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
                <div class="form-text">Порядковый номер для отображения в списке. По умолчанию равен нулю.</div>
            </div>

            <div class="mb-3">
                <label for="parent_id" class="form-label">Родительский справочник:</label>
                <select class="form-select" id="parent_id" name="parent_id" aria-label="">
                    <option value="0" selected>-- без справочника --- </option>
                        @foreach ($ref_books as $item)
                            <option 
                                value="{{ $item->id }}"
                            >{{ $item->title }}</option>
                        @endforeach
                </select>
                        
                @error('city')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            Параметры:
            <div class="card mb-3">
                <div class="card-body">
                    <div class="row">
                        <div class="col-auto" id="options_list">
                            <input type="text" class="form-control" name="option[]" id="option" value="">
                        </div>
                        <div class="col-auto">
                            <button class="btn btn-primary" id="add_option">+</button>
                        </div>
                    </div>
                    
                    
                </div>
            </div>

            
            <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox" value="true" id="visible" name="visible" checked>
                <label class="form-check-label" for="visible">
                    Видимый
                </label>
            </div>


            <div class="col-md-12">
                <button type="submit" value="Save" class="accept_button btn btn_primary button_width">Создать</button>
            </div>

        </form>
    </div>
    
@stop