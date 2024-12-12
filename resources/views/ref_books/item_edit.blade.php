@extends('layouts.app')

@section('content')
    <h1 class="admin_title title-p">{{ $ref_item->title }}</h1>

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/refbooks">Справочники</a></li>
            <li class="breadcrumb-item"><a href="/refbooks/{{ $ref_item->book->id }}">{{ $ref_item->book->title }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $ref_item->title }}</li>
        </ol>
    </nav>

    <div class="card_wrapper">

        <form class="form_request" method="POST" action="/refitems/update">

            @csrf

            <div class="row mb-3">
                <div class="col-6">
                    <label for="" class="form-label">Название:</label>
                    <input type="text" class="form-control" name="title" id="title" value="{{ $ref_item->title }}" required>
                    @error('title')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="col-6">
                    <label for="" class="form-label">Описание:</label>
                    <input type="text" class="form-control" name="description" id="description" value="{{ $ref_item->description }}">
                    @error('description')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-6">
                    <label for="" class="form-label">Код:</label>
                    <input type="text" class="form-control" name="code" id="code" value="{{ $ref_item->code }}">
                    @error('title')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="col-6">
                    <label for="parent_id" class="form-label">Родительский элемент:</label>
                    <select class="form-select" id="parent_id" name="parent_id" aria-label="">
                        <option value="0" selected>-- без элемента --- </option>
                            @foreach ($ref_item->book->items as $item)
                                <option 
                                    value="{{ $item->id }}"
                                    @if ($ref_item->parent_id == $item->id)
                                        selected
                                    @endif
                                >{{ $item->title }}</option>
                            @endforeach
                    </select>
                            
                    @error('city')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            Параметры:
            <div class="card mb-3">
                <div class="card-body">
                    @foreach ($ref_item->options as $key => $value)
                        <div class="mb-3">
                            <label for="" class="form-label">{{ $key }}:</label>
                            <input type="text" class="form-control" name="items[{{ $key }}]" value="{{ $value }}">
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="form-check mb-3">
                <input 
                    class="form-check-input" 
                    type="checkbox" 
                    value="true" 
                    id="visible" 
                    name="visible"
                    @if ($ref_item->visible)
                        checked
                    @endif
                >
                <label class="form-check-label" for="visible">
                    Видимый
                </label>
            </div>
            

            <div class="col-md-12">

                <input type="hidden" name="item_id" value="{{ $ref_item->id }}">
        
                <button type="submit" value="Save" class="accept_button btn btn_primary button_width">Сохранить</button>
                
            </div>
            
        </form>

    </div>

@stop