@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2 class="admin_title title-p">Редактирование поста</h2>
                </div>
                <div class="pull-right">
                    <a class="btn btn_back" href="{{ route('admin.posts.index') }}"> 
                        <img src="{{asset('img/arrows-left.svg')}}" alt="">
                        Назад</a>
                </div>
            </div>
        </div>
        <form class="form_admin" action="{{ route('admin.posts.update', $post) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="title">Название</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ $post->title }}" required>
            </div>

            <div class="form-group">
                <label for="image_file" class="form-label">Изображение</label>
                <input class="form-control" type="file" id="image_file" name="image_file">
                @error('image_file')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div >
                <a href="{{ $post->image }}" target="_blank">
                    <img alt="" src="{{ $post->image }}" height="100">
                </a> <br>
                @if($post->image)
                    <a class="btn btn_delete" href="/admin/posts/{{ $post->id }}/delete_image" onclick="return confirm('Удалить?')">Удалить фото</a>
                @endif
            </div>

            <div class="form-group">
                <label for="content">Контент</label>
                <textarea class="form-control ckeditor" id="content" name="content" rows="4" required>{{ $post->content }}</textarea>
            </div>

            <div class="form-group">
                <label for="visible">Видимость</label>
                <select class="form-select" id="visible" name="visible">
                    <option value="1" {{ $post->visible ? 'selected' : '' }}>Yes</option>
                    <option value="0" {{ !$post->visible ? 'selected' : '' }}>No</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Сохранить</button>
        </form>
    </div>

    <script src="//cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('.ckeditor').ckeditor();
        });
    </script>
    <script type="text/javascript">
        CKEDITOR.replace('content', {
            filebrowserUploadUrl: "{{ route('ckeditor.image-upload', ['_token' => csrf_token()]) }}",
            filebrowserUploadMethod: 'form'
        });
    </script>

@endsection
