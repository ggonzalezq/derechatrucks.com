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

$( function(){
    $( '.print' ).click( function( e ){
        e.preventDefault();
        var template = '';
        var HTML = '';
        
        if( ! $( 'body' ).hasClass( 'printing' ) )
        {
            template = $( '#print-article' ).html();
            template = Handlebars.compile( template );
            HTML = template( {} );
            $( 'body' ).append( HTML );    
        }
        
        $( 'body' ).addClass( 'printing' );
        
        window.print();
    } );
} );

