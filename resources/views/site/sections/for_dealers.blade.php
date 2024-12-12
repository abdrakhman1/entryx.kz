@php
$ismain = isset($isindex) ? $isindex : false;
@endphp

 

@if ($ismain)
<div class="d-flex gap-4 lk__box container p0">
@else
<div class="d-flex gap-4 lk__box container ">
@endif
 
 
     <div class="lk__container">
         <div class="lk">
             <h3>
                 Зачем нужен <span class="text-grad">Личный кабинет?</span>
             </h3>
             <div class="lk-text">
                 <p>
                     Использование личного кабинета дилера помогает разгрузить
                     менеджеров клиентов от задач по оформлению заказов, работе с
                     рекламациями и обращениями клиентов, а также обеспечению
                     клиентов информационными и рекламными материалами.
                 </p>
                 <p>
                     Это позволяет менеджерам больше времени уделять поиску новых
                     клиентов и повышению лояльности существующих.
                 </p>
             </div>
             <a href="#!" class="lk-btn">Узнать подробнее
                 <img src="./img/arrrow.svg" alt="arrow" />
             </a>
         </div>
         <div class="lk__img"></div>
     </div>
     <div class="mobile-app">
         <h3>
             У нас есть <span class="text-grad">мобильное приложение!</span>
         </h3>
         <p>Его можно скачать в Google Play или Apple Store.</p>
         <div class="stores">
             <a href="#!" class="store">
                 <img src="./img/app-dark.svg" alt="Appstore" />
             </a>
             <a href="#!" class="store">
                 <img src="./img/google-dark.svg" alt="Google Play" />
             </a>
         </div>
     </div>
 </div>
