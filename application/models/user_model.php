<?php
/*
 * @author ggonzalez
 * @3 March 2013
 */

if ( ! defined('BASEPATH')) exit( 'No direct script access allowed' );

class User_model extends CI_Model
{
    private $sTable;
    
    public function __construct()
    {
        parent::__construct();
        $this->sTable = 'users';
    }
    /*
     * Get all users ordered by name
     * @return  array   $arUsers
     */
    public function getAllUsers()
    {
        $arUsers = array();
        $arUser = array();
        
        $this->db->select( '*' );
        $this->db->from( $this->sTable );
        $this->db->order_by( 'nombre', 'asc' );
        
        $oResult = $this->db->get();
        
        foreach( $oResult->result_array() as $arUser )
        {
            $arUsers[] = $arUser;
        }
        
        return $arUsers;
    }
    /*
     * Get a username
     * @param   $sUsername
     * @return  mixed
     */
    public function getUserByUsername( $sUsername = NULL )
    {
        
        if( $sUsername === NULL )
        {
            return FALSE;
        }
        
        $this->db->select( '*' );
        $this->db->from( $this->sTable );
        $this->db->where( 'username', $sUsername );
        
        $oResult = $this->db->get();
        
        return $oResult->row_array();
    }
}

/* End of file user_model.php */
/* Location: ./application/models/user_model.php */