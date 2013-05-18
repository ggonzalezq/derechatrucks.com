/*
 *@author   ggonzalez
 *@date     17 March 2013
 **/
$( function(){
    
    $( ".article-active" ).bind( "click", function(){
        $( this ).parents( "form" ).submit();
    } );

    $( ".article-status" ).chosen().change( function(){
        $( this ).parents( "form" ).submit();
    } );
    
    $( "#category_id" ).chosen().change( function(){
        
        var $this = $( this ),
            sValue = "",
            arWords = [],
            oSKU = $( "#article_sku" );
            sSKU = "";
        
        if( $this.val() === "" )
        {
            return true;
        }
        
        sValue = $this.find( "option:selected" ).text();
        arWords = sValue.split( " " );
        sValue = "";
        
        for( var i = 0; i < arWords.length; i++ )
        {
            
            if( arWords[i].toLowerCase() === "de" )
            {
                continue;
            }
            
            sValue += arWords[i].charAt( 0 ).toUpperCase()
        }
        
        sSKU += "DT";
        sSKU += "-" + sValue;
        sSKU += "00";
        oSKU.val( sSKU );
        
    } );
    
    $( ".list-images" ).bind( "click", function(){
        var oImages = $( this ).parents( "li" ).find( "iframe" ),
            sSource = oImages.attr( "data-src" );
        
        if( oImages.hasClass( "rendered" ) )
        {
            return;
        }
        
        oImages.attr( "src", sSource );
        oImages.removeClass( "non-rendered" ).addClass( "rendered" );
    } );
} );