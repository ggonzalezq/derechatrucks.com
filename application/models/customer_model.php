<?php
/*
 * @author ggonzalez
 * @18 February 2013
 */

if ( ! defined('BASEPATH')) exit( 'No direct script access allowed' );

class Customer_model extends CI_Model
{
    private $sTable;
    
    public function __construct()
    {
        parent::__construct();
        $this->sTable = 'customers';
    }
    /*
     * Delete a customer
     * @param   int     $iCustomerId
     * @return  bool
     */
    public function delete( $iCustomerId = NULL  )
    {
        if( ( $iCustomerId === NULL ) ||
            ( ! is_int( $iCustomerId ) ) )
        {
            return FALSE;
        }
        
        $this->db->where( 'customers.customer_id', $iCustomerId );
        return $this->db->delete( $this->sTable );
    }
    /*
     * Get a customer by customer_email
     * @param   string  $sCustomerEmail
     * @return  array   $arCustomer
     */    
    public function getByCustomerEmail( $sCustomerEmail = NULL )
    {
        if( ! $sCustomerEmail )
        {
            return FALSE;
        }
        
        $arCustomer= array();

        $this->db->select( 'customers.*, cities.*, states.*, users.*' );
        $this->db->from( $this->sTable );
        $this->db->join( 'cities', 'customers.city_id = cities.city_id', 'left' );
        $this->db->join( 'states', 'customers.state_id = states.state_id', 'left' );
        $this->db->join( 'users', 'customers.user_id = users.id', 'left' );
        $this->db->where( array( 'customers.customer_email' => $sCustomerEmail ) );
        
        $oResult = $this->db->get();
        $arCustomer = $oResult->row_array();
        
        return $arCustomer;   
    }
    /*
     * Get a customer by customer_id
     * @param   int     $iCustomerId
     * @return  array   $arCustomer
     */
    public function getByCustomerid( $iCustomerId = NULL )
    {
        if( ( $iCustomerId === NULL ) ||
            ( ! is_int( $iCustomerId ) ) )
        {
            return FALSE;
        }
        
        $arCustomer= array();

        $this->db->select( 'customers.*, cities.*, states.*, users.*' );
        $this->db->from( $this->sTable );
        $this->db->join( 'cities', 'customers.city_id = cities.city_id', 'left' );
        $this->db->join( 'states', 'customers.state_id = states.state_id', 'left' );
        $this->db->join( 'users', 'customers.user_id = users.id', 'left' );
        $this->db->where( array( 'customers.customer_id' => $iCustomerId ) );
        
        $oResult = $this->db->get();
        $arCustomer = $oResult->row_array();
        
        return $arCustomer;
    }
    /*
     * Get a customer by customer_mobile
     * @param   string  $sCustomerMobile
     * @return  array   $arCustomer
     */
    public function getByCustomerMobile( $sCustomerMobile = NULL )
    {
        if( ! $sCustomerMobile )
        {
            return FALSE;
        }
        
        $arCustomer= array();

        $this->db->select( 'customers.*, cities.*, states.*, users.*' );
        $this->db->from( $this->sTable );
        $this->db->join( 'cities', 'customers.city_id = cities.city_id', 'left' );
        $this->db->join( 'states', 'customers.state_id = states.state_id', 'left' );
        $this->db->join( 'users', 'customers.user_id = users.id', 'left' );
        $this->db->where( array( 'customers.customer_mobile' => $sCustomerMobile ) );
        
        $oResult = $this->db->get();
        $arCustomer = $oResult->row_array();
        
        return $arCustomer;   
    }
    /*
     * Get a customer by customer_name
     * @param   string  $sCustomerName
     * @return  array   $arCustomer
     */
    public function getByCustomerName( $sCustomerName = NULL )
    {
        if( ! $sCustomerName )
        {
            return FALSE;
        }
        
        $arCustomer= array();

        $this->db->select( 'customers.*, cities.*, states.*, users.*' );
        $this->db->from( $this->sTable );
        $this->db->join( 'cities', 'customers.city_id = cities.city_id', 'left' );
        $this->db->join( 'states', 'customers.state_id = states.state_id', 'left' );
        $this->db->join( 'users', 'customers.user_id = users.id', 'left' );
        $this->db->where( array( 'customers.customer_name' => $sCustomerName ) );
        
        $oResult = $this->db->get();
        $arCustomer = $oResult->row_array();
        
        return $arCustomer;   
    }
    /*
     * Get a customer by customer_nextel
     * @param   string  $sCustomerNextel
     * @return  array   $arCustomer
     */
    public function getByCustomerNextel( $sCustomerNextel = NULL )
    {
        if( ! $sCustomerNextel )
        {
            return FALSE;
        }
        
        $arCustomer= array();

        $this->db->select( 'customers.*, cities.*, states.*, users.*' );
        $this->db->from( $this->sTable );
        $this->db->join( 'cities', 'customers.city_id = cities.city_id', 'left' );
        $this->db->join( 'states', 'customers.state_id = states.state_id', 'left' );
        $this->db->join( 'users', 'customers.user_id = users.id', 'left' );
        $this->db->where( array( 'customers.customer_nextel' => $sCustomerNextel ) );
        
        $oResult = $this->db->get();
        $arCustomer = $oResult->row_array();
        
        return $arCustomer;   
    }
    /*
     * Get a customer by customer_telephone
     * @param   string  $sCustomerTelephone
     * @return  array   $arCustomer
     */
    public function getByCustomerTelephone( $sCustomerTelephone = NULL )
    {
        if( ! $sCustomerTelephone )
        {
            return FALSE;
        }
        
        $arCustomer= array();

        $this->db->select( 'customers.*, cities.*, states.*, users.*' );
        $this->db->from( $this->sTable );
        $this->db->join( 'cities', 'customers.city_id = cities.city_id', 'left' );
        $this->db->join( 'states', 'customers.state_id = states.state_id', 'left' );
        $this->db->join( 'users', 'customers.user_id = users.id', 'left' );
        $this->db->where( array( 'customers.customer_telephone' => $sCustomerTelephone ) );
        
        $oResult = $this->db->get();
        $arCustomer = $oResult->row_array();
        
        return $arCustomer; 
    }
    /*
     * Get the number of customers inserted
     * @param   string  $sLike
     * @param   int     $iUserId
     * @param   int     $iStateId
     * @return  int     
     */
    public function getCount( $sLike = NULL, $iUserId = NULL, $iStateId = NULL )
    {   
        if( $iUserId )
        {
            $this->db->where( 'customers.user_id', $iUserId );
        }
        
        if( $iStateId )
        {
            $this->db->where( 'customers.state_id', $iStateId );
        }
        
        if( $sLike )
        {
            $sLike = $this->db->escape_like_str( $sLike );
            $this->db->where( '(
                customers.customer_name like \'%' . $sLike . '%\' or
                customers.customer_telephone like \'%' . $sLike . '%\' or
                customers.customer_mobile like \'%' . $sLike . '%\' or
                customers.customer_nextel like \'%' . $sLike . '%\' or
                customers.customer_email like \'%' . $sLike . '%\'
            )' );
        }
        
//        //Bug codeigniter
//        //http://stackoverflow.com/questions/8915599/how-to-group-where-clauses-with-active-record
//        if( $sLike )
//        {
//            $this->db->or_like( array(
//                'customers.customer_name' => $sLike,
//                'customers.customer_telephone' => $sLike,
//                'customers.customer_mobile' => $sLike,
//                'customers.customer_nextel' => $sLike,
//                'customers.customer_email' => $sLike
//            ) );
//        }
        
        return $this->db->count_all_results( $this->sTable );
    }
    /*
     * Get all the data related with the customers
     * @param   int     $iLimit
     * @param   int     $iOffset
     * @param   string  $sLike
     * @param   int     $iUserId
     * @param   int     $iStateId
     * @param   string  $sOrderBy
     * @return  array   $arCustomers
     */
    public function getCustomers(
        $iLimit = NULL,
        $iOffset = NULL,
        $sLike = NULL,
        $iUserId = NULL,
        $iStateId = NULL,
        $sOrderBy = NULL
    )
    {
        $arCustomers = array();
        $arCustomer = array();
        
        $this->db->select( 'customers.*, cities.*, states.*, users.*' );
        $this->db->from( $this->sTable );
        $this->db->join( 'cities', 'customers.city_id = cities.city_id', 'left' );
        $this->db->join( 'states', 'customers.state_id = states.state_id', 'left' );
        $this->db->join( 'users', 'customers.user_id = users.id', 'left' );
        
        if( $iUserId )
        {
            $this->db->where( 'customers.user_id', $iUserId );
        }
        
        if( $iStateId )
        {
            $this->db->where( 'customers.state_id', $iStateId );
        }
        
        if( $sLike )
        {
            $sLike = $this->db->escape_like_str( $sLike );
            $this->db->where( '(
                customers.customer_name like \'%' . $sLike . '%\' or
                customers.customer_telephone like \'%' . $sLike . '%\' or
                customers.customer_mobile like \'%' . $sLike . '%\' or
                customers.customer_nextel like \'%' . $sLike . '%\' or
                customers.customer_email like \'%' . $sLike . '%\'
            )' );
        }
        
//        //Bug codeigniter
//        //http://stackoverflow.com/questions/8915599/how-to-group-where-clauses-with-active-record
//        if( $sLike )
//        {
//            $this->db->or_like( array(
//                'customers.customer_name' => $sLike,
//                'customers.customer_telephone' => $sLike,
//                'customers.customer_mobile' => $sLike,
//                'customers.customer_nextel' => $sLike,
//                'customers.customer_email' => $sLike
//            ) );
//        }
        
        if( $sOrderBy )
        {
            $this->db->order_by( $sOrderBy );
        }
        else
        {
            $this->db->order_by( 'customers.customer_changed', 'desc' );
        }
        
        if( $iLimit )
        {
            $this->db->limit( $iLimit, $iOffset );
        }
        
        $oResult = $this->db->get();
        
        foreach( $oResult->result_array() as $arCustomer )
        {
            $arCustomers[] = $arCustomer;
        }
        
        return $arCustomers;
    }
    
    /*
     * Gell the count of customers  by state
     * @param   int     $iStateId
     * @param   int     $iCityId
     * @param   int     $iUserId
     * @return  array   $arCustomers
     */
    public function getCustomersTotalGroupedByState( $iStateId, $iCityId, $iUserId )
    {
        $arCustomers = array();
        $arCustomer = array();
        
        $this->db->select( 'count( customers.state_id ) as customer_total, customers.*, cities.*, states.*, users.*' );
        $this->db->from( $this->sTable );
        $this->db->join( 'cities', 'customers.city_id = cities.city_id', 'left' );
        $this->db->join( 'states', 'customers.state_id = states.state_id', 'left' );
        $this->db->join( 'users', 'customers.user_id = users.id', 'left' );
        
        if( $iStateId )
        {
            $this->db->where( 'customers.state_id', $iStateId );
        }
        
        if( $iCityId )
        {
            $this->db->where( 'customers.city_id', $iCityId );
        }
        
        if( $iUserId )
        {
            $this->db->where( 'customers.user_id', $iUserId );
        }
        
        $this->db->group_by( 'customers.state_id' );
        $this->db->order_by( 'customer_total desc, states.state_name asc' );
        
        $oResult = $this->db->get();
        
        foreach( $oResult->result_array() as $arCustomer )
        {
            $arCustomers[] = $arCustomer;
        }
        
        return $arCustomers;
        
    }
    /*
     * Gell the count of customers  by city_id
     * @param   int     $iStateId
     * @param   int     $iCityId
     * @param   int     $iUserId
     * @return  array   $arCustomers
     */
    public function getCustomersTotalGroupedByCity( $iStateId, $iCityId, $iUserId )
    {
        $arCustomers = array();
        $arCustomer = array();
        
        $this->db->select( 'count( customers.state_id ) as customer_total, customers.*, cities.*, states.*, users.*' );
        $this->db->from( $this->sTable );
        $this->db->join( 'cities', 'customers.city_id = cities.city_id', 'left' );
        $this->db->join( 'states', 'customers.state_id = states.state_id', 'left' );
        $this->db->join( 'users', 'customers.user_id = users.id', 'left' );
        
        if( $iStateId )
        {
            $this->db->where( 'customers.state_id', $iStateId );
        }
        
        if( $iCityId )
        {
            $this->db->where( 'customers.city_id', $iCityId );
        }
        
        if( $iUserId )
        {
            $this->db->where( 'customers.user_id', $iUserId );
        }
        
        $this->db->group_by( 'customers.city_id' );
        $this->db->order_by( 'customer_total desc, cities.city_name asc' );
        
        $oResult = $this->db->get();
        
        foreach( $oResult->result_array() as $arCustomer )
        {
            $arCustomers[] = $arCustomer;
        }
        
        return $arCustomers;
        
    }
    /*
     * Gell the count of customers  by media
     * @param   int     $iStateId
     * @param   int     $iCityId
     * @param   int     $iUserId
     * @return  array   $arCustomers
     */
    public function getCustomersTotalGroupedByMedia( $iStateId, $iCityId, $iUserId )
    {
        $arCustomers = array();
        $arCustomer = array();
        
        $this->db->select( 'count( customers.customer_media ) as customer_media_total, customers.*, cities.*, states.*, users.*' );
        $this->db->from( $this->sTable );
        $this->db->join( 'cities', 'customers.city_id = cities.city_id', 'left' );
        $this->db->join( 'states', 'customers.state_id = states.state_id', 'left' );
        $this->db->join( 'users', 'customers.user_id = users.id', 'left' );
        
        if( $iStateId )
        {
            $this->db->where( 'customers.state_id', $iStateId );
        }
        
        if( $iCityId )
        {
            $this->db->where( 'customers.city_id', $iCityId );
        }
        
        if( $iUserId )
        {
            $this->db->where( 'customers.user_id', $iUserId );
        }
        
        $this->db->group_by( 'customers.customer_media' );
        $this->db->order_by( 'customer_media_total', 'desc' );
        
        $oResult = $this->db->get();
        
        foreach( $oResult->result_array() as $arCustomer )
        {
            $arCustomers[] = $arCustomer;
        }
        
        return $arCustomers;
        
    }
    
    /*
     * Insert a customer and return the last inserted id
     * @param   array   $arCustomer
     * @return  int     
     */
    public function insert( $arCustomer = array() )
    {
        if( ! sizeof( $arCustomer ) )
        {
            return FALSE;
        }
        
        $this->db->insert( $this->sTable, $arCustomer );
        return $this->db->insert_id();
    }
    /*
     * Update a customer
     * @param   array   $arCustomer
     * @param   int     $iCustomerId
     * @return  bool
     */
    public function update( $arCustomer = NULL, $iCustomerId = NULL  )
    {
        if( ( $arCustomer === NULL ) ||
            ( ! is_array( $arCustomer ) ) ||
            ( $iCustomerId === NULL ) ||
            ( ! is_int( $iCustomerId ) ) )
        {
            return FALSE;
        }
        
        $this->db->where( 'customers.customer_id', $iCustomerId );
        return $this->db->update( $this->sTable, $arCustomer );
    }
}

/* End of file customer_model.php */
/* Location: ./application/models/customer_model.php */