<form action="/feedback_submit" method="POST" id="feedback_form" enctype="multipart/form-data">
    @csrf
    <div class="inputs">
        <div class="input">
            <label for="name">ФИО <span class="red">*</span></label>
            <input type="text" id="name" name="name" placeholder="Введите ФИО" value="{{ old('name') }}" />
            @error('name')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="input">
            <label for="bin">БИН <span class="red">*</span></label>
            <input type="number" id="bin" name="bin" placeholder="Введите БИН" value="{{ old('bin') }}" />
            @error('bin')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="input">
            <label for="phone">Номер телефона <span class="red">*</span></label>
            </label>
            <input type="text" id="phone" name="phone" placeholder="+7 (999) 999 99 99"
                value="{{ old('phone') }}" /> 
            @error('phone')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="input">
            <label for="requisites">Прикрепите реквизиты</label>
            <label class="label-file" for="requisites"><img src="./img/pluse.svg" alt="+" /></label>
            <input type="file" class="input-file" id="requisites" name="user_requisites" />
            @error('user_requisites')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="input">
            <label for="company_name">Наименование компании <span class="red">*</span></label>
            <input type="text" id="company_name" name="company_name" placeholder="Введите наименование"
                value="{{ old('company_name') }}" />
            @error('company_name')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="input">
            <label for="certificate">Прикрепите cправку о гос.регистрации</label>
            <label class="label-file" for="certificate"><img src="./img/pluse.svg" alt="+" /></label>
            <input type="file" class="input-file" id="certificate" name="user_certificate" />
            @error('user_certificate')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
    </div>

    <button type="submit" class="butn-white">Оставить заявку</button>
</form>
