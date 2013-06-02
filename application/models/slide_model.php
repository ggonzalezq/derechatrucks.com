<?php
/*
 * @author  ggonzalez
 * @date    1 June 2013
 */

if ( ! defined('BASEPATH')) exit( 'No direct script access allowed' );

class Slide_model extends CI_Model
{
    private $sTable;
    
    public function __construct()
    {
        parent::__construct();
        $this->sTable = 'slides';
    }
    public function deleteSlide( $iSlideId = NULL  )
    {
        if( ( $iSlideId === NULL ) ||
            ( ! is_int( $iSlideId ) ) )
        {
            return FALSE;
        }
        
        $this->db->where( 'slide_id', $iSlideId );
        return $this->db->delete( $this->sTable );
    }
    public function getCountSlides( $sLike = NULL, $iSlideActive = NULL )
    {
        if( $sLike )
        {
            $sLike = $this->db->escape_like_str( $sLike );
            $this->db->where( '( slides.slide_title like \'%' . $sLike . '%\' )' );
        }
        if( ( $iSlideActive === 0 ) ||
            ( $iSlideActive === 1 ) )
        {
            $this->db->where( array( 'slides.slide_active' => $iSlideActive ) );
        }
        
        return $this->db->count_all_results( $this->sTable );
    }
    public function insertSlide( $arSlide = array() )
    {
        if( ! sizeof( $arSlide ) )
        {
            return FALSE;
        }
        
        $this->db->insert( $this->sTable, $arSlide );
        return $this->db->insert_id();
    }
    public function getSlides( $iLimit = NULL, $iOffset = NULL, $sLike = NULL, $iSlideActive = NULL )
    {
        $arSlides = array();
        $arSlide = array();
        
        $this->db->select( 'slides.*' );
        $this->db->from( $this->sTable );
        
        $this->db->order_by( 'slides.slide_changed', 'desc' );
        
        if( $iLimit )
        {
            $this->db->limit( $iLimit, $iOffset );
        }
        if( $sLike )
        {
            $sLike = $this->db->escape_like_str( $sLike );
            $this->db->where( '( slides.slide_title like \'%' . $sLike . '%\' )' );
        }
        if( ( $iSlideActive === 0 ) ||
            ( $iSlideActive === 1 ) )
        {
            $this->db->where( array( 'slides.slide_active' => $iSlideActive ) );
        }
        
        $oResult = $this->db->get();
        
        foreach( $oResult->result_array() as $arSlide )
        {
            $arSlides[] = $arSlide;
        }
        
        return $arSlides;
    }
    public function getSlideById( $iSlideId )
    {
        if( ! is_int( $iSlideId ) )
        {
            return FALSE;
        }
        
        $this->db->select( '*' );
        $this->db->from( $this->sTable );
        $this->db->where( array( 'slide_id' => $iSlideId ) );
        $oResult = $this->db->get();
        
        return $oResult->row_array();
    }
    public function updateSlide( $arSlide = NULL, $iSlideId = NULL  )
    {
        if( ( $arSlide === NULL ) ||
            ( ! is_array( $arSlide ) ) ||
            ( $iSlideId === NULL ) ||
            ( ! is_int( $iSlideId ) ) )
        {
            return FALSE;
        }
        
        $this->db->where( 'slide_id', $iSlideId );
        return $this->db->update( $this->sTable, $arSlide );
    }
}

/* End of file slide_model.php */
/* Location: ./application/models/slide_model.php */