// ---------------------------------маска номера для формы-----------------------------------------/
$("#phone").mask("+7(999) 999-9999");
$("#phone--modal").mask("+7(999) 999-9999");
$("#phone--ask").mask("+7(999) 999-9999");
$("#phone--reg").mask("+7(999) 999-9999");


// -------------------------------скрипт отображения загруженного файла в инпуте-----------

document.querySelectorAll('.input-file').forEach((input) => {
    input.addEventListener('change', (event) => {
        const {files, id} = event.target;
        if (files.length) {
            const names = Array.from(files).map(({name}) => (name)).join();
            const fileLabel = document.querySelector(`.label-file[for=${id}]`);
            fileLabel.innerHTML = `<div>${names}</div>`;
        }     
    });
});

$('.go_back').on('click', function() {

    window.history.back()
    
  });