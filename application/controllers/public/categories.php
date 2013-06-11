<?php
/*
 * @author ggonzalez
 * @26 October 2012
 */

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Categories extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }
    public function index()
    {
        
    }
    public function category( $sPermalink, $iCategoryId )
    {
        $this->load->model( 'Category_model', 'oCategories' );
        $this->load->model( 'Article_model', 'oArticles' );
        $this->load->model( 'Picture_model', 'oPictures' );
        $this->load->helper( 'Articles' );
        $this->load->helper( 'Categories' );
        
        $iCategoryId = ( int ) $iCategoryId;
        $arArticles = array();
        $arCategories = array();
        $arCategory = array();
        
        $arCategory = $this->oCategories->getById( $iCategoryId );
        
        $arCategories = $this->oCategories->getCategories();
        $arCategories = CategoriesHelper::getCategoriesTree( $arCategories );
        $arCategories = CategoriesHelper::getCategoriesLeveled( $arCategories );
        
        if( ( ! sizeof( $arCategory ) ) ||
            ( $sPermalink !== $arCategory['category_permalink'] ) )
        {
            show_404();
        }
        
        $arArticles = $this->oArticles->getByCategoryId( ( int ) $arCategory['category_id'], 'articles.article_created desc' );
        
        
        foreach( $arArticles as $k => $v  )
        {
            $arArticles[$k] = ArticlesHelper::getArticleFormatted( $v );
            $arPicture = $this->oPictures->getByPicturePreview( $arArticles[$k]['article_id'] );
            
            if( sizeof( $arPicture ) )
            {
                $arArticles[$k] = array_merge( $arArticles[$k], $arPicture );
            }
        }
        
        $this->load->view( 'public/categories/category', array(
            'arCategories' => $arCategories,
            'arCategory' => $arCategory,
            'arArticles' => $arArticles,
            'sTitle' => 'Derecha Trucks | ' . $arCategory['category_name']
        ) );
    }
}

/* End of file categories.php */
/* Location: ./application/controllers/categories.php */