<?php
/*
 * @author ggonzalez
 * @18 February 2013
 */

if ( ! defined('BASEPATH')) exit( 'No direct script access allowed' );

class State_model extends CI_Model
{
    private $sTable;
    
    public function __construct()
    {
        parent::__construct();
        $this->sTable = 'states';
    }
    /*
     * Get all the states
     */
    public function getAll()
    {
        $arStates = array();
        $arState = array();
        
        $this->db->select( '*' );
        $this->db->from( $this->sTable );
        $this->db->order_by( 'state_name', 'asc' );
        $oResult = $this->db->get();
        
        foreach( $oResult->result_array() as $arState )
        {
            $arStates[] = $arState;
        }
        
        return $arStates;
    }
}

/* End of file state_model.php */
/* Location: ./application/models/state_model.php */