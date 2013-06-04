<?php
/*
 * @author  ggonzalez
 * @date    1 June 2013
 */

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Slides extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library( 'ion_auth' );
        
        if( ! $this->ion_auth->logged_in() )
        {
            redirect( 'admin/login', 'refresh' );
        }

        $this->load->helper( 'form' );
        $this->load->helper( 'Templates' );
        $this->load->model( 'Slide_model', 'oSlides' );
        
        define( 'SLIDES', '' );
    }
    public function index( $iPageNumber = 1 )
    {
        $this->load->helper( 'form' );
        $this->config->load( 'admin/pagination' );
        $this->load->library( 'pagination' );
        
        $arAlert = array();
        $arSlides = array();
        $arCategories = array();
        $arConfigPagination = array();
        $arGetParams = array();
        $arPicture = array();
        
        $iSlideActive = 2;
        $iSlides = 0;
        $iLimit = 0;
        $iOffset = 0;
        $iPageNumber = ( int ) $iPageNumber;
        $iTotalPages = 0;
        $sLike = '';
        $sPagination = '';
        
        define( 'ALL_SLIDES', '' );
        
        
        $sLike = trim( $this->input->get( 's' ) );
        
        if( isset( $_GET['slide_active'] ) )
        {
            $iSlideActive = ( int ) $this->input->get( 'slide_active' );
        }
        
        $iSlides = $this->oSlides->getCountSlides( $sLike, $iSlideActive );
        
        $arConfigPagination = $this->config->item( 'pagination' );
        $arConfigPagination['per_page'] = 10;
        $arConfigPagination['base_url'] = '/admin/slides';
        $arConfigPagination['total_rows'] = $iSlides;
        
        if( $sLike )
        {
            $arGetParams['s'] = $sLike;
        }
        
        if( sizeof( $arGetParams ) )
        {
            $arConfigPagination['first_url'] = '/admin/slides?' . http_build_query( $arGetParams );
            $arConfigPagination['suffix'] = '?' . http_build_query( $arGetParams );
        }
        
        $iLimit = $arConfigPagination['per_page'];
        $iOffset = ( $iLimit )  * ( $iPageNumber - 1 );
        $iTotalPages = ceil( $iSlides / $iLimit );

        if( ( $iPageNumber !== 1 ) &&
            ( $iPageNumber > $iTotalPages ) )
        {
            redirect( '/admin/slides', 'refresh' );
        }
        
        $this->pagination->initialize( $arConfigPagination ); 
        $sPagination = $this->pagination->create_links();
        
        $arAlert = $this->session->flashdata( 'alert' );
        $arSlides = $this->oSlides->getSlides( $iLimit, $iOffset, $sLike, $iSlideActive );

        foreach( $arSlides as $k => $v )
        {
            $arSlides[$k]['slide_changed'] = UtilsHelper::getHumanReadableDate( ( int ) $arSlides[$k]['slide_changed'] );
            $arSlides[$k]['slide_created'] = UtilsHelper::getHumanReadableDate( ( int ) $arSlides[$k]['slide_created'] );
        }
        
        $this->load->view( 'admin/slides/index', array(
            'arAlert' => $arAlert,
            'arSlides' => $arSlides,
            'arCSS' => TemplatesHelper::getDefaultCSSFiles(),
            'iSlideActive' => $iSlideActive,
            'iSlides' => $iSlides,
            'arJS' => array_merge( TemplatesHelper::getDefaultJSFiles(), array( 'slides' ) ),
            'sLike' => $sLike,
            'sPagination' => $sPagination
        ) );
    }
    public function slideActivate( $iSlideId = 0 )
    {
        $this->load->library( 'user_agent' );
        
        $iSlideId = ( int ) $iSlideId;
        $arSlide = array();
        $arReferrer = array();
        $sRedirect = '';
        
        $arSlide = $this->oSlides->getSlideById( $iSlideId );
        
        if( ! sizeof( $arSlide ) )
        {
            show_404();
        }
        
        $this->oSlides->updateSlide( array( 'slide_active' => 1, 'slide_changed' => time() ), $iSlideId );
        
        $this->session->set_flashdata( 'alert', array(
            'class' => 'alert-success',
            'message' => 'Operación realizada con éxito'
        ) );
        
        $sRedirect = '/admin/slides';
        $arReferrer = parse_url( $this->agent->referrer() );
        
        if( ( $arReferrer ) && 
            ( isset( $arReferrer['query'] ) ) )
        {
            $sRedirect .= '?' . $arReferrer['query'];
        }

        redirect( $sRedirect, 'refresh' );
    }
    public function slideDeactivate( $iSlideId = 0 )
    {
        $this->load->library( 'user_agent' );
        
        $iSlideId = ( int ) $iSlideId;
        $arSlide = array();
        $arReferrer = array();
        $sRedirect = '';
        
        $arSlide = $this->oSlides->getSlideById( $iSlideId );
        
        if( ! sizeof( $arSlide ) )
        {
            show_404();
        }
        
        $this->oSlides->updateSlide( array( 'slide_active' => 0, 'slide_changed' => time() ), $iSlideId );
        
        $this->session->set_flashdata( 'alert', array(
            'class' => 'alert-success',
            'message' => 'Operación realizada con éxito'
        ) );
        
        $sRedirect = '/admin/slides';
        $arReferrer = parse_url( $this->agent->referrer() );
        
        if( ( $arReferrer ) && 
            ( isset( $arReferrer['query'] ) ) )
        {
            $sRedirect .= '?' . $arReferrer['query'];
        }

        redirect( $sRedirect, 'refresh' );
    }
    public function slideDelete( $iSlideId = 0 )
    {   
        $iSlideId = ( int ) $iSlideId;
        $arSlide = array();
        
        $arSlide = $this->oSlides->getSlideById( $iSlideId );
        
        if( ! sizeof( $arSlide ) )
        {
            show_404();
        }
        
        if( sizeof( $_POST ) )
        {
            $this->oSlides->deleteSlide( $iSlideId );
            $this->session->set_flashdata( 'alert', array(
                'class' => 'alert-success',
                'message' => 'Operación realizada con éxito'
            ) );

            redirect( '/admin/slides', 'refresh' );
        }
        
        $this->load->view( 'admin/slides/slide-delete', array(
            'arSlide' => $arSlide,
            'arCSS' => TemplatesHelper::getDefaultCSSFiles(),
            'arJS' => TemplatesHelper::getDefaultJSFiles(),
            'iSlideId' => $iSlideId
        ) );
    }
    public function slideEdit( $iSlideId = 0 )
    {
        $iSlideId = ( int ) $iSlideId;
        $arSlide = array();
        
        $arSlide = $this->oSlides->getSlideById( $iSlideId );
        
        if( ! sizeof( $arSlide ) )
        {
            show_404();
        }
        
        $this->config->load( 'admin/slides/slide' );
        $this->load->library( 'form_validation' );
        $this->load->library( 'image_lib' );
        $this->load->library( 'upload' );        
        
        $arConfigResizeImage = array();
        $arConfigUpload = array();
        $arResponseUpload = array();
        $arValidations = array();
        $bValid = FALSE;
        $bBadge = FALSE;
        $iEpoch = time();
        $sUploadError = '';
        
        $bBadge = ( boolean ) $arSlide['slide_badge'];
                
        if( sizeof( $_POST ) )
        {
            $iEpoch = time();
            
            $arValidations = $this->config->item( 'validation' );
            $this->form_validation->set_error_delimiters( '<span class="help-block">', '</span>' );
            $this->form_validation->set_rules( $arValidations );
            $bValid = $this->form_validation->run();
            
            $arSlide['slide_anchor'] = $this->input->post( 'slide_anchor' );
            $arSlide['slide_badge'] = ( int ) $this->input->post( 'slide_badge' );
            $arSlide['slide_changed'] = $iEpoch;
            $arSlide['slide_created'] = $iEpoch;
            $arSlide['slide_title'] = $this->input->post( 'slide_title' );
            
            if( ($_FILES['slide_name']['error'] !== UPLOAD_ERR_NO_FILE ) )
            {
                $arConfigUpload = $this->config->item( 'upload' );
                $this->upload->initialize( $arConfigUpload );
                
                if( $this->upload->do_upload( 'slide_name' ) )
                {
                    $arResponseUpload = $this->upload->data();
                    $arSlide['slide_name'] = $arResponseUpload['file_name'];

                    $arConfigResizeImage = $this->config->item( 'image_manipulation' );
                    $arConfigResizeImage['source_image'] = $arConfigUpload['upload_path'] . '/' . $arSlide['slide_name'];

                    if( $bValid )
                    {
                        $this->image_lib->initialize( $arConfigResizeImage );
                        $this->image_lib->resize();
                        $this->image_lib->clear();
                    }
                    elseif( file_exists( $arConfigResizeImage['source_image'] ) )
                    {
                        unlink( $arConfigResizeImage['source_image'] );
                    }
                }
                else
                {
                    $bBadge = ( boolean ) $arSlide['slide_badge'];
                    $bValid = FALSE;
                    $sUploadError = $this->upload->display_errors( '<span class="help-block">', '</span>' );
                }
            }
            if( $bValid )
            {
                $this->oSlides->updateSlide( $arSlide, $iSlideId );
                $this->session->set_flashdata( 'alert', array(
                    'class' => 'alert-success',
                    'message' => 'Operación realizada con éxito'
                ) );
                redirect( '/admin/slides', 'refresh' );    
            }
        }   // End if( sizeof( $_POST ) )
        
        $this->load->view( 'admin/slides/slide-edit', array(
            'arCSS' => TemplatesHelper::getDefaultCSSFiles(),
            'arSlide' => $arSlide,
            'arJS' => TemplatesHelper::getDefaultJSFiles(),
            'bBadge' =>$bBadge,
            'iSlideId' => $iSlideId,
            'sUploadError' => $sUploadError
        ) );
    }
    public function slideNew()
    {   
        $this->config->load( 'admin/slides/slide' );
        $this->load->library( 'form_validation' );
        $this->load->library( 'image_lib' );
        $this->load->library( 'upload' );        
        
        $arConfigResizeImage = array();
        $arConfigUpload = array();
        $arResponseUpload = array();
        $arSlide = array();
        $arValidations = array();
        $bValid = FALSE;
        $iEpoch = time();
        $sUploadError = '';
                
        if( sizeof( $_POST ) )
        {
            $iEpoch = time();
            
            $arValidations = $this->config->item( 'validation' );
            $this->form_validation->set_error_delimiters( '<span class="help-block">', '</span>' );
            $this->form_validation->set_rules( $arValidations );
            $bValid = $this->form_validation->run();
            
            $arConfigUpload = $this->config->item( 'upload' );
            $this->upload->initialize( $arConfigUpload );
            
            if( $this->upload->do_upload( 'slide_name' ) )
            {
                $arResponseUpload = $this->upload->data();
                
                $arSlide['slide_anchor'] = $this->input->post( 'slide_anchor' );
                $arSlide['slide_badge'] = ( int ) $this->input->post( 'slide_badge' );
                $arSlide['slide_changed'] = $iEpoch;
                $arSlide['slide_created'] = $iEpoch;
                $arSlide['slide_name'] = $arResponseUpload['file_name'];
                $arSlide['slide_title'] = $this->input->post( 'slide_title' );
                
                $arConfigResizeImage = $this->config->item( 'image_manipulation' );
                $arConfigResizeImage['source_image'] = $arConfigUpload['upload_path'] . '/' . $arSlide['slide_name'];
                
                if( $bValid )
                {
                    $this->image_lib->initialize( $arConfigResizeImage );
                    $this->image_lib->resize();
                    $this->image_lib->clear();
                    
                    $this->oSlides->insertSlide( $arSlide );

                    $this->session->set_flashdata( 'alert', array(
                        'class' => 'alert-success',
                        'message' => 'Operación realizada con éxito'
                    ) );

                    redirect( '/admin/slides', 'refresh' );    
                }
                elseif( file_exists( $arConfigResizeImage['source_image'] ) )
                {
                    unlink( $arConfigResizeImage['source_image'] );
                }
            }
            else
            {
                $sUploadError = $this->upload->display_errors( '<span class="help-block">', '</span>' );
            }   // End if( $this->upload->do_upload( 'slide_name' ) )
        }   // End if( sizeof( $_POST ) )
        
        $this->load->view( 'admin/slides/slide-new', array(
            'arCSS' => TemplatesHelper::getDefaultCSSFiles(),
            'arJS' => TemplatesHelper::getDefaultJSFiles(),
            'sUploadError' => $sUploadError
        ) );
    }
}

/* End of file slides.php */
/* Location: ./application/controllers/admin/slides.php */
