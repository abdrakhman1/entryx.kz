@extends('site.templates.main')
@section('head')
    @parent
    <link rel="stylesheet" href="{{ asset('css/projects.css') }}">
    <link rel="stylesheet" href="{{ asset('css/landing.css') }}">
@endsection

@section('content')
    <section class="allElements">
        <div class="container">
            <div class="sect__top">
                <h1>Все проекты</h1>
            </div>
            
            <!-- 1 (фото справа) -->
            <div class="project-block">
                <div class="project-info">
                    <h2 class="project-title">ЖК «RENESANS»</h2>
                    <div class="project-company">ELIT STROY GROUP, АСТАНА</div>
                    <div class="project-description">
                        В ЖК «Renesans» представлена модель двери 
                        с&nbsp;фальш-фрамугой. Двери изготовлены по&nbsp;индивидуальному 
                        дизайнерскому проекту. Дверь выделяется своей строгостью и&nbsp;лаконичностью.
                    </div>
                </div>
                <img src="https://static.tildacdn.pro/tild3463-6137-4465-a437-373761356362/1.jpeg" alt="Проект 1" class="project-image">
            </div>

            <!-- 2 (фото слева) -->
            <div class="project-block">
                <div class="project-info">
                    <h2 class="project-title">ЖК «TURAN PALACE»</h2>
                    <div class="project-company">SAFI-K-GROUP, АСТАНА</div>
                    <div class="project-description">
                        <p>
                        В&nbsp;ЖК «Turan Palace» представлена модель двери 
                        с&nbsp;фальш-фрамугой. Двери изготовлены по&nbsp;индивидуальному 
                        дизайнерскому проекту. Главным акцентом становятся древесные мотивы, 
                        придающие спокойствие и&nbsp;тепло, а&nbsp;строгий дизайн рабавлен 
                        небольшими декоративными элементами.
                        </p>
                    </div>
                </div>
                <img src="https://static.tildacdn.pro/tild3936-3135-4338-b239-336338386131/noroot.jpg" alt="Проект 2" class="project-image">
            </div>

            <!-- 3 (фото справа) -->
            <div class="project-block">
                <div class="project-info">
                    <h2 class="project-title">ЖК «RESPUBLIKA»</h2>
                    <div class="project-company">SAT-NS, АСТАНА</div>
                    <div class="project-description">
                        В ЖК «RESPUBLIKA» представлена модель двери 
                        с&nbsp;фальш-фрамугой. Двери изготовлены по&nbsp;индивидуальному 
                        дизайнерскому проекту. Всего в&nbsp;ЖК «RESPUBLIKA» было установлено 2795 дверей.
                    </div>
                </div>
                <img src="https://static.tildacdn.pro/tild3132-3237-4139-a539-646136393134/resbublika.jpg" alt="Проект 3" class="project-image">
            </div>
        <div class="project-block">
                <div class="project-info">
                    <h2 class="project-title">ЖК «GRAND VICTORIA»</h2>
                    <div class="project-company">Шар-Құрылыс, АСТАНА</div>
                    <div class="project-description">
                        В ЖК «Grand Victoria» представлены двери, изготовленные 
                        по&nbsp;индивидуальному дизайнерскому проекту. Сочетание минимализма 
                        и&nbsp;классики позволяет сделать гармоничным и&nbsp;стильным 
                        практически любой интерьер. При этом такие двери никогда не&nbsp;смотрятся скучно, 
                        а&nbsp;передают помещению определенное настроение и&nbsp;по-своему виду являются достаточно современными.
                    </div>
                </div>
                <img src="https://static.tildacdn.pro/tild6332-3439-4239-b734-316137323639/grand_viktoria.jpg" alt="Проект 3" class="project-image">
            </div>
        <div class="project-block">
                <div class="project-info">
                    <h2 class="project-title">ЖК «GREENLINE FLORA»</h2>
                    <div class="project-company">BI GROUP, АСТАНА</div>
                    <div class="project-description">
                        ЖК «GreenLine.Flora» - жилой комплекс в бигвилле GreenLine. 
                        Здесь особая атмосфера единства с природой, где ландшафтный дизайн гармонично 
                        сочетается с активностями во дворе, дизайном фасадов и повседневными делами.
                    </div>
                </div>
                <img src="/img/greenlineflora.webp" alt="Проект 3" class="project-image">
        </div>
        <div class="project-block">
                <div class="project-info">
                    <h2 class="project-title">ЖК «GREENLINE AQUA»</h2>
                    <div class="project-company">BI GROUP, АСТАНА</div>
                    <div class="project-description">
                        ЖК «GreenLine.Flora» - жилой комплекс в бигвилле GreenLine. 
                        Здесь особая атмосфера единства с природой, где ландшафтный дизайн гармонично 
                        сочетается с активностями во дворе, дизайном фасадов и повседневными делами.
                    </div>
                </div>
                <img src="/img/greenlineaqua.webp" alt="Проект 3" class="project-image">
            </div>
        <div class="project-block">
                <div class="project-info">
                    <h2 class="project-title">ЖК «SARDAR CITY»</h2>
                    <div class="project-company">SARDAR CONSTRUCTION GROUP, АСТАНА</div>
                    <div class="project-description">
                        Двери в ЖК "Sardar city" отличаются не только
                        индивидуальным дизайном, но и изысканным стилем,
                        который сочетает в себе лаконичность и изысканность. Эти
                        двери не только функциональны, но и добавляют
                        изысканности и роскоши вашему интерьеру.<br><br>
                        Всего в ЖК "Sardar city"
                        было установлено 395 дверей и 395 электронных замков.
                    </div>
                </div>
                <img src="/img/sardar-city.jpg" alt="Проект 3" class="project-image">
            </div>
        </div>
        <div class="project-block">
        <div class="project-info">
            <h2 class="project-title">ЖК «TRIUMPH EXCLUSIVE»</h2>
                <div class="project-company">NAK, АСТАНА</div>
                    <div class="project-description">
                        В ЖК "Компас Север" представлены двери с фальш-
                        фрамугой, которые отличаются изысканным дизайном и
                        высоким качеством исполнения. Их минималистичный
                        стиль и классические элементы добавляют интерьеру
                        роскоши и элегантности, при этом подчеркивая его
                        современность.<br><br>
                        Всего в ЖК "Компас Север"
                        было установлено 376 дверей
                    </div>
            </div>
                <img src="/img/kompas-sever.jpg" alt="Проект 3" class="project-image">
            </div>
        <div class="project-block">
        <div class="project-info">
            <h2 class="project-title">ЖК «AUEN»</h2>
                <div class="project-company">TEVIS GROUP, АСТАНА</div>
                    <div class="project-description">
                        В ЖК «AUEN» представлены двери, выполненные с
                        использованием фальш-фрамуги, которые придают им
                        утонченный вид. Их минималистичный дизайн в
                        сочетании с классическими элементами делает их
                        идеальным решением для создания стильного интерьера
                        любого помещения.<br><br>
                        Всего в ЖК "AUEN"
                        было установлено 550 дверей
                    </div>
                </div>
                <img src="/img/auen.jpg" alt="Проект 3" class="project-image">
            </div>
        <div class="project-block">
        <div class="project-info">
            <h2 class="project-title">ЖК «ATAMURA»</h2>
                <div class="project-company">JETISU, АСТАНА</div>
                    <div class="project-description">
                        В ЖК «АТAMURA» представлены двери с фальш-фрамугой,
                        которые обладают изысканным и стильным дизайном. Их
                        сочетание минимализма с классическими элементами
                        делает их идеальным выбором для современных
                        интерьеров, придавая помещению особый шарм и уют.<br><br>
                        Всего в ЖК "ATAMURA"
                        было установлено 600 дверей
                    </div>
                </div>
                <img src="/img/atamura.jpg" alt="Проект 3" class="project-image">
            </div>
        </div>
        <div class="project-block">
        <div class="project-info">
            <h2 class="project-title">ЖК «ОНАЙ»</h2>
                <div class="project-company">BI GROUP, АСТАНА</div>
                    <div class="project-description">
                        Двери в ЖК "Онай" созданы по индивидуальному
                        дизайнерскому проекту, что делает каждую из них
                        уникальной. Их современный и стильный внешний вид
                        добавляет интерьеру элегантности и изыска, при том
                        сохраняя функциональность и практичность.<br><br>
                        Всего в ЖК "Онай"
                        было установлено 252 дверей
                    </div>
                </div>
                <img src="/img/onay.jpg" alt="Проект 3" class="project-image">
            </div>
        </div>
        <div class="project-block">
        <div class="project-info">
            <h2 class="project-title">ЖК «АКСУ»</h2>
                <div class="project-company">BI GROUP, АСТАНА</div>
                    <div class="project-description">
                        Двери в ЖК "Аксу" созданы по индивидуальному дизайну,
                        что делает каждую из них уникальной. Их стильное
                        сочетание минимализма и классики придает интерьеру
                        изысканность и шарм, делая его уютным и
                        элегатным.<br><br>
                        Всего в ЖК "ксу"
                        было установлено 365 дверей
                    </div>
                </div>
                <img src="/img/aksu.jpg" alt="Проект 3" class="project-image">
            </div>
        </div>
        <div class="project-block">
        <div class="project-info">
            <h2 class="project-title">ЖК «BAITAS»</h2>
                <div class="project-company">TUMAR GROUP, АСТАНА</div>
                    <div class="project-description">
                        В ЖК "BAITAS" представлены двери с фальш-фрамугой,
                        которые обладают изысканным дизайном и высоким
                        качеством исполнения. Их минималистичный стиль и
                        стильные элементы придают интерьеру элегантность и
                        шарм, делая его привлекательным и современным.<br><br>
                        Всего в ЖК "BAITAS"
                        было установлено 200 дверей и 200 электронных замков.
                    </div>
                </div>
                <img src="/img/baitas.jpg" alt="Проект 3" class="project-image">
            </div>
        </div>
        <div class="project-block">
        <div class="project-info">
            <h2 class="project-title">ЖК «TENGRI»</h2>
                <div class="project-company">TUMAR GROUP, АСТАНА</div>
                    <div class="project-description">
                        В ЖК "TENGRI" установлено самые современные и
                        технологичные электронные замки нового поколения.<br><br>
                        Всего в ЖК "TENGRI"
                        было установлено 252 электронных замков.
                    </div>
                </div>
                <img src="/img/tengri.jpg" alt="Проект 3" class="project-image">
            </div>
        </div>
        <div class="project-block">
        <div class="project-info">
            <h2 class="project-title">ЖК «EVA»</h2>
                <div class="project-company">ESTA GROUP, АСТАНА</div>
                    <div class="project-description">
                        В ЖК "EVA" представлены двери, изготовленные по
                        индивидуальному дизайнерскому проекту, что делает
                        каждую из них уникальной. Их стильный дизайн и
                        изысканные элементы придают интерьеру элегантность и
                        шарм, делая его уютным и стильным.<br><br>
                        Всего в ЖК "EVA"
                        было установлено 180 дверей и 180 электронных замков.
                    </div>
                </div>
                <img src="/img/eva.jpg" alt="Проект 3" class="project-image">
            </div>
        </div>
        <div class="project-block">
        <div class="project-info">
            <h2 class="project-title">ЖК «DELTA»</h2>
                <div class="project-company">SAT-NS, АСТАНА</div>
                    <div class="project-description">
                        Двери в ЖК "DELTA" представлены в индивидуальном
                        дизайнерском исполнении, что придает каждой из них
                        неповторимый характер. Их стильное сочетание
                        минимализма и классических элементов придает интерьеру
                        изысканность и утонченность, делая его привлекательным и
                        стильным.<br><br>
                        Всего в ЖК "DELTA"
                        было установлено 3500 квартирных и технических дверей.
                    </div>
                </div>
                <img src="/img/delta.jpg" alt="Проект 3" class="project-image">
            </div>
        </div>
    </section>

    <!-- Модальное окно для просмотра изображений -->
    <div id="imageModal" class="modal">
        <span class="modal-close">&times;</span>
        <span class="modal-prev"></span>
        <span class="modal-next"></span>
        <img class="modal-content" id="modalImage">
    </div>

    <!-- Кнопка прокрутки вверх -->
    <button class="scroll-top" id="scrollTop"></button>
@endsection

@section('footerScripts')
    @parent
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const projectBlocks = document.querySelectorAll('.project-block');
        const modal = document.getElementById('imageModal');
        const modalImg = document.getElementById('modalImage');
        const closeBtn = document.querySelector('.modal-close');
        const prevBtn = document.querySelector('.modal-prev');
        const nextBtn = document.querySelector('.modal-next');
        let currentImages = [];
        let currentImageIndex = 0;

        projectBlocks.forEach(block => {
            const images = block.querySelectorAll('img');
            if (images.length > 1) {
                const imageContainer = document.createElement('div');
                imageContainer.classList.add('project-image-container');
                images[0].parentNode.insertBefore(imageContainer, images[0]);

                images.forEach((img, index) => {
                    imageContainer.appendChild(img);
                    if (index !== 0) {
                        img.style.display = 'none';
                    }
                    
                    img.addEventListener('click', function() {
                        modal.style.display = 'block';
                        modalImg.src = this.src;
                        currentImages = Array.from(images);
                        currentImageIndex = currentImages.indexOf(this);
                    });
                });

                const leftArrow = document.createElement('button');
                leftArrow.classList.add('carousel-arrow', 'left');
                imageContainer.appendChild(leftArrow);

                const rightArrow = document.createElement('button');
                rightArrow.classList.add('carousel-arrow', 'right');
                imageContainer.appendChild(rightArrow);

                let currentIndex = 0;

                leftArrow.addEventListener('click', (e) => {
                    e.stopPropagation();
                    images[currentIndex].style.display = 'none';
                    currentIndex = (currentIndex - 1 + images.length) % images.length;
                    images[currentIndex].style.display = 'block';
                });

                rightArrow.addEventListener('click', (e) => {
                    e.stopPropagation();
                    images[currentIndex].style.display = 'none';
                    currentIndex = (currentIndex + 1) % images.length;
                    images[currentIndex].style.display = 'block';
                });
            } else if (images.length === 1) {
                images[0].addEventListener('click', function() {
                    modal.style.display = 'block';
                    modalImg.src = this.src;
                    currentImages = [this];
                    currentImageIndex = 0;
                });
            }
        });

        // Закрытие модального окна
        closeBtn.addEventListener('click', function() {
            modal.style.display = 'none';
        });

        modal.addEventListener('click', function(e) {
            if (e.target === modal) {
                modal.style.display = 'none';
            }
        });

        // Переключение изображений в модальном окне
        prevBtn.addEventListener('click', function(e) {
            e.stopPropagation();
            if (currentImages.length > 1) {
                currentImageIndex = (currentImageIndex - 1 + currentImages.length) % currentImages.length;
                modalImg.src = currentImages[currentImageIndex].src;
            }
        });

        nextBtn.addEventListener('click', function(e) {
            e.stopPropagation();
            if (currentImages.length > 1) {
                currentImageIndex = (currentImageIndex + 1) % currentImages.length;
                modalImg.src = currentImages[currentImageIndex].src;
            }
        });

        // Обработка клавиш
        document.addEventListener('keydown', function(e) {
            if (modal.style.display === 'block') {
                if (e.key === 'Escape') {
                    modal.style.display = 'none';
                } else if (e.key === 'ArrowLeft' && currentImages.length > 1) {
                    currentImageIndex = (currentImageIndex - 1 + currentImages.length) % currentImages.length;
                    modalImg.src = currentImages[currentImageIndex].src;
                } else if (e.key === 'ArrowRight' && currentImages.length > 1) {
                    currentImageIndex = (currentImageIndex + 1) % currentImages.length;
                    modalImg.src = currentImages[currentImageIndex].src;
                }
            }
        });

        const scrollTopBtn = document.getElementById('scrollTop');

        // Показать/скрыть кнопку при прокрутке
        window.addEventListener('scroll', function() {
            if (window.pageYOffset > 300) {
                scrollTopBtn.style.display = 'flex';
            } else {
                scrollTopBtn.style.display = 'none';
            }
        });

        // Прокрутка вверх при клике
        scrollTopBtn.addEventListener('click', function() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    });
</script>
