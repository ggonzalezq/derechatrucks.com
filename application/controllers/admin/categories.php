<?php
/*
 * @author  ggonzalez
 * @date    12 March 2013
 */

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Categories extends CI_Controller
{   
    public function __construct()
    {
        parent::__construct();
        $this->load->helper( 'Categories' );
        $this->load->helper( 'Templates' );
        $this->load->library( 'ion_auth' );
        $this->load->model( 'Category_model', 'oCategories' );
        
        if( ! $this->ion_auth->is_admin() )
        {
            show_404();
        }
        
        define( 'CATEGORIES', '' );
    }
    public function index()
    {
        define( 'ALL_CATEGORIES', '' );
        $arAlert = array();
        $arCategories = array();
        
        $arAlert = $this->session->flashdata( 'alert' );
        
        $arCategories = $this->oCategories->getCategories();
        $arCategories = CategoriesHelper::getCategoriesTree( $arCategories );
        $arCategories = CategoriesHelper::getCategoriesLeveled( $arCategories );
        
        foreach( $arCategories as $k => $v )
        {
            $arCategories[$k]['category_changed'] = UtilsHelper::getHumanReadableDate( ( int ) $arCategories[$k]['category_changed'] );
            $arCategories[$k]['category_created'] = UtilsHelper::getHumanReadableDate( ( int ) $arCategories[$k]['category_created'] );
        }
        
        $this->load->view( 'admin/categories/index', array(
            'arAlert' => $arAlert,
            'arCategories' => $arCategories,
            'arCSS' => TemplatesHelper::getDefaultCSSFiles(),
            'arJS' => TemplatesHelper::getDefaultJSFiles()
        ) );
        
    }
    public function categoryDelete( $iCategoryId )
    {
        $arCategory = array();
        $iCategoryId = ( int ) $iCategoryId;
        
        $arCategory = $this->oCategories->getById( $iCategoryId );
        
        if( ! sizeof( $arCategory ) )
        {
            show_404();
        }
        
        $this->load->helper( 'form' );
        
        if( sizeof( $_POST ) )
        {
            $this->oCategories->delete( $iCategoryId );
            
            $this->session->set_flashdata( 'alert', array(
                'class' => 'alert-success',
                'message' => 'Operación realizada con éxito'
            ) );
            
            redirect( '/admin/categories', 'refresh' );
        }
        
        $this->load->view( 'admin/categories/category-delete', array(
            'arCategory' => $arCategory,
            'arCSS' => TemplatesHelper::getDefaultCSSFiles(),
            'arJS' => TemplatesHelper::getDefaultJSFiles(),
            'iCategoryId' => $iCategoryId
        ) );
        
    }
    public function categoryEdit( $iCategoryId )
    {
        $arCategory = array();
        $iCategoryId = ( int ) $iCategoryId;
        
        $arCategory = $this->oCategories->getById( $iCategoryId );
        
        if( ! sizeof( $arCategory ) )
        {
            show_404();
        }
        
        $this->config->load( 'admin/categories/categories' );
        $this->load->helper( 'form' );
        $this->load->library( 'form_validation' );
        
        $arCategories = array();
        $arValidations = array();
        $bValid = FALSE;
        $iEpoch = 0;
        
        $arCategory['category_parent'] = ( int ) $arCategory['category_parent'];
        
        $arCategories = $this->oCategories->getCategories();
        
        foreach( $arCategories as $k => $v )
        {
            if( $arCategories[$k]['category_id'] == $iCategoryId )
            {
                unset( $arCategories[$k] );
                break;
            }
        }
        
        
        $arCategories = CategoriesHelper::getCategoriesTree( $arCategories );
        $arCategories = CategoriesHelper::getCategoriesLeveled( $arCategories );
        $arCategories = UtilsHelper::geOptionsDropdown( array( 'Ninguna' ), $arCategories, 'category_id', 'category_name' );
        
        $arValidations = $this->config->item( 'validation' );
        
        if( sizeof( $_POST ) )
        {
            $iEpoch = time();
            
            $arCategory = array();
            $arCategory['category_changed'] = $iEpoch;
            $arCategory['category_name'] = $this->input->post( 'category_name' );
            $arCategory['category_parent'] = ( int ) $this->input->post( 'category_parent' );
            $arCategory['category_permalink'] = UtilsHelper::getPermalink( $arCategory['category_name'] );
            
            $this->form_validation->set_error_delimiters( '<span class="help-block">', '</span>' );
            $this->form_validation->set_rules( $arValidations );
            $bValid = $this->form_validation->run();
            
            if( $bValid )
            {
                if( $this->oCategories->update( $arCategory, $iCategoryId ) )
                {
                    $this->session->set_flashdata( 'alert', array(
                        'class' => 'alert-success',
                        'message' => 'Operación realizada con éxito'
                    ) );

                    redirect( '/admin/categories', 'refresh' );
                }
            }
        }   //End if( sizeof( $_POST ) )
        
        $this->load->view( 'admin/categories/category-edit', array(
            'arCategories' => $arCategories,
            'arCategory' => $arCategory,
            'arCSS' => TemplatesHelper::getDefaultCSSFiles(),
            'arJS' => TemplatesHelper::getDefaultJSFiles(),
            'iCategoryId' => $iCategoryId
        ) );
    }
    public function categoryNew()
    {
        $this->config->load( 'admin/categories/categories' );
        $this->load->helper( 'form' );
        $this->load->library( 'form_validation' );

        define( 'NEW_CATEGORY', '' );
        $arCategories = array();
        $arCategory = array();
        $arValidations = array();
        $bValid = FALSE;
        $iEpoch = 0;
        
        $arCategories = $this->oCategories->getCategories();
        $arCategories = CategoriesHelper::getCategoriesTree( $arCategories );
        $arCategories = CategoriesHelper::getCategoriesLeveled( $arCategories );
        $arCategories = UtilsHelper::geOptionsDropdown( array( 'Ninguna' ), $arCategories, 'category_id', 'category_name' );
        
        
        $arCategory['category_name'] = '';
        $arCategory['category_parent'] = 0;
        
        $arValidations = $this->config->item( 'validation' );
        
        if( sizeof( $_POST ) )
        {
            $iEpoch = time();
            
            $arCategory = array();
            $arCategory['category_changed'] = $iEpoch;
            $arCategory['category_created'] = $iEpoch;
            $arCategory['category_name'] = $this->input->post( 'category_name' );
            $arCategory['category_parent'] = ( int ) $this->input->post( 'category_parent' );
            $arCategory['category_permalink'] = UtilsHelper::getPermalink( $arCategory['category_name'] );
            
            $this->form_validation->set_error_delimiters( '<span class="help-block">', '</span>' );
            $this->form_validation->set_rules( $arValidations );
            $bValid = $this->form_validation->run();
            
            if( $bValid )
            {
                if( $this->oCategories->insert( $arCategory ) )
                {
                    $this->session->set_flashdata( 'alert', array(
                        'class' => 'alert-success',
                        'message' => 'Operación realizada con éxito'
                    ) );

                    redirect( '/admin/categories', 'refresh' );
                }
            }
        }   //End if( sizeof( $_POST ) )
        
        $this->load->view( 'admin/categories/category-new', array(
            'arCategories' => $arCategories,
            'arCategory' => $arCategory,
            'arCSS' => TemplatesHelper::getDefaultCSSFiles(),
            'arJS' => TemplatesHelper::getDefaultJSFiles()
        ) );
    }
}

/* End of file categories.php */
/* Location: ./application/controllers/admin/categories.php */
