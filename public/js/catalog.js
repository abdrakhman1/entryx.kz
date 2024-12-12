$(function () {
    $("#sort").selectmenu();
});
// -----------------------------range filter секция каталог----------------------------

$(function () {
    function showRange(rangeMin, rangeMax) {
        $("#amount").html(
            `<div class="point-right">${rangeMin}</div><div class="point-left">${rangeMax}</div>`
        );
    }

    $("#slider-range").slider({
        range: true,
        min: 10000,
        max: 155000,
        step: 1000,
        values: [35000, 80000],
        slide: function (event, ui) {
            showRange(ui.values[0], ui.values[1]);
        },
    });

    const range = $("#slider-range");
    showRange(range.slider("values", 0), range.slider("values", 1));
});

// ----------------------------пагинация секция каталог-------------------------------

$("#light-pagination").pagination({
    items: 700,
    itemsOnPage: 20,
    displayedPages: 3,
    edges: 1,
    useEndEdge: true,
    prevText: "<",
    nextText: ">",
});


$('.filters_butn').on('click', function() {
    
    $( "div.sort_mobile" ).toggleClass( "no-show-mobile" );
    $( "div.overlay-black" ).toggleClass( "no-show-mobile" );
    $( "div.overlay-black" ).toggleClass( "overlay-show" );
    $( "body" ).css( 'overflow', 'hidden');
 
  });
  
$('.butn-exit').on('click', function() {
    
    $( "div.sort_mobile" ).toggleClass( "no-show-mobile" );
    $( "body" ).css( 'overflow', 'auto');
    $( "div.overlay-black" ).toggleClass( "no-show-mobile" );
    $( "div.overlay-black" ).toggleClass( "overlay-show" );
     
  });



  $('.search_butn').on('click', function() {
    $( ".search_window" ).addClass( "show" );
    $( ".input-search" ).addClass( "abs" );

  });
  $('.butn_close-search').on('click', function() {
    $( ".search_window.show" ).toggleClass('show');
    $( ".input-search" ).removeClass('abs');


  })
