<?php
/*
 * @author  ggonzalez
 * @date    18 March 2013
 */

if ( ! defined('BASEPATH')) exit( 'No direct script access allowed' );

class Picture_model extends CI_Model
{
    private $sTable;
    
    public function __construct()
    {
        parent::__construct();
        $this->sTable = 'pictures';
    }
    /*
     * Delete an article
     * @param   int     $iPictureId
     * @return  bool
     */
    public function delete( $iPictureId = NULL  )
    {
        if( ( $iPictureId === NULL ) ||
            ( ! is_int( $iPictureId ) ) )
        {
            return FALSE;
        }
        
        $this->db->where( 'pictures.picture_id', $iPictureId );
        return $this->db->delete( $this->sTable );
    }
    /*
     * Get all pictures by article_id
     * @param   int     $iArticleId
     * @return  mixed   boolean / array
     */
    public function getByArticleId( $iArticleId = NULL )
    {
        if( ! is_int( $iArticleId ) )
        {
            return FALSE;
        }
        
        $arPictures = array();
        $arPicture= array();
        
        $this->db->select( '*' );
        $this->db->from( $this->sTable );
        $this->db->where( array( 'article_id' => $iArticleId ) );
        $this->db->order_by( 'picture_changed', 'desc' );
        $oResult = $this->db->get();
        
        foreach( $oResult->result_array() as $arPicture )
        {
            $arPictures[] = $arPicture;
        }
        
        return $arPictures;
    }
    /*
     * Get a picture by picture_id
     * @param   int     $iPictureId
     * @return  mixed   boolean / array
     */
    public function getById( $iPictureId = NULL )
    {
        if( ! is_int( $iPictureId ) )
        {
            return FALSE;
        }
        $this->db->select( '*' );
        $this->db->from( $this->sTable );
        $this->db->where( array( 'picture_id' => $iPictureId ) );
        $oResult = $this->db->get();
        return $oResult->row_array();
    }
    public function getByPicturePreview( $iArticleId = NULL )
    {
        if( $iArticleId === NULL )
        {
            return FALSE;
        }
        
        $this->db->select( '*' );
        $this->db->from( $this->sTable );
        $this->db->where( array( 'article_id' => $iArticleId ) );
        $this->db->where( array( 'picture_preview' => 1 ) );
        $oResult = $this->db->get();
        return $oResult->row_array();
    }
    /*
     * Insert a picture
     * @param   array   $arPicture
     * @return  mixed   boolean / int
     */
    public function insert( $arPicture = array() )
    {
        if( ! sizeof( $arPicture ) )
        {
            return FALSE;
        }
        
        $this->db->insert( $this->sTable, $arPicture );
        return $this->db->insert_id();
    }
    /*
     * 
     */
    public function preview( $iPictureId = NULL, $iArticleId = NULL )
    {
        if( ( $iPictureId === NULL ) || 
            ( $iArticleId === NULL ) )
        {
            return FALSE;
        }

        $this->db->where( 'article_id', $iArticleId );
        $this->db->update( $this->sTable, array(
            'picture_preview' => 0
        ) );
        $this->db->where( 'picture_id', $iPictureId );
        $this->db->update( $this->sTable, array(
            'picture_preview' => 1
        ) );
        
        return TRUE;
    }
    /*
     * Update a picture
     * @param   array   $arPicture
     * @param   int     $iPictureId
     * @return  boolean
     */
    public function update( $arPicture = NULL, $iPictureId = NULL  )
    {
        if( ( $arPicture === NULL ) ||
            ( ! is_array( $arPicture ) ) ||
            ( $iPictureId === NULL ) ||
            ( ! is_int( $iPictureId ) ) )
        {
            return FALSE;
        }
        
        $this->db->where( 'picture_id', $iPictureId );
        return $this->db->update( $this->sTable, $arPicture );
    }
}

/* End of file picture_model.php */
/* Location: ./application/models/picture_model.php */