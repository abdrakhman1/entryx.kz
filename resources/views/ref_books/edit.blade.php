@extends('layouts.app')

@section('content')
    <h1 class="admin_title title-p">Изменение справочника</h1>

    <div class="card_wrapper">
        <form class="" method="POST" action="/refbooks/update">
            @csrf

            <div class="mb-3">
                <label for="title" class="form-label">Название:</label>
                <input type="text" class="form-control" name="title" id="title" value="{{ $ref_book->title }}">
                @error('title')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3">
                <label for="order" class="form-label">Порядок:</label>
                <input type="number" class="form-control" name="order" id="order" value="{{ $ref_book->order }}">
                @error('order')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
                <div class="form-text">Порядковый номер для отображения в списке. По умолчанию равен нулю.</div>
            </div>

            <input type="hidden" name="id" value="{{ $ref_book->id }}">


            <div class="col-md-12">
                <button type="submit" value="Save" class="accept_button btn btn_primary button_width">Сохранить</button>
            </div>

        </form>
    </div>
    
@stop