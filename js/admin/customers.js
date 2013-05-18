/*
 * @author ggonzalez
 * @18 February 2013
 */
$( function(){
    
    
    $( ".customer-comments a" ).bind( "click", function(){
        $this = $( this ),
        oComments = $this.parent( ".customer-comments" );
        oComments.find( ".ellipsis" ).slideToggle( "fast" );
        $this.find( "i" ).toggleClass( "icon-arrow-down icon-arrow-up" );
    } );
    
    
    
    //masks
    /*
     *TODO
     *Change the format for the following cities:
     *Mexico, Monterrey, Guadalajara
     **/
    if( $.fn.mask )
    {
        $( "#customer_telephone" ).mask( "(111) 111-1111" );
        $( "#customer_mobile" ).mask( "(111) 111-1111" );
    }
    
    //populate cities
    $( "#state_id" ).chosen().bind( "change", function(){
        var $this = $( this ),
            iValue = parseInt( $this.val() ),
            oCity = $( "#city_id" );
        
        if( iValue === 0 )
        {
            oCity.attr( "disabled", true ).html( "<option value=\"0\">Seleccione</option>" ).trigger("liszt:updated");
            return true;
        }
        
        $.ajax( {
            url : '/admin/cities/' + iValue,
            success : function( oCities )
            {
                var sBuffer = '';
                
                sBuffer += "<option value=\"0\">Seleccione</option>";
                
                for( var i = 0; i < oCities.length; i++ )
                {
                    sBuffer += "<option value=\"" + oCities[i].city_id + "\">" + oCities[i].city_name + "</option>";
                }
                
                oCity.attr( "disabled", false ).html( sBuffer ).trigger("liszt:updated");
            }
        } );
    } );
} );