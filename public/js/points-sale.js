// ----------------------скроллбар---секция points_sale--------------------
$("#scroll").perfectScrollbar();


  
$('.butn_list').on('click', function() {
    $( ".points_container_map" ).css( 'display', 'none');
    $( ".nano" ).css( 'height', 'auto');
    $( ".nano" ).css( 'display', 'block');
    
  });
$('.butn_map').on('click', function() {
    $( ".points_container_map" ).css( 'display', 'block');
    $( ".nano" ).css( 'display', 'none');
    
  });


// $('.search_butn').on('click', function() {

//     // $( ".search_window" ).css( 'display', 'block');
//     $( ".search_window" ).toggleClass( "show" );
//   });
