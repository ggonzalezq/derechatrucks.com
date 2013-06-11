/*
 *@author   ggonzalez
 *@date     2 June 2013
 **/
$( function(){
    $( ".slide-active" ).bind( "click", function(){
        $( this ).parents( "form" ).submit();
    } );
} );