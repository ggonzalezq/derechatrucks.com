<?php
/*
 * @author ggonzalez
 * @25 February 2013
 */

if ( ! defined('BASEPATH')) exit( 'No direct script access allowed' );

class Purchase_model extends CI_Model
{
    private $sTable;
    
    public function __construct()
    {
        parent::__construct();
        $this->sTable = 'purchases';
    }
    /*
     * Delete a purchase
     * @param   int     $iPurchaseId
     * @return  bool
     */
    public function delete( $iPurchaseId = NULL  )
    {
        if( ( $iPurchaseId === NULL ) ||
            ( ! is_int( $iPurchaseId ) ) )
        {
            return FALSE;
        }
        
        $this->db->where( 'purchase_id', $iPurchaseId );
        return $this->db->delete( $this->sTable );
    }
    /*
     * Delete purchases by customer_id
     * @param   int     $iCustomerId
     * @return  bool
     */
    public function deleteByCustomerId( $iCustomerId = NULL  )
    {
        if( ( $iCustomerId === NULL ) ||
            ( ! is_int( $iCustomerId ) ) )
        {
            return FALSE;
        }
        
        $this->db->where( 'customer_id', $iCustomerId );
        return $this->db->delete( $this->sTable );
    }
    /*
     * Get a purchase
     * @param   int     $iPurchaseId
     * @return  array   $arCustomer
     */
    public function getByPurchaseid( $iPurchaseId = NULL )
    {
        if( ( $iPurchaseId === NULL ) ||
            ( ! is_int( $iPurchaseId ) ) )
        {
            return FALSE;
        }
        
        $arPurchase= array();
        
        $this->db->select( 'purchases.*, articles.*, customers.*' );
        $this->db->from( $this->sTable );
        $this->db->join( 'articles', 'purchases.article_id = articles.article_id', 'left' );
        $this->db->join( 'customers', 'purchases.customer_id = customers.customer_id', 'left' );
        $this->db->where( array( 'purchases.purchase_id' => $iPurchaseId ) );
        
        $oResult = $this->db->get();
        $arPurchase = $oResult->row_array();
        
        return $arPurchase;
    }
    /*
     * Get the number of purchases inserted
     * @param   int     $iCustomerId
     * @return  int     
     */
    public function getCount( $iCustomerId = NULL )
    {
        if( ( $iCustomerId !== NULL ) &&
            ( ! is_int( $iCustomerId ) ) )
        {
            return FALSE;
        }
        
        $iCustomerId = ( int ) $iCustomerId;
        
        if( $iCustomerId )
        {
            $this->db->where( array( 'customer_id' => $iCustomerId ) );
        }
        
        return $this->db->count_all_results( $this->sTable );
    }
    /*
     * Get all the data related with the purchases
     * @return  array   $arPurchases
     */
    public function getPurchases( $iLimit = NULL, $iOffset = NULL, $iCustomerId = NULL )
    {   
        $arPurchases = array();
        $arPurchase = array();
        
        $this->db->select( 'purchases.*, articles.*, customers.*' );
        $this->db->from( $this->sTable );
        $this->db->join( 'articles', 'purchases.article_id = articles.article_id', 'left' );
        $this->db->join( 'customers', 'purchases.customer_id = customers.customer_id', 'left' );
        
        $iCustomerId = ( int ) $iCustomerId;
        
        if( $iCustomerId )
        {
            $this->db->where( array( 'purchases.customer_id' => $iCustomerId ) );
        }
        
        $this->db->order_by( 'purchases.purchase_changed', 'desc' );
        
        if( ( $iLimit ) )
        {
            $this->db->limit( $iLimit, $iOffset );
        }
        
        
        $oResult = $this->db->get();
        
        foreach( $oResult->result_array() as $arPurchase )
        {
            $arPurchases[] = $arPurchase;
        }
        
        return $arPurchases;
    }
    /*
     * Gell the count of purchases by status
     * @param   int     $iStateId
     * @param   int     $iCityId
     * @param   int     $iUserId
     * @return  array   $arPurchases
     */
    public function getPurchasesTotalGroupedByStatus( $iStateId, $iCityId, $iUserId )
    {
        $arPurchases = array();
        $arPurchase = array();
        
        $this->db->select( 'count( purchases.purchase_status ) as purchase_status_total, purchases.*, articles.*, customers.*' );
        $this->db->from( $this->sTable );
        
        $this->db->join( 'articles', 'purchases.article_id = articles.article_id', 'left' );
        $this->db->join( 'customers', 'purchases.customer_id = customers.customer_id', 'left' );
        $this->db->join( 'states', 'customers.state_id = states.state_id', 'left' );
        $this->db->join( 'cities', 'customers.city_id = cities.city_id', 'left' );
        
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
        
        $this->db->group_by( 'purchases.purchase_status' );
        $this->db->order_by( 'purchase_status_total', 'desc' );
        
        $oResult = $this->db->get();
        
        foreach( $oResult->result_array() as $arPurchase )
        {
            $arPurchases[] = $arPurchase;
        }
        
        return $arPurchases;
        
    }
    /*
     * Gell the count of purchases by purchase_article_status
     * @param   int     $iStateId
     * @param   int     $iCityId
     * @param   int     $iUserId
     * @return  array   $arPurchases
     */
    public function getPurchasesTotalGroupedByArticleStatus( $iStateId, $iCityId, $iUserId )
    {
        $arPurchases = array();
        $arPurchase = array();
        
        $this->db->select( 'count( purchases.purchase_article_status ) as purchase_article_status_total, purchases.*, articles.*, customers.*' );
        $this->db->from( $this->sTable );
        $this->db->join( 'articles', 'purchases.article_id = articles.article_id', 'left' );
        $this->db->join( 'customers', 'purchases.customer_id = customers.customer_id', 'left' );
        $this->db->join( 'states', 'customers.state_id = states.state_id', 'left' );
        $this->db->join( 'cities', 'customers.city_id = cities.city_id', 'left' );
        
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
        
        $this->db->group_by( 'purchases.purchase_article_status' );
        $this->db->order_by( 'purchase_article_status_total', 'desc' );
        
        $oResult = $this->db->get();
        
        foreach( $oResult->result_array() as $arPurchase )
        {
            $arPurchases[] = $arPurchase;
        }
        
        return $arPurchases;
        
    }
    /*
     * Insert a purchase and return the last inserted id
     * @param   array   $arPurchase
     * @return  int     
     */
    public function insert( $arPurchase = array() )
    {
        if( ( ! is_array( $arPurchase ) ) || 
            ( ! sizeof( $arPurchase ) ) )
        {
            return FALSE;
        }
        
        $this->db->insert( $this->sTable, $arPurchase );
        return $this->db->insert_id();
    }
    /*
     * Update a purchase
     * @param   array   $arPurchase
     * @param   int     $iPurchaseId
     * @return  bool
     */
    public function update( $arPurchase = NULL, $iPurchaseId = NULL  )
    {
        if( ( $arPurchase === NULL ) ||
            ( ! is_array( $arPurchase ) ) ||
            ( $iPurchaseId === NULL ) ||
            ( ! is_int( $iPurchaseId ) ) )
        {
            return FALSE;
        }
        
        $this->db->where( 'purchase_id', $iPurchaseId );
        return $this->db->update( $this->sTable, $arPurchase );
    }
}

/* End of file purchase_model.php */
/* Location: ./application/models/purchase_model.php */