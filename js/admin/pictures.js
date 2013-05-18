/*
 *@author   ggonzalez
 *@date     19 March 2013
 **/
$( function(){
    $( ".picture-preview" ).bind( "click", function(){
        $( this ).closest( "form" ).submit();
    } );
} );