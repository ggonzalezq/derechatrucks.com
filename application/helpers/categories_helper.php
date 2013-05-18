<?php
/*
 * @author  ggonzalez
 * @date    12 March 2013
 */

if ( ! defined('BASEPATH')) exit( 'No direct script access allowed' );


class CategoriesHelper
{
    /*
     * Add levels in the name of the categories e.g.
     * Category name
     * — Category name
     * —— Category name
     * ——— Category name
     * * Category name
     * 
     * @param   array   $arCategories
     * @param   int     $iDepth
     * @param   string  $sRepeat
     * @return  array   $arReturnCategories
     */
    public static function getCategoriesLeveled( $arCategories = array(), $iDepth = 0, $sRepeat = '&#8212' )
    {   
        if( ( ! is_array( $arCategories ) ) ||
            ( ! sizeof( $arCategories ) ) )
        {
            return array();
        }
        
        $arReturnCategories = array();
        
        foreach( $arCategories as $k => $arCategory )
        {   
            $arReturnCategories[$k]['category_id'] = $arCategory['category_id'];
            $arReturnCategories[$k]['category_changed'] = $arCategory['category_changed'];
            $arReturnCategories[$k]['category_created'] = $arCategory['category_created'];
            $arReturnCategories[$k]['category_name'] = str_repeat( $sRepeat, $iDepth );
            
            if( $iDepth !== 0 )
            {
                $arReturnCategories[$k]['category_name'] .= ' ';
            }
            
            $arReturnCategories[$k]['category_name'] .= $arCategory['category_name'];
            $arReturnCategories[$k]['category_parent'] = $arCategory['category_parent'];
            $arReturnCategories[$k]['category_permalink'] = $arCategory['category_permalink'];
            
            if( isset( $arCategory['children'] ) )
            {
                $arReturnCategories = array_merge( 
                    $arReturnCategories, 
                    CategoriesHelper::getCategoriesLeveled( $arCategory['children'], $iDepth + 1, $sRepeat )
                );
            }
        }
        
        return $arReturnCategories;
    }
    /*
     * Convert an array of categories into a parent child structure
     * @param   array   $arCategories
     * @return  array   $arCategoriesTree
     */
    public static function getCategoriesTree( $arCategories = array() )
    {
        if( ( ! is_array( $arCategories ) ) ||
            ( ! sizeof( $arCategories ) ) )
        {
            return array();
        }   
        
        $arCategory = array();
        $arCategoriesTree = array();
        $arReference = array();
        $arThisReference = array();

        foreach( $arCategories as $arCategory )
        {
            $arThisReference = &$arReference[ $arCategory['category_id'] ];
            $arThisReference['category_id'] = $arCategory['category_id'];
            $arThisReference['category_changed'] = $arCategory['category_changed'];
            $arThisReference['category_created'] = $arCategory['category_created'];
            $arThisReference['category_name'] = $arCategory['category_name'];
            $arThisReference['category_parent'] = $arCategory['category_parent'];
            $arThisReference['category_permalink'] = $arCategory['category_permalink'];

            if ( $arCategory['category_parent'] == 0 )
            {
                $arCategoriesTree[ $arCategory['category_id'] ] = &$arThisReference;
            }
            else
            {
                $arReference[$arCategory['category_parent']]['children'][ $arCategory['category_id'] ] = &$arThisReference;
            }
        }

        return $arCategoriesTree;
    }
}

/* End of file categories_helper.php */
/* Location: ./application/helpers/categories_helper.php */