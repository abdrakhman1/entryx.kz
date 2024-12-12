@extends('site.templates.main')


@section('content')
    <div class="container-grey">
        <div class="container_alert">
            <img src="/img/icon/check-circle.svg" alt="ok">
                <p class="title-m">Ваша заявка успешно отправлена!</p>
            <p class="text">
                Наш менеджер свяжется с Вами в ближайшее время!
            </p>
            <a href="/" class="butn">На главную</a>
        </div>
    </div>
@endsection
