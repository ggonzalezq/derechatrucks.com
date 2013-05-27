<?php
/*
 * @author ggonzalez
 * @29 October 2012
 */

if ( ! defined('BASEPATH')) exit( 'No direct script access allowed' );

class Category_model extends CI_Model
{
    private $sTable;
    
    public function __construct()
    {
        parent::__construct();
        $this->sTable = 'categories';
    }
    /*
     * Delete a category
     * @param   int     $iCategoryId
     * @return  bool
     */
    public function delete( $iCategoryId = NULL  )
    {
        if( ( $iCategoryId === NULL ) ||
            ( ! is_int( $iCategoryId ) ) )
        {
            return FALSE;
        }
        
        $this->db->where( 'category_id', $iCategoryId );
        return $this->db->delete( $this->sTable );
    }
    /*
     * Insert a category
     * @date    12 March 2013
     * @param   array   $arCategory
     * @return  mixed   
     */
    public function insert( $arCategory = array() )
    {
        if( ! sizeof( $arCategory ) )
        {
            return FALSE;
        }
        
        $this->db->insert( $this->sTable, $arCategory );
        return $this->db->insert_id();
    }
    /*
     * Get all the categories
     * @date    12 March 2013
     * @return  array   $arCategories
     */    
    public function getCategories()
    {
        $arCategories = array();
        $arCategory = array();
        
        $this->db->select( '*' );
        $this->db->from( $this->sTable );
        
        $this->db->order_by( 'category_parent asc, category_name asc' );
        
        $oResult = $this->db->get();
        
        foreach( $oResult->result_array() as $arCategory )
        {
            $arCategories[] = $arCategory;
        }
        
        return $arCategories;
    }
    /*
     * Get a category by category_id
     * @param   int     $iCategoryId
     * @return  array
     */
    public function getById( $iCategoryId )
    {
        
        if( ! is_int( $iCategoryId ) )
        {
            return FALSE;
        }
        
        $this->db->select( '*' );
        $this->db->from( $this->sTable );
        $this->db->where( array( 'category_id' => $iCategoryId ) );
        $oResult = $this->db->get();
        
        return $oResult->row_array();
    }
    /*
     * Update a category
     * @param   array   $arCategory
     * @param   int     $iCategoryId
     * @return  bool
     */
    public function update( $arCategory = NULL, $iCustomerId = NULL  )
    {
        if( ( $arCategory === NULL ) ||
            ( ! is_array( $arCategory ) ) ||
            ( $iCustomerId === NULL ) ||
            ( ! is_int( $iCustomerId ) ) )
        {
            return FALSE;
        }
        
        $this->db->where( 'category_id', $iCustomerId );
        return $this->db->update( $this->sTable, $arCategory );
    }
}

/* End of file category_model.php */
/* Location: ./application/models/category_model.php */