//INPUTS
$( "#number" ).on( "change", function() {
    $("#number_range").val($( "#number" ).val());
  } );

  $( "#edition" ).on( "change", function() {
    $("#edition_range").val($( "#edition" ).val());
  } );

  $( "#wishlist" ).on( "change", function() {
    $("#wishlist_range").val($( "#wishlist" ).val());
  } );

  $( "#quality" ).on( "change", function() {
    $("#quality_range").val($( "#quality" ).val());
  } );

  $( "#effort" ).on( "change", function() {
    $("#effort_range").val($( "#effort" ).val());
  } );


//RANGE
$( "#number_range" ).on( "change", function() {
    $("#number").val($( "#number_range" ).val());
  } );

  $( "#edition_range" ).on( "change", function() {
    $("#edition").val($( "#edition_range" ).val());
  } );

  $( "#wishlist_range" ).on( "change", function() {
    $("#wishlist").val($( "#wishlist_range" ).val());
  } );
  $( "#quality_range" ).on( "change", function() {
    $("#quality").val($( "#quality_range" ).val());
  } );
  $( "#effort_range" ).on( "change", function() {
    $("#effort").val($( "#effort_range" ).val());
  } );

//number
var numberMax = $( "#number" ).attr('max');
var numberMin = $( "#number" ).attr('min');
//edition
var editionMax = $( "#edition" ).attr('max');        
var editionMin = $( "#edition" ).attr('min');   
//wishlist
var wishlistMax = $( "#wishlist" ).attr('max');        
var wishlistMin = $( "#wishlist" ).attr('min');   
//quality
var qualityMax = $( "#quality" ).attr('max');        
var qualityMin = $( "#quality" ).attr('min');   
//effort
var effortMax = $( "#effort" ).attr('max');        
var effortMin = $( "#effort" ).attr('min');      

//SET MAX, MIN
$("#number_range").attr({
    "max" : numberMax,        
    "min" : numberMin          
});

$("#edition_range").attr({
    "max" : editionMax,        
    "min" : editionMin          
});

$("#wishlist_range").attr({
    "max" : wishlistMax,        
    "min" : wishlistMin          
});

$("#quality_range").attr({
    "max" : qualityMax,        
    "min" : qualityMin         
});

$("#effort_range").attr({
    "max" : effortMax,        
    "min" : effortMin         
});

//SET MAX/MIN TEXTS
$("#number_max").text("Max: " + numberMax);
$("#number_min").text("Min: " + numberMin);

$("#edition_max").text("Max: " + editionMax);
$("#edition_min").text("Min: " + editionMin);

$("#wishlist_max").text("Max: " + wishlistMax);
$("#wishlist_min").text("Min: " + wishlistMin);

$("#quality_max").text("Max: " + qualityMax);
$("#quality_min").text("Min: " + qualityMin);

$("#effort_max").text("Max: " + effortMax);
$("#effort_min").text("Min: " + effortMin);

//SET VALUE
$("#number_range").val($( "#number" ).val());
$("#edition_range").val($( "#edition" ).val());
$("#wishlist_range").val($( "#wishlist" ).val());
$("#quality_range").val($( "#quality" ).val());
$("#effort_range").val($( "#effort" ).val());