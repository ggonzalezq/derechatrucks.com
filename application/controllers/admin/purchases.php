<?php
/*
 * @author  ggonzalez
 * @date    23 February 2013
 */

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Purchases extends CI_Controller
{
    private $arCustomer;
    private $arUser;
    private $iCustomerId;
    
    public function __construct()
    {
        parent::__construct();
        $this->load->helper( 'Articles' );
        $this->load->helper( 'Purchases' );
        $this->load->helper( 'Templates' );
        $this->load->library( 'ion_auth' );
        $this->load->model( 'Article_model', 'oArticles' );
        $this->load->model( 'Customer_model', 'oCustomers' );
        $this->load->model( 'Purchase_model', 'oPurchases' );
        
        if( ! $this->ion_auth->logged_in() )
        {
            redirect('admin/login', 'refresh');
        }
        
        $this->arUser = $this->ion_auth->user()->row_array();
        
        $this->iCustomerId = ( int ) $this->input->get( 'customer_id' );
        
        if( $this->iCustomerId )
        {
            $this->arCustomer = $this->oCustomers->getByCustomerid( $this->iCustomerId );
            
            if( ! sizeof( $this->arCustomer ) )
            {
                show_404();
            }
            
            
            if( ( ! $this->ion_auth->is_admin() ) &&
                ( $this->arUser['user_id'] !=  $this->arCustomer['user_id'] ) )
            {
                show_404();
            }
        }
        
        define( "PURCHASES", '' );
    }
    public function index( $iPageNumber = 1 )
    {
        $this->load->helper( 'text' );
        $this->load->library( 'pagination' );
        $this->config->load( 'admin/pagination' );
        
        $arAlert = array();
        $arConfigPagination = array();
        $arPurchaseStatus = array();
        $arPurchases = array();
        $iArticleId = 0;
        $iLimit = 0;
        $iOffset = 0;
        $iPageNumber = ( int ) $iPageNumber;
        $iPurchases = 0;
        $sPagination = '';
        
        $iPurchases = $this->oPurchases->getCount( $this->iCustomerId );
        
        $arConfigPagination = $this->config->item( 'pagination' );
        $arConfigPagination['base_url'] = '/admin/purchases';
        $arConfigPagination['total_rows'] = $iPurchases;
        
        $iLimit = $arConfigPagination['per_page'];
        $iOffset = ( $iLimit )  * ( $iPageNumber - 1 );
        
        
        $iTotalPages = ceil( $iPurchases / $iLimit );

        if( ( $iPageNumber !== 1 ) &&
            ( $iPageNumber > $iTotalPages ) )
        {
            $this->iCustomerId ? 
                redirect( '/admin/purchases?customer_id=' . $this->iCustomerId, 'refresh' ) :
                redirect( '/admin/purchases' , 'refresh' );
        }
        
        define( 'ALL_PURCHASES', '' );
        
        $arPurchaseStatus = PurchasesHelper::getPurchaseStatus();
        
        $arPurchases = $this->oPurchases->getPurchases( $iLimit, $iOffset, $this->iCustomerId );
        
        foreach( $arPurchases as $k => $v )
        {
            
            $arPurchases[$k] = array_map( 'strip_tags', $arPurchases[$k] );
            
            if( isset( $arPurchaseStatus[$arPurchases[$k]['purchase_status']] ) )
            {
                $arPurchases[$k]['purchase_status'] = $arPurchaseStatus[$arPurchases[$k]['purchase_status']];
            }
            else
            {
                $arPurchases[$k]['purchase_status'] = '';
            }
            
            $iArticleId = ( int ) $arPurchases[$k]['article_id'];
            
            if( $iArticleId )
            {
                $arPurchases[$k]['title'] = ArticlesHelper::getArticlePreparedTitle( 
                    $arPurchases[$k]['article_sku'],
                    $arPurchases[$k]['article_brand'],
                    $arPurchases[$k]['article_model'],
                    $arPurchases[$k]['article_year']
                );
            }
            else
            {
                $arPurchases[$k]['title'] = ArticlesHelper::getArticlePreparedTitle( 
                    $arPurchases[$k]['purchase_brand'],
                    $arPurchases[$k]['purchase_model'],
                    $arPurchases[$k]['purchase_year']
                );
            }
            
            $arPurchases[$k]['purchase_created'] = UtilsHelper::getHumanReadableDate( ( int ) $arPurchases[$k]['purchase_created'] );
            $arPurchases[$k]['purchase_comments'] = word_limiter( $arPurchases[$k]['purchase_comments'], 50 );
        }
        
        if( $this->iCustomerId )
        {
            $arConfigPagination['first_url'] = '/admin/purchases?customer_id=' . $this->iCustomerId;
            $arConfigPagination['suffix'] = '?customer_id=' . $this->iCustomerId;
        }
        $this->pagination->initialize( $arConfigPagination ); 
        $sPagination = $this->pagination->create_links();
        
        
        $arAlert = $this->session->flashdata( 'alert' );
        
        $this->load->view( 'admin/purchases/index', array(
            'arAlert' => $arAlert,
            'arCSS' => TemplatesHelper::getDefaultCSSFiles(),
            'arCustomer' => $this->arCustomer,
            'arJS' => array_merge ( TemplatesHelper::getDefaultJSFiles(), array( 'purchases' ) ),
            'arPurchases' => $arPurchases,
            'iCustomerId' => $this->iCustomerId,
            'iPurchases' => $iPurchases,
            'sPagination' => $sPagination
        ) );
    }
    public function purchaseDelete( $iPurchaseId )
    {
        $iArticleId = 0;
        $iPurchaseId = ( int )$iPurchaseId;
        $arPurchase = array();
        
        $arPurchase = $this->oPurchases->getByPurchaseId( $iPurchaseId );
        
        if( ! sizeof( $arPurchase ) )
        {
            show_404();
        }
        
        if( ( sizeof( $_POST ) ) &&
            ( $this->oPurchases->delete( $iPurchaseId ) ) )
        {
            $this->session->set_flashdata( 'alert', array(
                'class' => 'alert-success',
                'message' => 'Operación realizada con éxito'
            ) );

            redirect( $this->iCustomerId ? '/admin/purchases?customer_id=' . $this->iCustomerId : '/admin/purchases', 'refresh' );
        }
        
        $this->load->helper( 'form' );
        
        $iArticleId = ( int ) $arPurchase['article_id'];

        if( $iArticleId )
        {
            $arPurchase['title'] = ArticlesHelper::getArticlePreparedTitle( $arPurchase['marca'], $arPurchase['modelo'], $arPurchase['year'] );
        }
        else
        {
            $arPurchase['title'] = ArticlesHelper::getArticlePreparedTitle(  $arPurchase['purchase_brand'], $arPurchase['purchase_model'], $arPurchase['purchase_year'] );
        }
        
        $this->load->view( 'admin/purchases/purchase-delete', array(
            'arCSS' => TemplatesHelper::getDefaultCSSFiles(),
            'arCustomer' => $this->arCustomer,
            'arJS' => array_merge ( TemplatesHelper::getDefaultJSFiles(), array( 'purchases' ) ),
            'arPurchase' => $arPurchase,
            'iCustomerId' => $this->iCustomerId
        ) );
    }
    public function purchaseEdit( $iPurchaseId )
    {
        $arPurchase = array();
        $iPurchaseId = ( int ) $iPurchaseId;
        
        $arPurchase = $this->oPurchases->getByPurchaseId( $iPurchaseId );
        
        if( ! sizeof( $arPurchase ) )
        {
            show_404();
        }
        
        $bValid = FALSE;
        $arArticles = array();
        $arConfigValidation = array();
        $arCustomers = array();
        
        $this->config->load( 'admin/purchases/purchases' );
        $this->load->helper( 'Customers' );
        $this->load->helper( 'form' );
        $this->load->library( 'form_validation' );
        
        $arCustomers = UtilsHelper::geOptionsDropdown( 
            array( '' => 'Seleccione' ),
            $this->oCustomers->getCustomers( NULL ,NULL, NULL, NULL, NULL,  'customers.customer_name asc' ),
            'customer_id',
            'customer_name'
        );
        
        $arPurchase = array(
            'purchase_article_status' => ( int ) $arPurchase['purchase_article_status'],
            'purchase_brand' => $arPurchase['purchase_brand'],
            'purchase_comments' => $arPurchase['purchase_comments'],
            'purchase_model' => $arPurchase['purchase_model'],
            'purchase_status' => ( int ) $arPurchase['purchase_status'],
            'purchase_year' => ( int ) $arPurchase['purchase_year'],
            'article_id' => ( int ) $arPurchase['article_id'],
            'customer_id' => ( int ) $arPurchase['customer_id']
        );
        
        
        $arArticles = $this->oArticles->getAll();
        
        foreach( $arArticles as & $arArticle )
        {
            $arArticle['title'] = ArticlesHelper::getArticlePreparedTitle(
                $arArticle['marca'],
                $arArticle['modelo'],
                $arArticle['year']
            );
        }
        
        $arArticles = UtilsHelper::geOptionsDropdown( array( '' => 'Seleccione' ), $arArticles, 'id', 'title' );
        
        $this->form_validation->set_error_delimiters( '<span class="help-block">', '</span>' );
        $arConfigValidation = $this->config->item( 'validation' );
        
        
        if( ( sizeof( $_POST ) ) &&
            ( $this->input->post( 'purchase_article_status' ) === '0' ) )
        {
            //"No disponible" was checked so ...
            unset( $arConfigValidation[4] );
        }
        else
        {
            //"Disponible was checked" so ...
            unset( $arConfigValidation[1], $arConfigValidation[2], $arConfigValidation[3] );
        }
        
        $this->form_validation->set_rules( $arConfigValidation );
        $bValid = $this->form_validation->run();
        
        if( sizeof( $_POST ) )
        {
            $arPurchase = array_merge( $arPurchase, $_POST );
            
            $arPurchase['purchase_article_status'] = ( int ) $arPurchase['purchase_article_status'];
            
            if( $arPurchase['purchase_article_status'] )
            {
                $arPurchase['article_id'] = ( int ) $arPurchase['article_id'];
                $arPurchase['purchase_brand'] = '';
                $arPurchase['purchase_model'] = '';
                $arPurchase['purchase_year'] = '';
            }
            else
            {
                $arPurchase['article_id'] = 0;
                $arPurchase['purchase_brand'] = $arPurchase['purchase_brand'];
                $arPurchase['purchase_model'] = $arPurchase['purchase_model'];
                $arPurchase['purchase_year'] = ( int ) $arPurchase['purchase_year'];
            }
            
            $arPurchase['purchase_comments'] = $arPurchase['purchase_comments'];
            $arPurchase['purchase_status'] = ( int ) $arPurchase['purchase_status'];
            $arPurchase['customer_id'] = ( int ) $arPurchase['customer_id'];
            
            if( $bValid )
            {
                $arPurchase['purchase_changed'] = time();
                
                $this->oPurchases->update( $arPurchase, $iPurchaseId );

                $this->session->set_flashdata( 'alert', array(
                    'class' => 'alert-success',
                    'message' => 'Operación realizada con éxito'
                ) );

                redirect( $this->iCustomerId ? '/admin/purchases?customer_id=' . $this->iCustomerId : '/admin/purchases', 'refresh' );
                
            }
        }
        
        if( $arPurchase['purchase_year'] === 0 )
        {
            $arPurchase['purchase_year'] = '';
        }
        
        $this->load->view( 'admin/purchases/purchase-edit', array(
            'arArticles' => $arArticles,
            'arArticleStatus' => PurchasesHelper::getPurchaseArticleStatus(),
            'arCSS' => TemplatesHelper::getDefaultCSSFiles(),
            'arCustomer' => $this->arCustomer,
            'arCustomers' => $arCustomers,
            'arPurchase' => $arPurchase,
            'arPurchaseStatus' => PurchasesHelper::getPurchaseStatusDropdown(),
            'arJS' => array_merge ( TemplatesHelper::getDefaultJSFiles(), array( 'purchases' ) ),
            'iCustomerId' => $this->iCustomerId,
            'iPurchaseId' => $iPurchaseId
        ) );
        
    }
    public function purchaseNew()
    {   
        $bValid = FALSE;
        $arArticles = array();
        $arConfigValidation = array();
        $arCustomers = array();
        $arPurchase = array();
        $iEpoch = 0;
        
        define( 'NEW_PURCHASE', '' );
        
        $this->config->load( 'admin/purchases/purchases' );
        $this->load->helper( 'Customers' );
        $this->load->helper( 'form' );
        $this->load->library( 'form_validation' );
        
        $arCustomers = UtilsHelper::geOptionsDropdown( 
            array( '' => 'Seleccione' ),
            $this->oCustomers->getCustomers( NULL ,NULL, NULL, NULL, NULL,  'customers.customer_name asc' ),
            'customer_id',
            'customer_name'
        );
                
        $arPurchase['purchase_article_status'] = 1;
        $arPurchase['purchase_brand'] = '';
        $arPurchase['purchase_comments'] = '';
        $arPurchase['purchase_model'] = '';
        $arPurchase['purchase_status'] = 0;
        $arPurchase['purchase_year'] = '';
        $arPurchase['article_id'] = '';
        $arPurchase['customer_id'] = $this->iCustomerId;
        
        $arArticles = $this->oArticles->getAll();
        
        foreach( $arArticles as & $arArticle )
        {
            $arArticle['title'] = ArticlesHelper::getArticlePreparedTitle(
                $arArticle['article_sku'],
                $arArticle['article_brand'],
                $arArticle['article_model'],
                $arArticle['article_year']
            );
        }

        $arArticles = UtilsHelper::geOptionsDropdown( array( '' => 'Seleccione' ), $arArticles, 'article_id', 'title' );
        
        $this->form_validation->set_error_delimiters( '<span class="help-block">', '</span>' );
        $arConfigValidation = $this->config->item( 'validation' );
        
        
        if( ( sizeof( $_POST ) ) &&
            ( $this->input->post( 'purchase_article_status' ) === '0' ) )
        {
            //"No disponible" was checked so ...
            unset( $arConfigValidation[4] );
        }
        else
        {
            //"Disponible was checked" so ...
            unset( $arConfigValidation[1], $arConfigValidation[2], $arConfigValidation[3] );
        }
        
        $this->form_validation->set_rules( $arConfigValidation );
        $bValid = $this->form_validation->run();
        
        if( sizeof( $_POST ) )
        {
            $arPurchase = array();
            $arPurchase['purchase_article_status'] = ( int ) $this->input->post( 'purchase_article_status' );
            $arPurchase['purchase_brand'] = $this->input->post( 'purchase_brand' );
            $arPurchase['purchase_comments'] = $this->input->post( 'purchase_comments' );
            $arPurchase['purchase_model'] = $this->input->post( 'purchase_model' );
            $arPurchase['purchase_status'] = ( int ) $this->input->post( 'purchase_status' );
            $arPurchase['purchase_year'] =  $this->input->post( 'purchase_year' );
            $arPurchase['article_id'] =  ( int ) $this->input->post( 'article_id' );
            $arPurchase['customer_id'] =  ( int ) $this->input->post( 'customer_id' );
            
            if( $arPurchase['purchase_article_status'] )
            {
                $arPurchase['purchase_brand'] = '';
                $arPurchase['purchase_model'] = '';
                $arPurchase['purchase_year'] = '';
            }
            else
            {
                $arPurchase['article_id'] = 0;
            }
            
            if( $bValid )
            {
                $arPurchase['purchase_year'] = ( int ) $arPurchase['purchase_year'];
                $iEpoch = time();
                $arPurchase['purchase_changed'] = $iEpoch;
                $arPurchase['purchase_created'] = $iEpoch;
                
                $this->oPurchases->insert( $arPurchase );

                $this->session->set_flashdata( 'alert', array(
                    'class' => 'alert-success',
                    'message' => 'Operación realizada con éxito'
                ) );

                redirect( $this->iCustomerId ? '/admin/purchases?customer_id=' . $this->iCustomerId : '/admin/purchases', 'refresh' );
                
            }
            else
            {
                if( ! $arPurchase['purchase_year'] )
                {
                    $arPurchase['purchase_year'] = '';
                }
            }
        }
        
        $this->load->view( 'admin/purchases/purchase-new', array(
            'arArticles' => $arArticles,
            'arArticleStatus' => PurchasesHelper::getPurchaseArticleStatus(),
            'arCSS' => TemplatesHelper::getDefaultCSSFiles(),
            'arCustomer' => $this->arCustomer,
            'arCustomers' => $arCustomers,
            'arPurchase' => $arPurchase,
            'arPurchaseStatus' => PurchasesHelper::getPurchaseStatusDropdown(),
            'arJS' => array_merge ( TemplatesHelper::getDefaultJSFiles(), array( 'purchases' ) ),
            'iCustomerId' => $this->iCustomerId
        ) );
    }
}

/* End of file purchases.php */
/* Location: ./application/controllers/admin/purchases.php */