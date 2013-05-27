<?php
/*
 * @author ggonzalez
 * @26 October 2012
 */

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Statics extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper( 'Categories' );
        $this->load->model( 'Category_model', 'oCategories' );
    }
    public function about()
    {
        define( 'ABOUT', '' );
        $arCategories = array();
        
        $arCategories = $this->oCategories->getCategories();
        $arCategories = CategoriesHelper::getCategoriesTree( $arCategories );
        $arCategories = CategoriesHelper::getCategoriesLeveled( $arCategories );
        
        $this->load->view( 'public/statics/about', array(
            'arCategories' => $arCategories,
            'sTitle' => 'Derecha Trucks | Quienes somos'
        ) );
    }
    public function contact()
    {
        $this->load->helper( 'form' );
        $this->load->library( 'form_validation' );
        
        define( 'CONTACT', '' );
        $arCategories = array();
        $bSent = FALSE;
        
        $arCategories = $this->oCategories->getCategories();
        $arCategories = CategoriesHelper::getCategoriesTree( $arCategories );
        $arCategories = CategoriesHelper::getCategoriesLeveled( $arCategories );
        
        $this->form_validation->set_error_delimiters( '<div class="form-error">', '</div>' );
        $this->form_validation->set_message( 'required', 'No puede estar en blanco' );
        $this->form_validation->set_message( 'valid_email', 'Deberia parecer un email' );
        $this->form_validation->set_rules( 'name', 'Username', 'trim|required' );
        $this->form_validation->set_rules( 'telephone', 'Password', 'trim|required' );
        $this->form_validation->set_rules( 'email', 'Password Confirmation', 'trim|required|valid_email' );
        $this->form_validation->set_rules( 'comments', 'Email', 'trim|required' );
        
        if( $this->form_validation->run() == TRUE )
        {
            $this->load->library( 'email' );
            $this->email->from( $this->input->post( 'email' ), $this->input->post( 'name' ) );
            $this->email->to( 'ventas@derechatrucks.com' );
            $this->email->subject( 'Forma de contacto' );
            $this->email->message( implode( "\n", array( 
                'Nombre:' . $this->input->post( 'name' ),
                'Telefono:' . $this->input->post( 'telephone' ),
                'Email:' . $this->input->post( 'email' ),
                'Comentarios:' . $this->input->post( 'comments' )
            ) ) );
            
            if( $this->email->send() )
            {
                $bSent = TRUE;
            }
        }
        
        $this->load->view( 'public/statics/contact', array(
            'arCategories' => $arCategories,
            'bSent' => $bSent,
            'sTitle' => 'Derecha Trucks | Contacto'
        ) );
    }
}

/* End of file statics.php */
/* Location: ./application/controllers/statics.php */