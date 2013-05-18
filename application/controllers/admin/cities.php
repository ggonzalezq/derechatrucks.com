<?php
/*
 * @author ggonzalez
 * @18 February 2013
 */

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cities extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }
    /*
     * Return all the cities from a given state id as json
     * @param   int     $iStateId
     * @return  array   $arCities 
     */
    public function getCities( $iStateId )
    {
        $this->load->model( 'City_model', 'oCities' );
        
        $arCities = array();
        $iStateId = ( int ) $iStateId;
        
        $arCities = $this->oCities->getByStateid( $iStateId );
        
        $this->output->set_content_type( 'application/json' )->set_output( json_encode( $arCities ) );
    }
}

/* End of file cities.php */
/* Location: ./application/controllers/admin/cities.php */