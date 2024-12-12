
// ------------------------------------слайдер карточка товара секция product------------

// $(function () {
//     $(".slider-for").not(".slick-initialized").slick({
//         slidesToShow: 1,
//         slidesToScroll: 1,
//         fade: true,
//         arrows: false,
//     });
//     $(".slider-nav")
//         .not(".slick-initialized")
//         .slick({
//             asNavFor: ".slider-for",
//             slidesToShow: 5,
//             slidesToScroll: 1,
//             infinite: true,
//             focusOnSelect: true,
//             appendArrows: $(".arrows"),
//             arrows: true,
//             prevArrow:
//                 '<div class="slider-arrows slider-arrows__left"><img src="img/arrows-left.svg" alt=""></div>',
//             nextArrow:
//                 '<div class="slider-arrows slider-arrows__right"><img src="img/arrows-right.svg" alt=""></div>',
//             responsive: [
//                 {
//                     breakpoint: 1200,
//                     settings: {
//                         slidesToShow: 4,
//                         slidesToScroll: 1,
//                         infinite: true,
//                     },
//                 },
//                 {
//                     breakpoint: 800,
//                     settings: {
//                         slidesToShow: 4,
//                         slidesToScroll: 1,
//                     },
//                 },
//                 {
//                     breakpoint: 480,
//                     settings: {
//                         slidesToShow: 4,
//                         slidesToScroll: 1,
//                     },
//                 },
//             ],
//         });
// });

 

 

new Carousel(
  document.getElementById('productCarousel'),
  {
    infinite: false,
    Dots: false,
    Thumbs: {
      type: 'classic',
      Carousel: {
        slidesPerPage: 1,
        Navigation: true,
        center: true,
        fill: true,
        dragFree: true,
      },
    },
  },
   { Thumbs }
);

Fancybox.bind('[data-fancybox="gallery"]', {
  idle: false,
  compact: false,
  dragToClose: false,

  animated: false,
  showClass: 'f-fadeSlowIn',
  hideClass: false,

  Carousel: {
    infinite: false,
  },

  Images: {
    zoom: true,
    Panzoom: {
      maxScale: 1.5,
    },
  },

  Toolbar: {
    absolute: true,
    display: {
      left: [],
      middle: [],
      right: ['close'],
    },
  },

  Thumbs: {
    type: 'classic',
    Carousel: {
      axis: 'x',

      slidesPerPage: 1,
      Navigation: true,
      center: true,
      fill: true,
      dragFree: true,

       
    },
  },
});
