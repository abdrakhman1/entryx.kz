<div class="section-p5 bg-light-grey">
    <div class="container">
        <div class="form-text">
            <h4 class="black">У вас есть вопросы?</h4>
            <p>Оставьте свой вопрос и мы перезвоним Вам в ближайшее время!</p>
        </div>
        <form class="form-tel" id="feedback_simple_form" method="POST" action="/feedback_simple_submit">
            @csrf

            <div class="input input-white">
                <label for="name--ask">Введите имя <span class="red">*</span></label>
                <input type="text" id="name--ask" name="name" placeholder="Введите имя" value="{{ old('name') }}" />
                @error('name')
                <small class="text-danger">{{ $message }}</small>
            @enderror
            </div>
       

            <div class="input input-white">
                <label for="phone--ask">Номер телефона <span class="red">*</span></label>
                </label>
                <input type="tel" name="phone" id="phone--ask" placeholder="+7 (999) 999 99 99" value="{{ old('phone') }}" />
                @error('phone')
                <small class="text-danger">{{ $message }}</small>
            @enderror

            </div>
            
            <div class="input w-100 input-white">
                <label for="bin--ask">Введите комментарий</label>
                <input type="text" id="bin--ask" name="comment" placeholder="Комментарий (не обязательно)" value="{{ old('comment') }}"/>
                @error('comment')
                <small class="text-danger">{{ $message }}</small>
            @enderror
            </div>
            
            <button type="submit" class="butn butn--foot upper">Оставить заявку</button>
        </form>
    </div>

</div>
