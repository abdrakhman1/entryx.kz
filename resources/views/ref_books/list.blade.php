@extends('layouts.app')
@section('head')
    @parent
    <link rel="stylesheet" href="{{ asset('css/reset.css') }}">
@endsection
@section('content')
    <div class="container">
        <div class="d-flex">
            <div class="col">
                <h1 class="admin_title title-p">Справочники</h1>
    
                <div class="a_button mb-5">
                    <a href="/refbooks/new" class="btn btn_add  ">Добавить справочник</a>
                </div>
    
            </div>
            <div class="box-right">
    
            @if (request()->has('trashed'))
                <a 
                    href="{{ route('refbooks_index') }}" 
                    style="width: max-content; " 
                    class="text-wrap"
                >
                    Показать справочники
                </a>
            @else
                <a 
                    href="{{ route('refbooks_index', ['trashed' => 'ref_book']) }}" 
                    style="width: max-content;  " 
                    class="butn_admin"
                >
                    Показать удалённые справочники
                </a>
            @endif
                
            </div>
        </div>
    
        <div class="info_table mb-4 card_wrapper">
            <table class="admin_table table table-striped table-hover  ">
                <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Название</th>
                    <th scope="col">Порядок</th>
                    <th scope="col">Управление</th>
                </tr>
                </thead>
            
                <tbody>
    
                    @foreach ($list as $item)
                        
                        <tr>
                            <th scope="row">{{ $item->id }}</th>
                            <td>
                                <a href="/refbooks/{{ $item->id }}">
                                    {{ $item->title }}
                                </a>
                                ({{ $item->items()->count() }})
                            </td>
                            <td>
                                {{ $item->order }}
                            </td>
                            <td>
                                @if(request()->has('trashed'))
                                    <a href="/refbooks/{{ $item->id }}/restore" class="btn btn-success">Восстановить</a>
                                @else
                                    <a href="/refbooks/{{ $item->id }}" class="btn btn-primary btn">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="/refbooks/{{ $item->id }}/edit" class="btn btn-primary btn">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <a 
                                        href="/refbooks/{{ $item->id }}/delete" 
                                        class="btn btn-primary btn confirm_delete"
                                    >
                                        <i class="bi bi-trash"></i>
                                    </a>
                                @endif
                            </td>
                        </tr>
    
                    @endforeach
    
                </tbody>
            </table>
    
            <div class="p-3">
                {{ $list->links() }}
            </div>
    
        </div>
    
    </div>


@stop