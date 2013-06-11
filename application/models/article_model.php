<?php
/*
 * @author ggonzalez
 * @29 October 2012
 */

if ( ! defined('BASEPATH')) exit( 'No direct script access allowed' );

class Article_model extends CI_Model
{
    private $sTable;
    
    public function __construct()
    {
        parent::__construct();
        $this->sTable = 'articles';
    }
    /*
     * Delete an article
     * @param   int     $iArticleId
     * @return  bool
     */
    public function delete( $iArticleId = NULL  )
    {
        if( ( $iArticleId === NULL ) ||
            ( ! is_int( $iArticleId ) ) )
        {
            return FALSE;
        }
        
        $this->db->where( 'articles.article_id', $iArticleId );
        return $this->db->delete( $this->sTable );
    }
    /*
     * Get all the articles
     * @param   boolean $bActive
     * @param   int     $iLimit
     * @param   int     $iOffset
     * @param   string  $sLike
     * @param   int     $iCategoryId
     * @param   int     $iStatusId
     * @param   string  $sOrderBy
     * @return  array   $arArticles
     */
    public function getAll( $bActive = FALSE, $iLimit = NULL, $iOffset = NULL, $sLike = NULL, $iCategoryId = NULL, $iStatusId = NULL, $sOrderBy = NULL )
    {
        $arArticles = array();
        $arArticle = array();
        
        $this->db->select( 'articles.*, categories.*');
        $this->db->from( $this->sTable );
        $this->db->join( 'categories', 'articles.category_id = categories.category_id', 'left' );
        
        if( $bActive )
        {
            $this->db->where( array( 'articles.article_active' => 1 ) );
        }
        if( $sLike )
        {
            $sLike = $this->db->escape_like_str( $sLike );
            $this->db->where( '( articles.article_sku like \'%' . $sLike . '%\' )' );
        }
        if( $iCategoryId )
        {
            $this->db->where( 'articles.category_id', $iCategoryId );
        }
        if( $iStatusId )
        {
            $this->db->where( 'articles.status', $iStatusId );
        }
        if( $sOrderBy )
        {
            $this->db->order_by( $sOrderBy );
        }
        else
        {
            $this->db->order_by( 'articles.article_changed', 'desc' );
        }
        if( $iLimit )
        {
            $this->db->limit( $iLimit, $iOffset );
        }
        
        $oResult = $this->db->get();
        
        foreach( $oResult->result_array() as $arArticle )
        {
            $arArticles[] = $arArticle;
        }
        
        return $arArticles;
    }
    /*
     * Get an article by article_id
     * @param   boolean     $bActive
     * @param   int         $iArticleId
     * @return  mixed       boolean / array
     */
    public function getById( $bActive = FALSE, $iArticleId )
    {
        
        if( ! is_int( $iArticleId ) )
        {
            return FALSE;
        }
        
        $this->db->select( 'articles.*, categories.*' );
        $this->db->from( $this->sTable );
        $this->db->join( 'categories', 'articles.category_id = categories.category_id', 'left' );
        
        if( $bActive )
        {
            $this->db->where( array( 'articles.article_active' => 1 ) );
        }
        
        $this->db->where( array( 'articles.article_id' => $iArticleId ) );
        
        $oResult = $this->db->get();
        
        return $oResult->row_array();
    }
    public function getByCategoryid( $iCategoryId, $sOrderBy = NULL )
    {
        if( ! is_int( $iCategoryId ) )
        {
            return FALSE;
        }
        
        $arArticles = array();
        $arArticle = array();
        
        $this->db->select( '*' );
        $this->db->from( $this->sTable );
        $this->db->where( array( 'article_active' => 1, 'category_id' => $iCategoryId ) );
        
        if( $sOrderBy )
        {
            $this->db->order_by( $sOrderBy );
        }
        else
        {
            $this->db->order_by( 'articles.article_changed', 'desc' );
        }
        
        $oResult = $this->db->get();
        
        foreach( $oResult->result_array() as $arArticle )
        {
            $arArticles[] = $arArticle;
        }
        
        return $arArticles;
    }
    /*
     * Get the number of articles inserted 
     * @param   boolean $bActive
     * @param   string  $sLike
     * @param   int     $iCategoryId
     * @param   int     $iStatusId
     * @return  int
     */
    public function getCount( $bActive = FALSE, $sLike = NULL, $iCategoryId = NULL, $iStatusId = NULL )
    {   
        if( $bActive )
        {
            $this->db->where( array( 'articles.article_active' => 1 ) );
        }
        if( $sLike )
        {
            $sLike = $this->db->escape_like_str( $sLike );
            $this->db->where( '( articles.article_sku like \'%' . $sLike . '%\' )' );
        }
        if( $iCategoryId )
        {
            $this->db->where( 'articles.category_id', $iCategoryId );
        }
        if( $iStatusId )
        {
            $this->db->where( 'articles.status', $iStatusId );
        }
        
        return $this->db->count_all_results( $this->sTable );
        
    }
    /*
     * Insert an article
     * @param   array   $arArticle
     * @return  mixed   boolean / int
     */
    public function insert( $arArticle = array() )
    {
        if( ! sizeof( $arArticle ) )
        {
            return FALSE;
        }
        
        $this->db->insert( $this->sTable, $arArticle );
        return $this->db->insert_id();
    }
    
    /*
     * Update an article
     * @param   array   $arArticle
     * @param   int     $iArticleId
     * @return  bool
     */
    public function update( $arArticle = NULL, $iArticleId = NULL  )
    {
        if( ( $arArticle === NULL ) ||
            ( ! is_array( $arArticle ) ) ||
            ( $iArticleId === NULL ) ||
            ( ! is_int( $iArticleId ) ) )
        {
            return FALSE;
        }
        
        $this->db->where( 'articles.article_id', $iArticleId );
        return $this->db->update( $this->sTable, $arArticle );
    }
    
}

/* End of file article_model.php */
/* Location: ./application/models/article_model.php */