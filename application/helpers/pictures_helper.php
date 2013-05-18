<?php
/*
 * @author ggonzalez
 * @18 March 2013
 */

if ( ! defined('BASEPATH')) exit( 'No direct script access allowed' );


class PicturesHelper
{
    /*
     * Create a directory if not exists
     * @param   string      $sDirectory
     * @return  boolean
     */
    public function makeDirectory( $sDirectory = NULL )
    {
        if( $sDirectory === NULL )
        {
            return FALSE;
        }
        if( ! file_exists( $sDirectory ) )
        {
            mkdir( $sDirectory );
        }
        return TRUE;
    }
    /*
     * Create the directories for save the images
     * @param   string  $sPath
     * @return  boolean 
     */
    public static function makeResizeDirectories( $sPath = NULL )
    {
        if( $sPath === NULL )
        {
            return FALSE;
        }
        
        $arDirectories = array(
            $sPath . '/thumbnail',
            $sPath . '/small',
            $sPath . '/medium',
            $sPath . '/large',
        );
        
        foreach( $arDirectories as $k => $v )
        {
            PicturesHelper::makeDirectory( $v );
        }
        
        return TRUE;
    }
//    
//    public static function getConfigResizeImages( $sPath, $sName )
//    {   
//        return array(
//            array( 'height' => 150, 'new_image' => $sPath . '/thumbnail/' . $sName, 'width' => 150 ),
//            array( 'height' => 300, 'new_image' => $sPath . '/small/' . $sName, 'width' => 400 ),
//            array( 'height' => 450, 'new_image' => $sPath . '/medium/' . $sName, 'width' => 600 ),
//            array( 'height' => 600, 'new_image' => $sPath . '/large/' . $sName, 'width' => 800 ),
//        );
//    }
}

/* End of file articles_helper.php */
/* Location: ./application/helpers/articles_helper.php */