document.querySelectorAll('.input_file').forEach((input) => {
    input.addEventListener('change', (event) => {
        const {files, id} = event.target;
        if (files.length) {
            const names = Array.from(files).map(({name}) => (name)).join();
            const fileLabel = document.querySelector(`.label_file[for=${id}]`);
            fileLabel.innerHTML = `<div class="label_file_intro"><img src="/img/icon/ok-green.svg" alt="Appstore" /> ${names} <div class="remove_file"></div></div>`;
            fileLabel.classList.add('active');
        }     
    });
});

$("input#profile_phone").mask("+7(999) 999-9999");