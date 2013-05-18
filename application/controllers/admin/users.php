<?php
/*
 * @author  ggonzalez
 * @date    15 March 2013
 */

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper( 'Templates' );
        $this->load->library( 'ion_auth' );
        $this->load->library( 'session' );
        $this->lang->load( 'auth' );
        define( 'USERS', '' );
    }
    public function index()
    {
        if( ! $this->ion_auth->is_admin() )
        {
            show_404();
        }
        
        define( 'ALL_USERS', '' );
        $arAlert = array();
        $arGroups = array();
        $arUsers = array();
        
        $arAlert = $this->session->flashdata( 'alert' );
        $arUsers = $this->ion_auth->order_by( 'created_on', 'desc' )->users()->result_array();
        
        foreach( $arUsers as $k => $v )
        {
            $arUsers[$k]['created_on'] = ( int ) $arUsers[$k]['created_on'];
            $arUsers[$k]['created_on'] = UtilsHelper::getHumanReadableDate( $arUsers[$k]['created_on'] );
            
            $arGroups = $this->ion_auth->get_users_groups( $arUsers[$k]['id'] )->result_array();
            
            foreach( $arGroups as $key => $arGroup )
            {
                $arGroups[$key] = $arGroup['description'];
            }
            
            $arUsers[$k]['group'] = implode( ',', $arGroups );
        }
        
        $this->load->view( 'admin/users/index', array(
            'bIsAdmin' => TRUE,
            'arAlert' => $arAlert,
            'arCSS' => TemplatesHelper::getDefaultCSSFiles(),
            'arJS' => array_merge( TemplatesHelper::getDefaultJSFiles(), array( 'jquery.mask.min', 'users' ) ),
            'arUsers' => $arUsers
        ) );
        
    }
    public function userActivate( $iUserId )
    {
        if( ! $this->ion_auth->is_admin() )
        {
            show_404();
        }
        
        $arUser = array();
        $iUserId = ( int ) $iUserId;
        
        $arUser = $this->ion_auth->user( $iUserId )->row_array();
        
        if( ! sizeof( $arUser ) )
        {
            show_404();
        }
        
        $this->ion_auth->activate( $iUserId );
        $this->session->set_flashdata( 'alert', array(
            'class' => 'alert-success',
            'message' => 'Operación realizada con éxito'
        ) );

        redirect( '/admin/users', 'refresh' );        
    }
    public function userChangePassword()
    {        
    }
    public function userDeactivate( $iUserId )
    {
        $this->load->helper( 'form' );
        
        if( ! $this->ion_auth->is_admin() )
        {
            show_404();
        }
        
        $arUser = array();
        $iUserId = ( int ) $iUserId;
        
        $arUser = $this->ion_auth->user( $iUserId )->row_array();
        
        if( ! sizeof( $arUser ) )
        {
            show_404();
        }
        
        if( sizeof( $_POST ) )
        {
            $this->ion_auth->deactivate( $iUserId );
            
            $this->session->set_flashdata( 'alert', array(
                'class' => 'alert-success',
                'message' => 'Operación realizada con éxito'
            ) );
                
            redirect( '/admin/users', 'refresh' );
            
        }
        
        $this->load->view( 'admin/users/user-deactivate', array(
            'bIsAdmin' => TRUE,
            'arCSS' => TemplatesHelper::getDefaultCSSFiles(),
            'arJS' => TemplatesHelper::getDefaultJSFiles(),
            'arUser' => $arUser,
            'iUserId' => $iUserId
        ) );   
        
    }
    public function userEdit( $iUserId )
    {
        $this->load->helper( 'form' );
        $this->load->library( 'form_validation' );
        $this->config->load( 'admin/users/user-edit' );

        if( ! $this->ion_auth->is_admin() )
        {
            show_404();
        }
        
        $arUser = array();
        $iUserId = ( int ) $iUserId;
        
        $arUser = $this->ion_auth->user( $iUserId )->row_array();
        
        if( ! sizeof( $arUser ) )
        {
            show_404();
        }
        
        $arConfigValidation = array();
        $arGroups = array();
        $arUserData = array();
        $arUserGroup = array();
        $arUserGroups = array();
        $bValid = FALSE;
        
        
        $arUserGroups = $this->ion_auth->get_users_groups( $arUser['id'] )->result_array();
        $arUserGroup = reset( $arUserGroups );
        
        $arUser['password'] = '';
        $arUser['confirm_password'] = '';
        $arUser['group'] = ( int ) $arUserGroup['id'];
        
        $arGroups = $this->ion_auth->groups()->result_array();
        $arGroups = UtilsHelper::geOptionsDropdown( array( '' => 'Seleccione' ), $arGroups, 'id', 'description' );
        
        $arConfigValidation = $this->config->item( 'validation' );
        
        
        $this->form_validation->set_error_delimiters( '<div class="help-block">', '</div>' );
        
        if( sizeof( $_POST ) )
        {
            $arUser['group'] = ( int ) $this->input->post( 'group' );
            $arUser['first_name'] = $this->input->post( 'first_name' );
            $arUser['last_name'] = $this->input->post( 'last_name' );
            $arUser['email'] = $this->input->post( 'email' );
            $arUser['phone'] = $this->input->post( 'phone' );
            $arUser['password'] = $this->input->post( 'password' );
            $arUser['confirm_password'] = $this->input->post( 'confirm_password' );
            
            if( ( $arUser['password'] === '' ) &&
                ( $arUser['confirm_password'] === '' ) )
            {
                unset( $arConfigValidation[6], $arConfigValidation[7] );
            }
            
        }
        
        $this->form_validation->set_rules( $arConfigValidation );
        $bValid = $this->form_validation->run();
            
        if( $bValid )
        {
            if( $arUserGroup['id'] != $arUser['group'] )
            {
                $this->ion_auth->remove_from_group( '', $iUserId );
                $this->ion_auth->add_to_group( $arUser['group'], $iUserId );
            }
            
            $arUserData['first_name'] = $arUser['first_name'];
            $arUserData['last_name'] = $arUser['last_name'];
            $arUserData['email'] = $arUser['email'];
            $arUserData['phone'] = $arUser['phone'];
            
            if( $arUser['password'] !== '' )
            {
                $arUserData['password'] = $arUser['password'];
            }
            
            
            $this->ion_auth->update( $iUserId, $arUserData );

            $this->session->set_flashdata( 'alert', array(
                'class' => 'alert-success',
                'message' => 'Operación realizada con éxito'
            ) );

            redirect( '/admin/users', 'refresh' );   
        }
        
        $this->load->view( 'admin/users/user-edit', array(
            'bIsAdmin' => TRUE,
            'arCSS' => TemplatesHelper::getDefaultCSSFiles(),
            'arGroups' => $arGroups,
            'arJS' => array_merge( TemplatesHelper::getDefaultJSFiles(), array( 'jquery.mask.min', 'users' ) ),
            'arUser' => $arUser,
            'iUserId' => $iUserId
        ) );   
    }
    public function userForgotPassword()
    {
        $this->load->helper( 'form' );
        $this->load->library( 'form_validation' );
        $this->config->load( 'admin/users/user-forgot-password' );
        
        $arConfigValidation = array();
        $bValid = FALSE;
        $sEmail = '';
        
        $arConfigValidation = $this->config->item( 'validation' );

        $this->form_validation->set_error_delimiters( '<div class="help-block">', '</div>' );
        $this->form_validation->set_rules( $arConfigValidation );
        $bValid = $this->form_validation->run();
        
        $sEmail = $this->input->post( 'identity' );
        
        if( $bValid )
        {
            $arConfig = $this->config->item('tables', 'ion_auth');
            $oUser = $this->db->where( 'email', $sEmail )->limit( '1' )->get( $arConfig['users'] )->row();
            
            if( sizeof( $oUser ) )
            {
                $this->ion_auth->forgotten_password( $oUser->{$this->config->item( 'identity', 'ion_auth' )} );
            }
            
            redirect( '/admin/login', 'refresh' );
        }
        
        $this->load->view( 'admin/users/user-forgot-password', array(
            'sEmail' => $sEmail
        ) );
    }
    public function userLogin()
    {
        $this->load->helper( 'form' );
        $this->load->library( 'form_validation' );
        $this->config->load( 'admin/users/user-login' );
        
        if( $this->ion_auth->logged_in() )
        {
            redirect( '/admin/articles', 'refresh' );
        }
        
        $arConfigValidation = array();
        $arUser = array();
        $bValid = FALSE;
        
        $arConfigValidation = $this->config->item( 'validation' );
        
        $arUser['identity'] = '';
        $arUser['password'] = '';
        $arUser['remember'] = FALSE;

        $this->form_validation->set_error_delimiters( '<div class="help-block">', '</div>' );
        $this->form_validation->set_rules( $arConfigValidation );
        $bValid = $this->form_validation->run();
        
        if( sizeof( $_POST ) )
        {
            $arUser['identity'] = $this->input->post( 'identity' );
            $arUser['password'] = $this->input->post( 'password' );
            $arUser['remember'] = ( bool ) $this->input->post( 'remember' );
            
            if( ( $bValid ) &&
                ( $this->ion_auth->login( $arUser['identity'], $arUser['password'], $arUser['remember'] ) ) )
            {
                redirect( '/admin/articles', 'refresh' );
            }
        }
        
        $this->load->view( 'admin/users/user-login', array(
            'arUser' => $arUser
        ) );
    }
    public function userLogout()
    {
        $this->ion_auth->logout();
        redirect( 'admin/login', 'refresh' );
    }
    public function userNew()
    {
        $this->load->helper( 'form' );
        $this->load->library( 'form_validation' );
        $this->config->load( 'admin/users/user-new' );
        
        if( ! $this->ion_auth->is_admin() )
        {
            show_404();
        }
        
        define( 'NEW_USER', '' );
        $arGroups = array();
        $arUser = array();
        $bValid = FALSE;
        
        $arGroups = $this->ion_auth->groups()->result_array();
        $arGroups = UtilsHelper::geOptionsDropdown( array( '' => 'Seleccione' ), $arGroups, 'id', 'description' );
        
        $arUser['username'] = '';
        $arUser['group'] = 0;
        $arUser['first_name'] = '';
        $arUser['last_name'] = '';
        $arUser['email'] = '';
        $arUser['phone'] = '';
        $arUser['password'] = '';
        $arUser['confirm_password'] = '';
        
        $arConfigValidation = $this->config->item( 'validation' );
        $this->form_validation->set_error_delimiters( '<div class="help-block">', '</div>' );
        $this->form_validation->set_rules( $arConfigValidation );
        $bValid = $this->form_validation->run();
        
        if( sizeof( $_POST ) )
        {
            $arUser['username'] = $this->input->post( 'username' );
            $arUser['group'] = ( int ) $this->input->post( 'group' );
            $arUser['first_name'] = $this->input->post( 'first_name' );
            $arUser['last_name'] = $this->input->post( 'last_name' );
            $arUser['email'] = $this->input->post( 'email' );
            $arUser['phone'] = $this->input->post( 'phone' );
            $arUser['password'] = $this->input->post( 'password' );
            $arUser['confirm_password'] = $this->input->post( 'confirm_password' );
            
            if( $bValid )
            {
                $this->ion_auth->register( $arUser['username'],  $arUser['password'], $arUser['email'],
                    array(
                        'first_name' => $arUser['first_name'],
                        'last_name' => $arUser['last_name'],
                        'phone' => $arUser['phone']
                    ),
                    array( $arUser['group'] )
                );
                
                $this->session->set_flashdata( 'alert', array(
                    'class' => 'alert-success',
                    'message' => 'Operación realizada con éxito'
                ) );
                
                redirect( '/admin/users', 'refresh' );
                
            }
        }
        
        $this->load->view( 'admin/users/user-new', array(
            'bIsAdmin' => TRUE,
            'arCSS' => TemplatesHelper::getDefaultCSSFiles(),
            'arGroups' => $arGroups,
            'arJS' => array_merge( TemplatesHelper::getDefaultJSFiles(), array( 'jquery.mask.min', 'users' ) ),
            'arUser' => $arUser
        ) );
    }
    public function userResetPassword()
    {
        
    }
}

/* End of file users.php */
/* Location: ./application/controllers/admin/users.php */