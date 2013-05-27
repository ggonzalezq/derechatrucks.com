/*
 * @author ggonzalez
 * @24 February 2013
 */
$( function(){
    $( "input[name=\"purchase_article_status\"]" ).bind( "click", function(){
        var $this = $( this ), 
            iValue = parseInt( $this.val() ), 
            oArticleAvailable = $( "#article-available" ),
            oArticleNotAvailable = $( "#article-not-available" );
            
        switch(  iValue )
        {
            case 0:
                
                if( oArticleNotAvailable.is( ":visible" ) )
                {
                    return true;
                }
                
                oArticleAvailable.addClass( "none" );
                oArticleNotAvailable.slideDown( "fast", function(){
                    oArticleNotAvailable.removeClass( "none" ).removeAttr( "style" );
                } );
                
            break;
            case 1:
                
                if( oArticleAvailable.is( ":visible" ) )
                {
                    return true;
                }
                
                oArticleNotAvailable.addClass( "none" );
                oArticleAvailable.slideDown( "fast", function(){
                    oArticleAvailable.removeClass( "none" ).removeAttr( "style" );
                } );
                
            break;
        }
            
    } );
} );