// new Carousel(
//     document.getElementById('myCarouselBrand'),
//     {
//       adaptiveHeight: true,
//       infinite: false,
//       Dots: false,
//       Thumbs: {
//         type: 'classic',
//         Carousel: {
//           slidesPerPage: 3,
//           Navigation: true,
//           center: true,
//           fill: true,
//           dragFree: true,
//         },
//       },
//     },
  
//   );
  

  new Carousel(document.getElementById('myCarouselBrand'), {
    // Navigation: {
    //   prevTpl:
    //     '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M11 5l-7 7 7 7"/><path d="M4 12h16"/></svg>',
    //   nextTpl:
    //     '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M4 12h16"/><path d="M13 5l7 7-7 7"/></svg>',
    // },
  
    infinite: true,
    center: true,
    slidesPerPage: 'auto',
    dots: false,
    transition: false,
  });

  document.addEventListener("DOMContentLoaded", function() {
    const projectOptions = {
        Dots: false,
        infinite: false,
        dragFree: true,
        preload: 0,
        slidesPerPage: 3,
        Navigation: {
            prevTpl: '<svg width="40" height="40" viewBox="0 0 48 48" fill="none"><path d="M27 12L15 24L27 36" stroke="#666" stroke-width="1.5"/></svg>',
            nextTpl: '<svg width="40" height="40" viewBox="0 0 48 48" fill="none"><path d="M21 12L33 24L21 36" stroke="#666" stroke-width="1.5"/></svg>'
        },
        breakpoints: {
            '(max-width: 1200px)': {
                slidesPerPage: 2
            },
            '(max-width: 768px)': {
                slidesPerPage: 1
            }
        },
        classes: {
            viewport: 'f-carousel__viewport',
            track: 'f-carousel__track',
            slide: 'project__card-wrapper'
        }
    };

    new Carousel(document.getElementById("myCarouselProjects"), projectOptions);

    // ...existing code for myCarouselBrand...
});

