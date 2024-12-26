
  new Carousel(document.getElementById('myCarouselBrand'), {
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
        dragFree: false,
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
});
new Carousel(document.getElementById('myCarouselBrand2'), {
    infinite: true,
    center: true,
    slidesPerPage: 'auto',
    dots: false,
    transition: false,
  });
