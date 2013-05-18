<?php
/*
 * @author  ggonzalez
 * @date    13 March 2012
 */

if ( ! defined('BASEPATH')) exit( 'No direct script access allowed' );


class GroupsHelper
{
    /*
     * Convert an array of objects to a simple array ready for use in the form dropdown helper
     * @param   array   $arGroups
     * @return  array   $arReturnGroups
     */
    public static function getGroupsDropdown( $arGroups = array() )
    {
        if( ! sizeof( $arGroups ) )
        {
            return array();
        }
        
        $arReturnGroups = array();
        $arReturnGroups[] = 'Seleccione';
        
        foreach( $arGroups as $k => $oGroup )
        {
            $arReturnGroups[$oGroup->id] = $oGroup->description;
        }
        
        return $arReturnGroups;
        
    }
}

/* End of file groups_helper.php */
/* Location: ./application/helpers/groups_helper.php */