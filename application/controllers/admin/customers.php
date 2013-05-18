<?php
/*
 * @author ggonzalez
 * @18 February 2013
 */

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Customers extends CI_Controller
{
    
    private $arUser;
    
    public function __construct()
    {
        parent::__construct();
        $this->load->helper( 'Customers' );
        $this->load->helper( 'Templates' );
        $this->load->library( 'ion_auth' );
        $this->load->model( 'Customer_model', 'oCustomers' );
        $this->load->model( 'User_model', 'oUsers' );
        
        if( ! $this->ion_auth->logged_in() )
        {
            redirect('admin/login', 'refresh');
        }
        
        $this->arUser = $this->ion_auth->user()->row_array();
        
        define( 'CUSTOMERS', '' );
    }
    public function customerDelete( $iCustomerId )
    {
        
        $arCustomer = array();
        $iCustomerId = ( int ) $iCustomerId;
        
        $arCustomer = $this->oCustomers->getByCustomerId( $iCustomerId );
        
        if( ! sizeof( $arCustomer ) )
        {
            show_404();
        }
        
        $this->load->model( 'Purchase_model', 'oPurchases' );
        $arCustomer['user_id'] = ( int ) $arCustomer['user_id'];
        
        if( ( ! $this->ion_auth->is_admin() ) &&
            ( $arCustomer['user_id'] !== $this->arUser['user_id'] ) )
        {
            show_404();
        }
        
        if( ( sizeof( $_POST ) ) &&
            ( $this->oCustomers->delete( $iCustomerId ) ) )
        {
            
            $this->oPurchases->deleteByCustomerId( $iCustomerId );
            
            $this->session->set_flashdata( 'alert', array(
                'class' => 'alert-success',
                'message' => 'Operación realizada con éxito'
            ) );

            redirect( '/admin/customers', 'refresh' );
        }
        
        $this->load->helper( 'form' );
        $this->load->view( 'admin/customers/customer-delete', array(
            'arCustomer' => $arCustomer,
            'arCSS' => TemplatesHelper::getDefaultCSSFiles(),
            'arJS' => array_merge( TemplatesHelper::getDefaultJSFiles(), array( 'customers' ) ),
            'iCustomerId' => $iCustomerId
        ) );
        
    }
    public function customerEdit( $iCustomerId )
    {
        $arCustomer = array();
        $iCustomerId = ( int ) $iCustomerId;
        
        $arCustomer = $this->oCustomers->getByCustomerId( $iCustomerId );
        
        if( ! sizeof( $arCustomer ) )
        {
            show_404();
        }

        $bPermission = FALSE;
        $bPermission = $this->ion_auth->is_admin() || $arCustomer['user_id'] == $this->arUser['user_id'];
        
        $arCustomer['city_id'] = ( int ) $arCustomer['city_id'];
        $arCustomer['customer_media'] = ( int ) $arCustomer['customer_media'];
        $arCustomer['state_id'] = ( int ) $arCustomer['state_id'];
        $arCustomer['user_id'] = ( int ) $arCustomer['user_id'];
        
        $this->load->helper( 'form' );
        $this->load->library( 'form_validation' );
        $this->config->load( 'admin/customers/customers' );
        $this->load->model( 'City_model', 'oCities' );
        $this->load->model( 'State_model', 'oStates' );
     
        $arCities = array();
        $arConfigValidations = array();
        $arMedia = array();
        $arStates = array();
        $arStatesPrepared = array();
        $bResult = FALSE;
        $bValid = FALSE;

        $arCities = array( 'Seleccione' );
        $arStates = UtilsHelper::geOptionsDropdown( array( 'Seleccione' ), $this->oStates->getAll(), 'state_id', 'state_name' );
        
        
        $arConfigValidations = $this->config->item( 'validation' );
        
        if( sizeof( $_POST ) )
        {
            $arValidationRules = array();
            $sRule = '';

            // Remove the validation rule "is_unique" if the field have the same value
            
            foreach( $arConfigValidations as & $arConfigValidation )
            {
                $arValidationRules = explode( '|', $arConfigValidation['rules'] );
                
                foreach( $arValidationRules as $k => $sRule )
                {
                    if( ( preg_match( '/^is_unique/', $sRule ) ) &&
                        ( strtolower( $arCustomer[$arConfigValidation['field']] ) ===
                          strtolower( $this->input->post( $arConfigValidation['field'] ) ) ) )
                    {
                        unset( $arValidationRules[$k] );
                        $arConfigValidation['rules'] = implode( '|', $arValidationRules );
                        break;
                    }
                }
                
            }
            
            $arCustomer = array(
                'customer_name' => $this->input->post( 'customer_name' ),
                'customer_company' => $this->input->post( 'customer_company' ),
                'customer_address' => $this->input->post( 'customer_address' ),
                'customer_telephone' => $this->input->post( 'customer_telephone' ),
                'customer_mobile' => $this->input->post( 'customer_mobile' ),
                'customer_nextel' => $this->input->post( 'customer_nextel' ),
                'customer_email' => $this->input->post( 'customer_email' ),
                'state_id' => ( int ) $this->input->post( 'state_id' ),
                'city_id' => ( int ) $this->input->post( 'city_id' ),
                'customer_media' => ( int ) $this->input->post( 'customer_media' ),
                'customer_comments' => $this->input->post( 'customer_comments' )
            ) ;
        }
        
        $this->form_validation->set_error_delimiters( '<span class="help-block">', '</span>' );
        $this->form_validation->set_rules( $arConfigValidations );
        $bValid = $this->form_validation->run();
        
        if( $bValid )
        {
            
            $arCustomer['customer_changed'] = time();
            $bResult = $this->oCustomers->update( $arCustomer, $iCustomerId );

            if( $bResult )
            {
                $this->session->set_flashdata( 'alert', array(
                    'class' => 'alert-success',
                    'message' => 'Operación realizada con éxito'
                ) );

                redirect( '/admin/customers', 'refresh' );
            }
        }
        else
        {
            $this->lang->load( 'form_validation', 'spanish' );
            $arValidationsUnique = array();
            $arCustomerRegistered = array();
            $sError = '';

            $arValidationsUnique = UtilsHelper::getUniqueValidations( $arConfigValidations );

            foreach( $arValidationsUnique as $k => $v )
            {
                if( strip_tags( form_error( $v['field'] ) ) === 
                    sprintf( $this->lang->line( 'is_unique' ), $v['label'] ) )
                {
                    switch( $v['field'] )
                    {
                        case 'customer_name':
                            $arCustomerRegistered = $this->oCustomers->getByCustomerName( $arCustomer['customer_name'] );
                            $sError = strip_tags( form_error( $v['field'] ) );
                            $sError .= ', <a href="/admin/customers/customer-edit/' . $arCustomerRegistered['customer_id'] . '">ver cliente</a>';
                            $this->form_validation->set_error( 'customer_name', $sError );
                        break;
                        case 'customer_telephone':
                            $arCustomerRegistered = $this->oCustomers->getByCustomerTelephone( $arCustomer['customer_telephone'] );
                            $sError = strip_tags( form_error( $v['field'] ) );
                            $sError .= ', <a href="/admin/customers/customer-edit/' . $arCustomerRegistered['customer_id'] . '">ver cliente</a>';
                            $this->form_validation->set_error( 'customer_telephone', $sError );
                        break;
                        case 'customer_mobile':
                            $arCustomerRegistered = $this->oCustomers->getByCustomerMobile( $arCustomer['customer_mobile'] );
                            $sError = strip_tags( form_error( $v['field'] ) );
                            $sError .= ', <a href="/admin/customers/customer-edit/' . $arCustomerRegistered['customer_id'] . '">ver cliente</a>';
                            $this->form_validation->set_error( 'customer_mobile', $sError );
                        break;
                        case 'customer_nextel':
                            $arCustomerRegistered = $this->oCustomers->getByCustomerNextel( $arCustomer['customer_nextel'] );
                            $sError = strip_tags( form_error( $v['field'] ) );
                            $sError .= ', <a href="/admin/customers/customer-edit/' . $arCustomerRegistered['customer_id'] . '">ver cliente</a>';
                            $this->form_validation->set_error( 'customer_nextel', $sError );
                        break;
                        case 'customer_email':
                            $arCustomerRegistered = $this->oCustomers->getByCustomerEmail( $arCustomer['customer_email'] );
                            $sError = strip_tags( form_error( $v['field'] ) );
                            $sError .= ', <a href="/admin/customers/customer-edit/' . $arCustomerRegistered['customer_id'] . '">ver cliente</a>';
                            $this->form_validation->set_error( 'customer_email', $sError );
                        break;
                    }
                }
            }
        }
        
        if( $arCustomer['state_id'] !== 0 )
        {
            $arCities = UtilsHelper::geOptionsDropdown( array( 'Seleccione' ), $this->oCities->getByStateId( $arCustomer['state_id'] ), 'city_id', 'city_name' );
        }
        
        $arMedia[''] = 'Seleccione';
        $arMedia += CustomersHelper::getCustomerMedia();
        
        $this->load->view( 'admin/customers/customer-edit', array(
            'arCities' => $arCities,
            'arCustomer' => $arCustomer,
            'arMedia' => $arMedia,
            'arCSS' => TemplatesHelper::getDefaultCSSFiles(),
            'arJS' => array_merge( TemplatesHelper::getDefaultJSFiles(), array( 'jquery.mask.min', 'customers' ) ),
            'arStates' => $arStates,
            'iCustomerId' => $iCustomerId,
            'bPermission' => $bPermission,
            'iCurrentUserId' => $this->arUser['user_id']
        ) );
    }
    public function customerNew()
    {
        $this->load->helper( 'form' );
        $this->load->library( 'form_validation' );
        $this->config->load( 'admin/customers/customers' );
        $this->load->model( 'City_model', 'oCities' );
        $this->load->model( 'State_model', 'oStates' );
        
        define( 'NEW_CUSTOMER', '' );
        $arCities = array();
        $arConfigValidation = array();
        $arCustomer = array();
        $arMedia = array();
        $arStates = array();
        $arStatesPrepared = array();
        $bValid = FALSE;
        $bRedirectToPurchase = FALSE;
        $iCustomerId = 0;
        $iEpoch = 0;
        
        $arCustomer['customer_name'] = '';
        $arCustomer['customer_company'] = '';
        $arCustomer['customer_address'] = '';
        $arCustomer['customer_telephone'] = '';
        $arCustomer['customer_mobile'] = '';
        $arCustomer['customer_nextel'] = '';
        $arCustomer['customer_email'] = '';
        $arCustomer['state_id'] = 0;
        $arCustomer['city_id'] = 0;
        $arCustomer['customer_media'] = 0;
        $arCustomer['customer_comments'] = '';
        
        
        $arCities = array( 'Seleccione' );
        $arStates = UtilsHelper::geOptionsDropdown( array( 'Seleccione' ), $this->oStates->getAll(), 'state_id', 'state_name' );
        
        $arConfigValidation = $this->config->item( 'validation' );
        $this->form_validation->set_error_delimiters( '<div class="help-block">', '</div>' );
        $this->form_validation->set_rules( $arConfigValidation );
        $bValid = $this->form_validation->run();
        
        if( sizeof( $_POST ) )
        {
            $arCustomer = array(
                'customer_name' => $this->input->post( 'customer_name' ),
                'customer_company' => $this->input->post( 'customer_company' ),
                'customer_address' => $this->input->post( 'customer_address' ),
                'customer_telephone' => $this->input->post( 'customer_telephone' ),
                'customer_mobile' => $this->input->post( 'customer_mobile' ),
                'customer_nextel' => $this->input->post( 'customer_nextel' ),
                'customer_email' => $this->input->post( 'customer_email' ),
                'state_id' => ( int ) $this->input->post( 'state_id' ),
                'city_id' => ( int ) $this->input->post( 'city_id' ),
                'customer_media' => ( int ) $this->input->post( 'customer_media' ),
                'customer_comments' => $this->input->post( 'customer_comments' )
            ) ;
            
            if( $this->input->post( 'action' ) === '2' )
            {
                $bRedirectToPurchase = TRUE;
            }
            
            
            if( $bValid )
            {    
                $iEpoch = time();
                $arCustomer['customer_created'] = $iEpoch;
                $arCustomer['customer_changed'] = $iEpoch;
                
                $arCustomer['user_id'] = $this->arUser['user_id'];
                $iCustomerId = $this->oCustomers->insert( $arCustomer );
                
                $this->session->set_flashdata( 'alert', array(
                    'class' => 'alert-success',
                    'message' => 'Operación realizada con éxito'
                ) );
                
                if( $bRedirectToPurchase )
                {
                    redirect( '/admin/purchases/purchase-new?customer_id=' . $iCustomerId, 'refresh' );
                }
                else
                {
                    redirect( '/admin/customers', 'refresh' );
                }
            }
            else
            {
                $this->lang->load( 'form_validation', 'spanish' );
                $arValidationsUnique = array();
                $arCustomerRegistered = array();
                $sError = '';
                
                $arValidationsUnique = UtilsHelper::getUniqueValidations( $arConfigValidation );
                
                foreach( $arValidationsUnique as $k => $v )
                {
                    if( strip_tags( form_error( $v['field'] ) ) === 
                        sprintf( $this->lang->line( 'is_unique' ), $v['label'] ) )
                    {
                        switch( $v['field'] )
                        {
                            case 'customer_name':
                                $arCustomerRegistered = $this->oCustomers->getByCustomerName( $arCustomer['customer_name'] );
                                $sError = strip_tags( form_error( $v['field'] ) );
                                $sError .= ', <a href="/admin/customers/customer-edit/' . $arCustomerRegistered['customer_id'] . '">ver cliente</a>';
                                $this->form_validation->set_error( 'customer_name', $sError );
                            break;
                            case 'customer_telephone':
                                $arCustomerRegistered = $this->oCustomers->getByCustomerTelephone( $arCustomer['customer_telephone'] );
                                $sError = strip_tags( form_error( $v['field'] ) );
                                $sError .= ', <a href="/admin/customers/customer-edit/' . $arCustomerRegistered['customer_id'] . '">ver cliente</a>';
                                $this->form_validation->set_error( 'customer_telephone', $sError );
                            break;
                            case 'customer_mobile':
                                $arCustomerRegistered = $this->oCustomers->getByCustomerMobile( $arCustomer['customer_mobile'] );
                                $sError = strip_tags( form_error( $v['field'] ) );
                                $sError .= ', <a href="/admin/customers/customer-edit/' . $arCustomerRegistered['customer_id'] . '">ver cliente</a>';
                                $this->form_validation->set_error( 'customer_mobile', $sError );
                            break;
                            case 'customer_nextel':
                                $arCustomerRegistered = $this->oCustomers->getByCustomerNextel( $arCustomer['customer_nextel'] );
                                $sError = strip_tags( form_error( $v['field'] ) );
                                $sError .= ', <a href="/admin/customers/customer-edit/' . $arCustomerRegistered['customer_id'] . '">ver cliente</a>';
                                $this->form_validation->set_error( 'customer_nextel', $sError );
                            break;
                            case 'customer_email':
                                $arCustomerRegistered = $this->oCustomers->getByCustomerEmail( $arCustomer['customer_email'] );
                                $sError = strip_tags( form_error( $v['field'] ) );
                                $sError .= ', <a href="/admin/customers/customer-edit/' . $arCustomerRegistered['customer_id'] . '">ver cliente</a>';
                                $this->form_validation->set_error( 'customer_email', $sError );
                            break;
                        }
                    }
                }
                
                if( $arCustomer['state_id'] !== 0 )
                {
                    $arCities = UtilsHelper::geOptionsDropdown( array( 'Seleccione' ), $this->oCities->getByStateId( $arCustomer['state_id'] ), 'city_id', 'city_name' );
                }
            }
        }
        
        $arMedia[''] = 'Seleccione';
        $arMedia += CustomersHelper::getCustomerMedia();
        
        $this->load->view( 'admin/customers/customer-new', array(
            'arCities' => $arCities,
            'arCustomer' => $arCustomer,
            'arMedia' => $arMedia,
            'arCSS' => TemplatesHelper::getDefaultCSSFiles(),
            'arJS' => array_merge( TemplatesHelper::getDefaultJSFiles(), array( 'jquery.mask.min', 'customers' ) ),
            'arStates' => $arStates
        ) );
        
    }
    public function customerStatistics()
    {
        
        /*
         * TODO 
         * Validar q el estado y la ciudad correspondan
         * Y pos obvio q existan
         */
        
        $this->load->helper( 'form' );
        $this->load->helper( 'Purchases' );
        $this->load->model( 'City_model', 'oCities' );
        $this->load->model( 'Purchase_model', 'oPurchases' );
        $this->load->model( 'State_model', 'oStates' );
        
        define( 'STATISTICS', '' );
        
        $arCustomersGroupedByMedia = array();
        $arCustomersGroupedByState = array();
        $arCustomersGroupedByCity = array();
        $arMedia = array();
        $arPurchasesGroupedByStatus = array();
        $arPurchaseStatus = array();
        $arPurchasesGroupedByArticleStatus = array();
        $arStates = array();
        $arCities = array();
        $arUsers = array();
        $iCityId = 0;
        $iStateId = 0;
        $iUserId = 0;
        
        $iCityId = ( int ) trim( $this->input->get( 'city_id' ) );
        $iStateId = ( int ) trim( $this->input->get( 'state_id' ) );
        $iUserId = ( int ) trim( $this->input->get( 'user_id' ) );
        
        $arUsers = $this->ion_auth->order_by( 'first_name', 'asc' )->users()->result_array();
        $arUsers = UtilsHelper::geOptionsDropdown( array( 'Todos los usuarios' ), $arUsers, 'user_id', 'first_name' );
        
        if( $iStateId !== 0 )
        {
            $arCities = UtilsHelper::geOptionsDropdown( array( 'Todas las ciudades' ), $this->oCities->getByStateId( $iStateId ), 'city_id', 'city_name' );
            $arCustomersGroupedByCity = $this->oCustomers->getCustomersTotalGroupedByCity( $iStateId, $iCityId );
        }
        else
        {
            $arCities = array( 'Todas las ciudades' );
        }
        
        $arStates = UtilsHelper::geOptionsDropdown( array( 'Todos los estados' ), $this->oStates->getAll(), 'state_id', 'state_name' );
        
        $arMedia = CustomersHelper::getCustomerMedia();
        $arCustomersGroupedByMedia = $this->oCustomers->getCustomersTotalGroupedByMedia( $iStateId, $iCityId, $iUserId );
        $arPurchaseStatus = PurchasesHelper::getPurchaseStatus();
        
        foreach( $arCustomersGroupedByMedia as $k => $v )
        {
           $arCustomersGroupedByMedia[$k]['customer_media'] = $arMedia[$v['customer_media']];
        }
        
        $arCustomersGroupedByState = $this->oCustomers->getCustomersTotalGroupedByState( $iStateId, $iCityId, $iUserId );
        
        $arPurchasesGroupedByStatus = $this->oPurchases->getPurchasesTotalGroupedByStatus( $iStateId, $iCityId, $iUserId );
        
        foreach( $arPurchasesGroupedByStatus as $k => $v )
        {
            $arPurchasesGroupedByStatus[$k]['purchase_status'] = $arPurchaseStatus[$arPurchasesGroupedByStatus[$k]['purchase_status']];
        }
        
        $arPurchasesGroupedByArticleStatus = $this->oPurchases->getPurchasesTotalGroupedByArticleStatus( $iStateId, $iCityId, $iUserId );
        
        foreach( $arPurchasesGroupedByArticleStatus as $k => $v )
        {
            if( $arPurchasesGroupedByArticleStatus[$k]['purchase_article_status'] === '1')
            {
                $arPurchasesGroupedByArticleStatus[$k]['purchase_article_status'] = 'Disponible';
            }
            else
            {
                $arPurchasesGroupedByArticleStatus[$k]['purchase_article_status'] = 'No disponible';
            }
        }
        
        
        $this->load->view( 'admin/customers/customer-statistics', array(
            'arCities' => $arCities,
            'arCSS' => TemplatesHelper::getDefaultCSSFiles(),
            'arCustomersGroupedByMedia' => $arCustomersGroupedByMedia,
            'arCustomersGroupedByState' => $arCustomersGroupedByState,
            'arCustomersGroupedByCity' => $arCustomersGroupedByCity,
            'arJS' => array_merge( TemplatesHelper::getDefaultJSFiles(), array( 'customers' ) ),
            'arPurchasesGroupedByStatus' => $arPurchasesGroupedByStatus,
            'arPurchasesGroupedByArticleStatus' => $arPurchasesGroupedByArticleStatus,
            'arStates' => $arStates,
            'arUsers' => $arUsers,
            'iCityId' => $iCityId,
            'iStateId' => $iStateId,
            'iUserId' => $iUserId
        ) );
    }
    public function index( $iPageNumber = 1 )
    {   
        $this->load->helper( 'form' );
        $this->load->helper( 'text' );
        $this->config->load( 'admin/pagination' );
        $this->load->library( 'pagination' );
        $this->load->model( 'State_model', 'oStates' );
        
        define( 'ALL_CUSTOMERS', '' );
        $arAlert = array();
        $arConfigPagination = array();
        $arCustomers = array();
        $arGetParams = array();
        $arMedia = array();
        $arStates = array();
        $arUsers = array();
        $iCustomers = 0;
        $iLimit = 0;
        $iOffset = 0;
        $iPageNumber = ( int ) $iPageNumber;
        $iStateId = 0;
        $iTotalPages = 0;
        $iUserId = 0;
        $sLike = '';
        $sPagination = '';
        
        $arStates = UtilsHelper::geOptionsDropdown( array( 'Todos los estados' ), $this->oStates->getAll(), 'state_id', 'state_name' );
        $arUsers = $this->ion_auth->order_by( 'first_name', 'asc' )->users()->result_array();
        $arUsers = UtilsHelper::geOptionsDropdown( array( 'Todos los usuarios' ), $arUsers, 'user_id', 'first_name' );
        
        $iStateId = ( int ) trim( $this->input->get( 'state_id' ) );
        $iUserId = ( int ) trim( $this->input->get( 'user_id' ) );
        $sLike = trim( $this->input->get( 's' ) );

        $iCustomers = $this->oCustomers->getCount( $sLike, $iUserId, $iStateId );
        
        $arConfigPagination = $this->config->item( 'pagination' );
        $arConfigPagination['base_url'] = '/admin/customers';
        $arConfigPagination['total_rows'] = $iCustomers;
        
        if( $iStateId )
        {
            $arGetParams['state_id'] = $iStateId;
        }
        if( $iUserId )
        {
            $arGetParams['user_id'] = $iUserId;
        }
        if( $sLike )
        {
            $arGetParams['s'] = $sLike;
        }
        
        if( sizeof( $arGetParams ) )
        {
            $arConfigPagination['first_url'] = '/admin/customers/?' . http_build_query( $arGetParams );
            $arConfigPagination['suffix'] = '?' . http_build_query( $arGetParams );
        }
        
        
        $iLimit = $arConfigPagination['per_page'];
        $iOffset = ( $iLimit )  * ( $iPageNumber - 1 );
        $iTotalPages = ceil( $iCustomers / $iLimit );

        if( ( $iPageNumber !== 1 ) &&
            ( $iPageNumber > $iTotalPages ) )
        {
            redirect( '/admin/customers', 'refresh' );
        }
        
        $arMedia = CustomersHelper::getCustomerMedia();
        
        $arCustomers = $this->oCustomers->getCustomers( $iLimit, $iOffset, $sLike, $iUserId, $iStateId );
        
        foreach( $arCustomers as $k => $v )
        {
            
            $arCustomers[$k]['customer_comments'] = UtilsHelper::getWrappedString( $arCustomers[$k]['customer_comments'], 100 );
            
            if( $sLike )
            {
                $arCustomers[$k]['customer_name'] = highlight_phrase( $arCustomers[$k]['customer_name'], $sLike, '<span class="highlight">', '</span>' );
                $arCustomers[$k]['customer_telephone'] = highlight_phrase( $arCustomers[$k]['customer_telephone'], $sLike, '<span class="highlight">', '</span>' );
                $arCustomers[$k]['customer_mobile'] = highlight_phrase( $arCustomers[$k]['customer_mobile'], $sLike, '<span class="highlight">', '</span>' );
                $arCustomers[$k]['customer_nextel'] = highlight_phrase( $arCustomers[$k]['customer_nextel'], $sLike, '<span class="highlight">', '</span>' );
                $arCustomers[$k]['customer_email'] = highlight_phrase( $arCustomers[$k]['customer_email'], $sLike, '<span class="highlight">', '</span>' );
            }
            
            if( $arCustomers[$k]['customer_media'] === '0' )
            {
                $arCustomers[$k]['customer_media'] = '';
            }
            else
            {
                $arCustomers[$k]['customer_media'] = $arMedia[$arCustomers[$k]['customer_media']];
            }
            
            $arCustomers[$k]['customer_created'] = UtilsHelper::getHumanReadableDate( ( int ) $arCustomers[$k]['customer_created'] );
            
            if( $arCustomers[$k]['customer_changed'] )
            {
                $arCustomers[$k]['customer_changed'] = UtilsHelper::getHumanReadableDate( ( int ) $arCustomers[$k]['customer_changed'] );
            }
        }
        
        $this->pagination->initialize( $arConfigPagination ); 
        $sPagination = $this->pagination->create_links();
        $arAlert = $this->session->flashdata( 'alert' );
        
        $this->load->view( 'admin/customers/index', array(
            'arAlert' => $arAlert,
            'arCSS' => TemplatesHelper::getDefaultCSSFiles(),
            'arCustomers' => $arCustomers,
            'arJS' => array_merge( TemplatesHelper::getDefaultJSFiles(), array( 'customers' ) ),
            'arStates' => $arStates,
            'arUsers' => $arUsers,
            'iCurrentUserId' => $this->arUser['user_id'],
            'iCustomers' => $iCustomers,
            'iStateId' => $iStateId,
            'iUserId' => $iUserId,
            'sPagination' => $sPagination, 
            'sLike' => $sLike
        ) );  
    }
}

/* End of file customers.php */
/* Location: ./application/controllers/admin/customers.php */