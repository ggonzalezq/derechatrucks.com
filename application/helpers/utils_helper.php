<?php
/*
 * @author ggonzalez
 * @29 October 2012
 */

if ( ! defined('BASEPATH')) exit( 'No direct script access allowed' );

class UtilsHelper
{
    public static function stripTildes( $sPermalink = NULL )
    {
        if( $sPermalink === NULL ) return FALSE;

        $arSearch = array(  'À', 'Á', 'Â', 'Ã', 'Ä', 'Å', 'Æ', 'Ç', 'È', 'É', 'Ê', 'Ë', 'Ì', 'Í', 'Î', 'Ï', 'Ð', 'Ñ', 'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'Ø', 'Ù', 'Ú', 'Û', 'Ü', 'Ý', 'ß', 'à', 'á', 'â', 'ã', 'ä', 'å', 'æ', 'ç', 'è', 'é', 'ê', 'ë', 'ì', 'í', 'î', 'ï', 'ñ', 'ò', 'ó', 'ô', 'õ', 'ö', 'ø', 'ù', 'ú', 'û', 'ü', 'ý', 'ÿ', 'Ā', 'ā', 'Ă', 'ă', 'Ą', 'ą', 'Ć', 'ć', 'Ĉ', 'ĉ', 'Ċ', 'ċ', 'Č', 'č', 'Ď', 'ď', 'Đ', 'đ', 'Ē', 'ē', 'Ĕ', 'ĕ', 'Ė', 'ė', 'Ę', 'ę', 'Ě', 'ě', 'Ĝ', 'ĝ', 'Ğ', 'ğ', 'Ġ', 'ġ', 'Ģ', 'ģ', 'Ĥ', 'ĥ', 'Ħ', 'ħ', 'Ĩ', 'ĩ', 'Ī', 'ī', 'Ĭ', 'ĭ', 'Į', 'į', 'İ', 'ı', 'Ĳ', 'ĳ', 'Ĵ', 'ĵ', 'Ķ', 'ķ', 'Ĺ', 'ĺ', 'Ļ', 'ļ', 'Ľ', 'ľ', 'Ŀ', 'ŀ', 'Ł', 'ł', 'Ń', 'ń', 'Ņ', 'ņ', 'Ň', 'ň', 'ŉ', 'Ō', 'ō', 'Ŏ', 'ŏ', 'Ő', 'ő', 'Œ', 'œ', 'Ŕ', 'ŕ', 'Ŗ', 'ŗ', 'Ř', 'ř', 'Ś', 'ś', 'Ŝ', 'ŝ', 'Ş', 'ş', 'Š', 'š', 'Ţ', 'ţ', 'Ť', 'ť', 'Ŧ', 'ŧ', 'Ũ', 'ũ', 'Ū', 'ū', 'Ŭ', 'ŭ', 'Ů', 'ů', 'Ű', 'ű', 'Ų', 'ų', 'Ŵ', 'ŵ', 'Ŷ', 'ŷ', 'Ÿ', 'Ź', 'ź', 'Ż', 'ż', 'Ž', 'ž', 'ſ', 'ƒ', 'Ơ', 'ơ', 'Ư', 'ư', 'Ǎ', 'ǎ', 'Ǐ', 'ǐ', 'Ǒ', 'ǒ', 'Ǔ', 'ǔ', 'Ǖ', 'ǖ', 'Ǘ', 'ǘ', 'Ǚ', 'ǚ', 'Ǜ', 'ǜ', 'Ǻ', 'ǻ', 'Ǽ', 'ǽ', 'Ǿ', 'ǿ');
        $arReplace = array( 'A', 'A', 'A', 'A', 'A', 'A', 'AE', 'C', 'E', 'E', 'E', 'E', 'I', 'I', 'I', 'I', 'D', 'N', 'O', 'O', 'O', 'O', 'O', 'O', 'U', 'U', 'U', 'U', 'Y', 's', 'a', 'a', 'a', 'a', 'a', 'a', 'ae', 'c', 'e', 'e', 'e', 'e', 'i', 'i', 'i', 'i', 'n', 'o', 'o', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'u', 'y', 'y', 'A', 'a', 'A', 'a', 'A', 'a', 'C', 'c', 'C', 'c', 'C', 'c', 'C', 'c', 'D', 'd', 'D', 'd', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'G', 'g', 'G', 'g', 'G', 'g', 'G', 'g', 'H', 'h', 'H', 'h', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', 'IJ', 'ij', 'J', 'j', 'K', 'k', 'L', 'l', 'L', 'l', 'L', 'l', 'L', 'l', 'l', 'l', 'N', 'n', 'N', 'n', 'N', 'n', 'n', 'O', 'o', 'O', 'o', 'O', 'o', 'OE', 'oe', 'R', 'r', 'R', 'r', 'R', 'r', 'S', 's', 'S', 's', 'S', 's', 'S', 's', 'T', 't', 'T', 't', 'T', 't', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'W', 'w', 'Y', 'y', 'Y', 'Z', 'z', 'Z', 'z', 'Z', 'z', 's', 'f', 'O', 'o', 'U', 'u', 'A', 'a', 'I', 'i', 'O', 'o', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'A', 'a', 'AE', 'ae', 'O', 'o');
        return str_replace( $arSearch, $arReplace, $sPermalink );
    }

    public static function getPermalink( $sPermalink = NULL )
    {
        if( $sPermalink === NULL ) return FALSE;
        return strtolower( preg_replace( array( '/[^a-zA-Z0-9 -]/', '/[ -]+/', '/^-|-$/' ),
        array( '', '-', '' ), UtilsHelper::stripTildes( $sPermalink ) ) );
    }
    /*
     * Return a human readable date format
     * @param       int         $iEpoch
     * @return      mixed
     */
    public static function getHumanReadableDate( $iEpoch = NULL )
    {
        if( ( $iEpoch === NULL ) ||
            ( ! is_int( $iEpoch  ) ) )
        {
            return FALSE;
        }
        
        return date( 'Y/n/j', $iEpoch );
    }
    /*
     * Prepare an array of arrays for use in the form dropdown helper
     * @param   array   $arPrepend
     * @param   array   $arOptions
     * @param   string  $sKey
     * @param   string  $sValue
     * @return  array
     */
    public static function geOptionsDropdown( $arPrepend = array(),
        $arOptions = array(), $sKey = NULL, $sValue = NULL )
    {
        if( ( $sKey === NULL ) ||
            ( $sValue === NULL ) )
        {
            return array();
        }
        
        $arOptionsPrepared = array();
        
        if( sizeof( $arPrepend ) )
        {
            $arOptionsPrepared = $arPrepend;
        }
        
        foreach( $arOptions as $k => $v  )
        {
            if( ( ! isset( $v[$sKey] ) ) ||
                ( ! isset( $v[$sValue] ) ))
            {
                continue;
            }
            
            $arOptionsPrepared[$v[$sKey]] = $v[$sValue];
        }
        
        
        return $arOptionsPrepared;
        
    }
    
    /*
     * Iterate every array element searching for "is_unique" in the validation rules
     * @param   array   $arConfigValidations
     * @return  array   $arReturn
     */
    public static function getUniqueValidations( $arConfigValidations = array() )
    {
        if( ! sizeof( $arConfigValidations ) )
        {
            return FALSE;
        }
        
        $arReturn = array();
        $arValidationRules = array();
        $sRule = '';
        
        foreach( $arConfigValidations as $k => $arConfigValidation )
        {
            $arValidationRules = explode( '|', $arConfigValidation['rules'] );

            foreach( $arValidationRules as $sRule )
            {
                if( preg_match( '/^is_unique/', $sRule ) )
                {
                    $arReturn[$k] = $arConfigValidation;
                    continue;
                }
            }
            
            unset( $arConfigValidations[$k] );
        }
        
        return $arReturn;
        
    }
    /*
     * Wraps a string between tags
     * @param   string  $sToWrap
     * @param   int     $iLimit
     * @param   array   $arWrap
     * @param   string  $sEllipsis
     * @return  string
     */
    public static function getWrappedString( $sToWrap = NULL, $iLimit = 100, $arWrap = array( '<span class="ellipsis">', '</span>' ), $sEllipsis = '<a href="javascript:;"><i class="icon  icon-arrow-down"></i></a>' )
    {   
        $sToWrap = trim( $sToWrap );
        
        if( $sToWrap === '' )
        {
            return FALSE;
        }
        
        preg_match( '/^\s*+(?:\S++\s*+){1,'. ( int ) $iLimit.'}/', $sToWrap, $arMatches );
        
        $sLeft = $arMatches[0];
        
        if( strlen( $sToWrap ) === strlen( $sLeft ) )
        {
            return $sToWrap;
        }
        
        $sRight = str_replace( $sLeft, '', $sToWrap );
        
        return $sLeft . $arWrap[0] . $sRight . $arWrap[1] . $sEllipsis;
    }
}

/* End of file utils_helper.php */
/* Location: ./application/helpers/utils_helper.php */