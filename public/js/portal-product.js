
new Carousel(
    document.getElementById('productCarousel'),
    {
      adaptiveHeight: true,
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
  

