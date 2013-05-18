<?php
/*
 * @author  ggonzalez
 * @date    16 March 2013
 */

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Articles extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper( 'Articles' );
        $this->load->helper( 'Templates' );
        $this->load->library( 'ion_auth' );
        $this->load->model( 'Article_model', 'oArticles' );
        $this->load->model( 'Category_model', 'oCategories' );
        $this->load->model( 'Picture_model', 'oPictures' );
        
        if( ! $this->ion_auth->logged_in() )
        {
            redirect('admin/login', 'refresh');
        }
        
        define( 'ARTICLES', '' );
    }
    public function articleActivate( $iArticleId )
    {
        $this->load->library( 'user_agent' );
        
        $iArticleId = ( int ) $iArticleId;
        $arArticle = array();
        $arReferrer = array();
        $sRedirect = '';
        
        $arArticle = $this->oArticles->getById( FALSE, $iArticleId );
        
        if( ! sizeof( $arArticle ) )
        {
            show_404();
        }
        
        $this->oArticles->update( array( 'article_active' => 1, 'article_changed' => time() ), $iArticleId );
        
        $this->session->set_flashdata( 'alert', array(
            'class' => 'alert-success',
            'message' => 'Operación realizada con éxito'
        ) );
        
        $sRedirect = '/admin/articles';
        $arReferrer = parse_url( $this->agent->referrer() );
        
        if( ( $arReferrer ) && 
            ( isset( $arReferrer['query'] ) ) )
        {
            $sRedirect .= '?' . $arReferrer['query'];
        }

        redirect( $sRedirect, 'refresh' );
    }
    public function articleDeactivate( $iArticleId )
    {
        $this->load->library( 'user_agent' );
        
        $iArticleId = ( int ) $iArticleId;
        $arArticle = array();
        $arReferrer = array();
        $sRedirect = '';
        
        $arArticle = $this->oArticles->getById( FALSE, $iArticleId );
        
        if( ! sizeof( $arArticle ) )
        {
            show_404();
        }
        
        $this->oArticles->update( array( 'article_active' => 0, 'article_changed' => time() ), $iArticleId );
        
        $this->session->set_flashdata( 'alert', array(
            'class' => 'alert-success',
            'message' => 'Operación realizada con éxito'
        ) );
        
        $sRedirect = '/admin/articles';
        $arReferrer = parse_url( $this->agent->referrer() );
        
        if( ( $arReferrer ) && 
            ( isset( $arReferrer['query'] ) ) )
        {
            $sRedirect .= '?' . $arReferrer['query'];
        }

        redirect( $sRedirect, 'refresh' );
    }
    public function articleDelete( $iArticleId )
    {
        $this->load->helper( 'form' );
        
        $iArticleId = ( int ) $iArticleId;
        $arArticle = array();
        
        $arArticle = $this->oArticles->getById( FALSE, $iArticleId );
        
        if( ! sizeof( $arArticle ) )
        {
            show_404();
        }
        
        $arArticle['article_title'] = ArticlesHelper::getArticlePreparedTitle(
            $arArticle['article_sku'],
            $arArticle['article_brand'],
            $arArticle['article_model'], 
            $arArticle['article_year']
        );
        
        if( sizeof( $_POST ) )
        {
            $this->oArticles->delete( $iArticleId );
            $this->session->set_flashdata( 'alert', array(
                'class' => 'alert-success',
                'message' => 'Operación realizada con éxito'
            ) );

            redirect( '/admin/articles', 'refresh' );
        }
        
        $this->load->view( 'admin/articles/article-delete', array(
            'arArticle' => $arArticle,
            'arCSS' => TemplatesHelper::getDefaultCSSFiles(),
            'arJS' => array_merge( TemplatesHelper::getDefaultJSFiles(), array( 'articles' ) ),
            'iArticleId' => $iArticleId
        ) );
    }
    public function articleEdit( $iArticleId )
    {
        $this->config->load( 'admin/articles/article-edit' );
        $this->load->helper( 'Categories' );
        $this->load->helper( 'form' );
        $this->load->library( 'form_validation' );
        
        $iArticleId = ( int ) $iArticleId;
        $arArticle = array();
        
        $arArticle = $this->oArticles->getById( FALSE, $iArticleId );
        
        if( ! sizeof( $arArticle ) )
        {
            show_404();
        }
        
        $arBrakes = array();
        $arCategories = array();
        $arCurrencies = array();
        $arStatus = array();
        $arSuspension = array();
        $arValidations = array();
        $bValid = FALSE;
        $iEpoch = 0;
        
        $arBrakes = array( '' => 'Seleccione' ) + ArticlesHelper::getBrakes();
        $arCategories = $this->oCategories->getCategories();
        $arCategories = CategoriesHelper::getCategoriesTree( $arCategories );
        $arCategories = CategoriesHelper::getCategoriesLeveled( $arCategories );
        $arCategories = UtilsHelper::geOptionsDropdown( array( '' => 'Seleccione' ), $arCategories, 'category_id', 'category_name' );
        $arCurrencies = array( '' => 'Seleccione' ) + ArticlesHelper::getCurrencies();
        $arStatus = array( '' => 'Seleccione' ) + ArticlesHelper::getArticleStatus();
        $arSuspension = array( '' => 'Seleccione' ) + ArticlesHelper::getSuspension();
        
        $arValidations = $this->config->item( 'validation' );
        
        if( sizeof( $_POST ) )
        {
            $iEpoch = time();
            $arArticle = array();
            $arArticle['article_brakes'] = ( int ) $this->input->post( 'article_brakes' );
            $arArticle['article_brand'] = $this->input->post( 'article_brand' );
            $arArticle['article_capacity'] = $this->input->post( 'article_capacity' );
            $arArticle['article_changed'] = $iEpoch;
            $arArticle['article_color'] = $this->input->post( 'article_color' );
            $arArticle['article_comments'] = $this->input->post( 'article_comments' );
            $arArticle['article_currency'] = ( int ) $this->input->post( 'article_currency' );
            $arArticle['article_differential'] = $this->input->post( 'article_differential' );
            $arArticle['article_engine'] = $this->input->post( 'article_engine' );
            $arArticle['article_model'] = $this->input->post( 'article_model' );
            $arArticle['article_price'] = $this->input->post( 'article_price' );
            $arArticle['article_sleeper'] = ( int ) $this->input->post( 'article_sleeper' );
            $arArticle['article_status'] = ( int ) $this->input->post( 'article_status' );
            $arArticle['article_suspension'] = ( int ) $this->input->post( 'article_suspension' );
            $arArticle['article_tires'] = $this->input->post( 'article_tires' );
            $arArticle['article_transmission'] = $this->input->post( 'article_transmission' );
            $arArticle['article_ubication'] = $this->input->post( 'article_ubication' );
            $arArticle['article_wheels'] = $this->input->post( 'article_wheels' );
            $arArticle['article_year'] = $this->input->post( 'article_year' );
            $arArticle['category_id'] = ( int ) $this->input->post( 'category_id' );
            $arArticle['article_permalink'] = ArticlesHelper::getArticlePreparedTitle( '', $arArticle['article_brand'], $arArticle['article_model'], $arArticle['article_year'] );
            $arArticle['article_permalink'] = UtilsHelper::getPermalink( $arArticle['article_permalink'] );
            $arArticle['article_sku'] = ArticlesHelper::getStockKeepingUnit( $arCategories[$arArticle['category_id']], $iArticleId );
            
            $this->form_validation->set_error_delimiters( '<span class="help-block">', '</span>' );
            $this->form_validation->set_rules( $arValidations );
            $bValid = $this->form_validation->run();
            
            if( $bValid )
            {
                $this->oArticles->update( $arArticle, $iArticleId );
                $this->session->set_flashdata( 'alert', array(
                    'class' => 'alert-success',
                    'message' => 'Operación realizada con éxito'
                ) );
                redirect( '/admin/articles', 'refresh' );
            }
        }
        
        $this->load->view( 'admin/articles/article-edit', array(
            'arArticle' => $arArticle,
            'arBrakes' => $arBrakes,
            'arCategories' => $arCategories,
            'arCurrencies' => $arCurrencies,
            'arStatus' => $arStatus,
            'arSuspension' => $arSuspension,
            'arCSS' => TemplatesHelper::getDefaultCSSFiles(),
            'arJS' => array_merge( TemplatesHelper::getDefaultJSFiles(), array( 'articles' ) ),
            'iArticleId' => $iArticleId
        ) );
    }
    public function articleNew()
    {
        $this->config->load( 'admin/articles/article-new' );
        $this->load->helper( 'Categories' );
        $this->load->helper( 'form' );
        $this->load->library( 'form_validation' );
        
        $arArticle = array();
        $arBrakes = array();
        $arCategories = array();
        $arCurrencies = array();
        $arStatus = array();
        $arSuspension = array();
        $arValidations = array();
        $bValid = FALSE;
        $iArticleId = 0;
        $iEpoch = 0;
        $sCategory = '';
        define( 'NEW_ARTICLE', '' );
                
        $arArticle['article_brakes'] = 0;
        $arArticle['article_brand'] = '';
        $arArticle['article_capacity'] = '';
        $arArticle['article_color'] = '';
        $arArticle['article_comments'] = '';
        $arArticle['article_currency'] = 1;
        $arArticle['article_differential'] = '';
        $arArticle['article_engine'] = '';
        $arArticle['article_model'] = '';
        $arArticle['article_permalink'] = '';
        $arArticle['article_price'] = '';
        $arArticle['article_sleeper'] = 0;
        $arArticle['article_status'] = '';
        $arArticle['article_suspension'] = 0;
        $arArticle['article_tires'] = '';
        $arArticle['article_transmission'] = '';
        $arArticle['article_ubication'] = '';
        $arArticle['article_wheels'] = '';
        $arArticle['article_year'] = '';
        $arArticle['category_id'] = 0;
        
        $arBrakes = array( '' => 'Seleccione' ) + ArticlesHelper::getBrakes();
        $arCategories = $this->oCategories->getCategories();
        $arCategories = CategoriesHelper::getCategoriesTree( $arCategories );
        $arCategories = CategoriesHelper::getCategoriesLeveled( $arCategories );
        $arCategories = UtilsHelper::geOptionsDropdown( array( '' => 'Seleccione' ), $arCategories, 'category_id', 'category_name' );
        $arCurrencies = array( '' => 'Seleccione' ) + ArticlesHelper::getCurrencies();
        $arStatus = array( '' => 'Seleccione' ) + ArticlesHelper::getArticleStatus();
        $arSuspension = array( '' => 'Seleccione' ) + ArticlesHelper::getSuspension();
        
        $arValidations = $this->config->item( 'validation' );
        
        if( sizeof( $_POST ) )
        {
            $iEpoch = time();
            $arArticle = array();
            $arArticle['article_active'] = 0;
            $arArticle['article_brakes'] = ( int ) $this->input->post( 'article_brakes' );
            $arArticle['article_brand'] = $this->input->post( 'article_brand' );
            $arArticle['article_capacity'] = $this->input->post( 'article_capacity' );
            $arArticle['article_changed'] = $iEpoch;
            $arArticle['article_color'] = $this->input->post( 'article_color' );
            $arArticle['article_comments'] = $this->input->post( 'article_comments' );
            $arArticle['article_created'] = $iEpoch;
            $arArticle['article_currency'] = ( int ) $this->input->post( 'article_currency' );
            $arArticle['article_differential'] = $this->input->post( 'article_differential' );
            $arArticle['article_engine'] = $this->input->post( 'article_engine' );
            $arArticle['article_model'] = $this->input->post( 'article_model' );
            $arArticle['article_price'] = $this->input->post( 'article_price' );
            $arArticle['article_sleeper'] = ( int ) $this->input->post( 'article_sleeper' );
            $arArticle['article_status'] = ( int ) $this->input->post( 'article_status' );
            $arArticle['article_suspension'] = ( int ) $this->input->post( 'article_suspension' );
            $arArticle['article_tires'] = $this->input->post( 'article_tires' );
            $arArticle['article_transmission'] = $this->input->post( 'article_transmission' );
            $arArticle['article_ubication'] = $this->input->post( 'article_ubication' );
            $arArticle['article_wheels'] = $this->input->post( 'article_wheels' );
            $arArticle['article_year'] = $this->input->post( 'article_year' );
            $arArticle['category_id'] = ( int ) $this->input->post( 'category_id' );
            $arArticle['article_permalink'] = ArticlesHelper::getArticlePreparedTitle( '', $arArticle['article_brand'], $arArticle['article_model'], $arArticle['article_year'] );
            $arArticle['article_permalink'] = UtilsHelper::getPermalink( $arArticle['article_permalink'] );
            
            $this->form_validation->set_error_delimiters( '<span class="help-block">', '</span>' );
            $this->form_validation->set_rules( $arValidations );
            $bValid = $this->form_validation->run();
            
            if( $bValid )
            {
                $iArticleId = $this->oArticles->insert( $arArticle );
                $sCategory = $arCategories[$arArticle['category_id']];
                $this->oArticles->update( 
                    array( 'article_sku' => ArticlesHelper::getStockKeepingUnit( $sCategory, $iArticleId ) ),
                    $iArticleId
                );
                
                $this->session->set_flashdata( 'alert', array(
                    'class' => 'alert-success',
                    'message' => 'Operación realizada con éxito'
                ) );

                redirect( '/admin/articles', 'refresh' );
            }
        }
        
        $this->load->view( 'admin/articles/article-new', array(
            'arArticle' => $arArticle,
            'arBrakes' => $arBrakes,
            'arCategories' => $arCategories,
            'arCurrencies' => $arCurrencies,
            'arStatus' => $arStatus,
            'arSuspension' => $arSuspension,
            'arCSS' => TemplatesHelper::getDefaultCSSFiles(),
            'arJS' => array_merge( TemplatesHelper::getDefaultJSFiles(), array( 'articles' ) ),
        ) );
    }
    public function articleStatus( $iArticleId )
    {
        $this->load->library( 'user_agent' );
        
        $arArticle = array();
        $arReferrer = array();
        $sRedirect = '';
        $iArticleId = ( int ) $iArticleId;
        $iStatus = 0;
        
        $arArticle = $this->oArticles->getById( FALSE, $iArticleId );
        
        if( ( ! sizeof( $_POST ) ) ||
            ( ! sizeof( $arArticle ) ) )
        {
            show_404();
        }
        
        $iStatus = ( int ) $this->input->post( 'status' );
        
        $this->oArticles->update( array( 'article_status' => $iStatus, 'article_changed' => time() ), $iArticleId );
        
        $this->session->set_flashdata( 'alert', array(
            'class' => 'alert-success',
            'message' => 'Operación realizada con éxito'
        ) );
        
        $sRedirect = '/admin/articles';
        $arReferrer = parse_url( $this->agent->referrer() );
        
        if( ( $arReferrer ) && 
            ( isset( $arReferrer['query'] ) ) )
        {
            $sRedirect .= '?' . $arReferrer['query'];
        }

        redirect( $sRedirect, 'refresh' );
    }
    public function index( $iPageNumber = 1 )
    {
        $this->load->helper( 'Categories' );
        $this->load->helper( 'form' );
        $this->config->load( 'admin/pagination' );
        $this->load->library( 'pagination' );
        
        $arAlert = array();
        $arArticles = array();
        $arCategories = array();
        $arConfigPagination = array();
        $arCurrencies = array();
        $arGetParams = array();
        $arPicture = array();
        $arStatus = array();
        
        $iArticles = 0;
        $iCategoryId = 0;
        $iLimit = 0;
        $iOffset = 0;
        $iPageNumber = ( int ) $iPageNumber;
        $iStatusId = 0;
        $iTotalPages = 0;
        $sLike = '';
        $sPagination = '';
        
        define( 'ALL_ARTICLES', '' );
        
        $sLike = trim( $this->input->get( 's' ) );
        $iCategoryId = ( int ) trim( $this->input->get( 'category_id' ) );
        $iStatus = ( int ) trim( $this->input->get( 'status' ) );
        
        $iArticles = $this->oArticles->getCount( FALSE, $sLike, $iCategoryId, $iStatusId );
        
        $arConfigPagination = $this->config->item( 'pagination' );
        $arConfigPagination['per_page'] = 10;
        $arConfigPagination['base_url'] = '/admin/articles';
        $arConfigPagination['total_rows'] = $iArticles;
        
        if( $sLike )
        {
            $arGetParams['s'] = $sLike;
        }
        if( $iCategoryId )
        {
            $arGetParams['category_id'] = $iCategoryId;
        }
        if( $iStatus )
        {
            $arGetParams['status'] = $iStatus;
        }
        
        if( sizeof( $arGetParams ) )
        {
            $arConfigPagination['first_url'] = '/admin/articles/?' . http_build_query( $arGetParams );
            $arConfigPagination['suffix'] = '?' . http_build_query( $arGetParams );
        }
        
        $iLimit = $arConfigPagination['per_page'];
        $iOffset = ( $iLimit )  * ( $iPageNumber - 1 );
        $iTotalPages = ceil( $iArticles / $iLimit );

        if( ( $iPageNumber !== 1 ) &&
            ( $iPageNumber > $iTotalPages ) )
        {
            redirect( '/admin/articles', 'refresh' );
        }
        
        $this->pagination->initialize( $arConfigPagination ); 
        $sPagination = $this->pagination->create_links();
        
        $arAlert = $this->session->flashdata( 'alert' );
        $arArticles = $this->oArticles->getAll( FALSE, $iLimit, $iOffset, $sLike, $iCategoryId, $iStatusId );

        $arCurrencies = ArticlesHelper::getCurrencies();
        $arStatus = ArticlesHelper::getArticleStatus();
        
        foreach( $arArticles as $k => $v )
        {
            $arArticles[$k]['article_active'] = ( bool ) $arArticles[$k]['article_active'];
            $arArticles[$k]['article_title'] = ArticlesHelper::getArticlePreparedTitle(
                $arArticles[$k]['article_sku'],
                $arArticles[$k]['article_brand'],
                $arArticles[$k]['article_model'], 
                $arArticles[$k]['article_year']
            );
            
            $arArticles[$k]['article_currency'] = $arCurrencies[$arArticles[$k]['article_currency']];
            $arArticles[$k]['article_changed'] = UtilsHelper::getHumanReadableDate( ( int ) $arArticles[$k]['article_changed'] );
            $arArticles[$k]['article_created'] = UtilsHelper::getHumanReadableDate( ( int ) $arArticles[$k]['article_created'] );
            
            $arPicture = $this->oPictures->getByPicturePreview( $arArticles[$k]['article_id'] );
            
            if( sizeof( $arPicture ) )
            {
                $arArticles[$k] = array_merge( $arArticles[$k], $arPicture );
            }
        }
        
        $arCategories = $this->oCategories->getCategories();
        $arCategories = CategoriesHelper::getCategoriesTree( $arCategories );
        $arCategories = CategoriesHelper::getCategoriesLeveled( $arCategories );
        $arCategories = UtilsHelper::geOptionsDropdown( array( '' => 'Todas las categorías' ), $arCategories, 'category_id', 'category_name' );
        
        $arStatusArticle = $arStatus;
        $arStatus = array( '' => 'Todos los status' ) + $arStatus;
        
        $this->load->view( 'admin/articles/index', array(
            'arAlert' => $arAlert,
            'arArticles' => $arArticles,
            'arCategories' => $arCategories,
            'arCSS' => TemplatesHelper::getDefaultCSSFiles(),
            'arCurrencies' => $arCurrencies,
            'arStatus' => $arStatus,
            'arStatusArticle' => $arStatusArticle,
            'iArticles' => $iArticles,
            'iCategoryId' => $iCategoryId,
            'iStatusId' => $iStatusId,
            'arJS' => array_merge( TemplatesHelper::getDefaultJSFiles(), array( 'articles' ) ),
            'sLike' => $sLike,
            'sPagination' => $sPagination
        ) );
        
    }
}

/* End of file categories.php */
/* Location: ./application/controllers/admin/categories.php */
