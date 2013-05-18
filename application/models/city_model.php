<?php
/*
 * @author ggonzalez
 * @18 February 2013
 */

if ( ! defined('BASEPATH')) exit( 'No direct script access allowed' );

class City_model extends CI_Model
{
    private $sTable;
    
    public function __construct()
    {
        parent::__construct();
        $this->sTable = 'cities';
    }
    /*
     * Get all the cities by state id
     * @param   int     $iStateId
     * @return  array   $arCities
     */
    public function getByStateid( $iStateId = NULL )
    {
        if( ( $iStateId === NULL ) ||
            ( ! is_int( $iStateId ) ) )
        {
            return FALSE;
        }
        
        $arCities = array();
        $arCity = array();
        
        $this->db->select( '*' );
        $this->db->from( $this->sTable );
        $this->db->where( array( 'state_id' => $iStateId ) );
        $this->db->order_by( 'city_name', 'asc' );
        $oResult = $this->db->get();
        
        foreach( $oResult->result_array() as $arCity )
        {
            $arCities[] = $arCity;
        }
        
        return $arCities;
    }
}

/* End of file city_model.php */
/* Location: ./application/models/city_model.php */