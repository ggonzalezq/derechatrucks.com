/**
 * @author  ggonzalez
 * @date    4 June 2013
 */
$( window ).load( function() {
    $( "#main-slider" ).flexslider({
        animation: "slide",
        selector: ".slides > .slide",
        prevText: "Anterior",
        nextText: "Siguiente" 
    });
});