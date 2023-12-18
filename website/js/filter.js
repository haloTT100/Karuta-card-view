//INPUTS
//MIN
$( "#number_min" ).on( "change", function() {
    $("#number_min_range").val($( "#number_min" ).val());
  } );

  $( "#edition_min" ).on( "change", function() {
    $("#edition_min_range").val($( "#edition_min" ).val());
  } );

  $( "#wishlist_min" ).on( "change", function() {
    $("#wishlist_min_range").val($( "#wishlist_min" ).val());
  } );

  $( "#quality_min" ).on( "change", function() {
    $("#quality_min_range").val($( "#quality_min" ).val());
  } );

  $( "#effort_min" ).on( "change", function() {
    $("#effort_min_range").val($( "#effort_min" ).val());
  } );
//MAX
  $( "#number_max" ).on( "change", function() {
    $("#number_max_range").val($( "#number_max" ).val());
  } );

  $( "#edition_max" ).on( "change", function() {
    $("#edition_max_range").val($( "#edition_max" ).val());
  } );

  $( "#wishlist_max" ).on( "change", function() {
    $("#wishlist_max_range").val($( "#wishlist_max" ).val());
  } );

  $( "#quality_max" ).on( "change", function() {
    $("#quality_max_range").val($( "#quality_max" ).val());
  } );

  $( "#effort_max" ).on( "change", function() {
    $("#effort_max_range").val($( "#effort_max" ).val());
  } );


//RANGE
//min
$( "#number_min_range" ).on( "change", function() {
    $("#number_min").val($( "#number_min_range" ).val());
  } );

  $( "#edition_min_range" ).on( "change", function() {
    $("#edition_min").val($( "#edition_min_range" ).val());
  } );

  $( "#wishlist_min_range" ).on( "change", function() {
    $("#wishlist_min").val($( "#wishlist_min_range" ).val());
  } );
  $( "#quality_min_range" ).on( "change", function() {
    $("#quality_min").val($( "#quality_min_range" ).val());
  } );
  $( "#effort_min_range" ).on( "change", function() {
    $("#effort_min").val($( "#effort_min_range" ).val());
  } );
//max
  $( "#number_max_range" ).on( "change", function() {
    $("#number_max").val($( "#number_max_range" ).val());
  } );

  $( "#edition_max_range" ).on( "change", function() {
    $("#edition_max").val($( "#edition_max_range" ).val());
  } );

  $( "#wishlist_max_range" ).on( "change", function() {
    $("#wishlist_max").val($( "#wishlist_max_range" ).val());
  } );
  $( "#quality_max_range" ).on( "change", function() {
    $("#quality_max").val($( "#quality_max_range" ).val());
  } );
  $( "#effort_max_range" ).on( "change", function() {
    $("#effort_max").val($( "#effort_max_range" ).val());
  } );


//number
var numberMax = $( "#number_min" ).attr('max');
var numberMin = $( "#number_min" ).attr('min');
//edition
var editionMax = $( "#edition_min" ).attr('max');        
var editionMin = $( "#edition_min" ).attr('min');   
//wishlist
var wishlistMax = $( "#wishlist_min" ).attr('max');        
var wishlistMin = $( "#wishlist_min" ).attr('min');   
//quality
var qualityMax = $( "#quality_min" ).attr('max');        
var qualityMin = $( "#quality_min" ).attr('min');   
//effort
var effortMax = $( "#effort_min" ).attr('max');        
var effortMin = $( "#effort_min" ).attr('min');      


//SET MAX, MIN
//MIN
$("#number_min_range").attr({
    "max" : numberMax,        
    "min" : numberMin          
});

$("#edition_min_range").attr({
    "max" : editionMax,        
    "min" : editionMin          
});

$("#wishlist_min_range").attr({
    "max" : wishlistMax,        
    "min" : wishlistMin          
});

$("#quality_min_range").attr({
    "max" : qualityMax,        
    "min" : qualityMin         
});

$("#effort_min_range").attr({
    "max" : effortMax,        
    "min" : effortMin         
});
//MAX
$("#number_max_range").attr({
    "max" : numberMax,        
    "min" : numberMin          
});

$("#edition_max_range").attr({
    "max" : editionMax,        
    "min" : editionMin          
});

$("#wishlist_max_range").attr({
    "max" : wishlistMax,        
    "min" : wishlistMin          
});

$("#quality_max_range").attr({
    "max" : qualityMax,        
    "min" : qualityMin         
});

$("#effort_max_range").attr({
    "max" : effortMax,        
    "min" : effortMin         
});


//SET VALUE
$("#number_min_range").val($( "#number_min" ).val());
$("#edition_min_range").val($( "#edition_min" ).val());
$("#wishlist_min_range").val($( "#wishlist_min" ).val());
$("#quality_min_range").val($( "#quality_min" ).val());
$("#effort_min_range").val($( "#effort_min" ).val());

$("#number_max_range").val($( "#number_max" ).val());
$("#edition_max_range").val($( "#edition_max" ).val());
$("#wishlist_max_range").val($( "#wishlist_max" ).val());
$("#quality_max_range").val($( "#quality_max" ).val());
$("#effort_max_range").val($( "#effort_max" ).val());