<?php
/*
 * @author  ggonzalez
 * @date    17 March 2013
 */

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pictures extends CI_Controller
{
    private $arArticle;
    private $iArticleId;
    
    public function __construct()
    {
        parent::__construct();
        $this->load->helper( 'Pictures' );
        $this->load->helper( 'Templates' );
        $this->load->library( 'ion_auth' );
        $this->load->model( 'Article_model', 'oArticles' );
        $this->load->model( 'Picture_model', 'oPictures' );
        
        if( ! $this->ion_auth->logged_in() )
        {
            redirect('admin/login', 'refresh');
        }
        
        $this->arArticle = array();
        $this->iArticleId = 0;
        
        $this->iArticleId = ( int ) $this->input->get( 'article_id' );
        $this->arArticle = $this->oArticles->getById( FALSE, $this->iArticleId );
        
        if( ! sizeof( $this->arArticle ) )
        {
            show_404();
        }
    }
    public function index()
    {
        $this->load->helper( 'form' );
        
        $arAlert = array();
        $arPictures = array();
        
        $arAlert = $this->session->flashdata( 'alert' );
        $arPictures = $this->oPictures->getByArticleid( $this->iArticleId );
        
        foreach( $arPictures as $k => $v )
        {
            $arPictures[$k]['picture_created'] = UtilsHelper::getHumanReadableDate( ( int ) $arPictures[$k]['picture_created'] );
            $arPictures[$k]['picture_changed'] = UtilsHelper::getHumanReadableDate( ( int ) $arPictures[$k]['picture_changed'] );
        }
        
        $this->load->view( 'admin/pictures/index', array(
            'arAlert' => $arAlert,
            'arPictures' => $arPictures,
            'arCSS' => TemplatesHelper::getDefaultCSSFiles(),
            'arJS' => array_merge( TemplatesHelper::getDefaultJSFiles(), array( 'pictures' ) ),
            'iArticleId' => $this->iArticleId
        ) );        
    }
    public function pictureDelete( $iPictureId )
    {
        $this->load->helper( 'form' );
        
        $arPicture = array();
        $iPictureId = ( int ) $iPictureId;
        
        $arPicture = $this->oPictures->getById( $iPictureId );
        
        if( ! sizeof( $arPicture ) )
        {
            show_404();
        }
        
        if( sizeof( $_POST ) )
        {
            $this->oPictures->delete( $iPictureId );
            
            $this->session->set_flashdata( 'alert', array(
                'class' => 'alert-success',
                'message' => 'Operación realizada con éxito'
            ) );

            redirect( '/admin/pictures?article_id=' . $this->iArticleId, 'refresh' );
            
        }
        
        $this->load->view( 'admin/pictures/picture-delete', array(
            'arPicture' => $arPicture,
            'arCSS' => TemplatesHelper::getDefaultCSSFiles(),
            'arJS' => TemplatesHelper::getDefaultJSFiles(),
            'iArticleId' => $this->iArticleId,
            'iPictureId' => $iPictureId
        ) );
    }
    public function pictureEdit( $iPictureId )
    {
        $this->load->helper( 'form' );
        
        $arPicture = array();
        $iPictureId = ( int ) $iPictureId;
        
        $arPicture = $this->oPictures->getById( $iPictureId );
        
        if( ! sizeof( $arPicture ) )
        {
            show_404();
        }
        
        if( sizeof( $_POST ) )
        {
            $this->oPictures->update( array(
                'picture_alt' => $this->input->post( 'picture_alt' ),
                'picture_changed' => time(),
                'picture_title' => $this->input->post( 'picture_title' )
            ), $iPictureId );
            
            $this->session->set_flashdata( 'alert', array(
                'class' => 'alert-success',
                'message' => 'Operación realizada con éxito'
            ) );

            redirect( '/admin/pictures?article_id=' . $this->iArticleId, 'refresh' );
            
        }
        
        $this->load->view( 'admin/pictures/picture-edit', array(
            'arPicture' => $arPicture,
            'arCSS' => TemplatesHelper::getDefaultCSSFiles(),
            'arJS' => TemplatesHelper::getDefaultJSFiles(),
            'iArticleId' => $this->iArticleId,
            'iPictureId' => $iPictureId
        ) );
    }
    public function pictureNew()
    {
        $this->config->load( 'admin/pictures/picture-new' );
        $this->load->helper( 'form' );
        $this->load->library( 'image_lib' );
        $this->load->library( 'upload' );
        
        $arConfigResizeImages = array();
        $arConfigUpload = array();
        $arPathInfo = array();
        $arPicture = array();
        $arResponseUpload = array();
        $bValid = FALSE;
        $iEpoch = time();
        $sFileName = '';
        $sUploadError = '';
        $sUploadPath = '';
        
        $arConfigUpload = $this->config->item( 'upload' );
        $sUploadPath = $arConfigUpload['upload_path'] . $this->iArticleId;
        $arConfigUpload['upload_path'] = $sUploadPath;
        
        $arPicture['picture_alt'] = '';
        $arPicture['picture_name'] = '';
        $arPicture['picture_title'] = '';
        
        
        if( ( sizeof( $_FILES ) ) )
        {
            $iEpoch = time();
            $arPicture['picture_alt'] = $this->input->post( 'picture_alt' );
            $arPicture['picture_title'] = $this->input->post( 'picture_title' );
            $arPicture['picture_changed'] = $iEpoch;
            $arPicture['picture_created'] = $iEpoch;
            $arPicture['article_id'] = $this->iArticleId;

            PicturesHelper::makeDirectory( $arConfigUpload['upload_path'] );
                
            if( $_FILES['picture_name']['error'] !== UPLOAD_ERR_NO_FILE )
            {
                $arPathInfo = pathinfo( $_FILES['picture_name']['name'] );
                $sFileName = $arPathInfo['filename'];
                $sFileName = UtilsHelper::getPermalink( $sFileName );
                $sFileName .= '.' . $arPathInfo['extension'];
                $arConfigUpload['file_name'] = $sFileName;
            }

            $this->upload->initialize( $arConfigUpload );

            if( $this->upload->do_upload( 'picture_name' ) )
            {
                $arResponseUpload = $this->upload->data();
                $arPicture['picture_name'] = $arResponseUpload['file_name'];

                PicturesHelper::makeResizeDirectories( $arConfigUpload['upload_path'] );
                $arConfigResizeImages = $this->config->item( 'image_manipulation' );

                foreach( $arConfigResizeImages as $k => $v )
                {
                    $arConfigResizeImages[$k]['source_image'] = $sUploadPath . '/' . $arPicture['picture_name'];
                    $arConfigResizeImages[$k]['new_image'] = $sUploadPath . $arConfigResizeImages[$k]['new_image'] . '/' . $arPicture['picture_name'];
                    $this->image_lib->initialize( $arConfigResizeImages[$k] );
                    $this->image_lib->resize();
                    $this->image_lib->clear();
                }

                $this->oPictures->insert( $arPicture );
                $this->session->set_flashdata( 'alert', array(
                    'class' => 'alert-success',
                    'message' => 'Operación realizada con éxito'
                ) );

                redirect( '/admin/pictures?article_id=' . $this->iArticleId, 'refresh' );

            }
            else
            {
                $sUploadError = $this->upload->display_errors( '<span class="help-block">', '</span>' );
            }
        }
        
        $this->load->view( 'admin/pictures/picture-new', array(
            'arPicture' => $arPicture,
            'arCSS' => TemplatesHelper::getDefaultCSSFiles(),
            'arJS' => TemplatesHelper::getDefaultJSFiles(),
            'iArticleId' => $this->iArticleId,
            'sUploadError' => $sUploadError
        ) );
    }
    public function picturePreview( $iPictureId )
    {
        $this->load->helper( 'form' );
        
        $arPicture = array();
        $iPictureId = ( int ) $iPictureId;
        
        $arPicture = $this->oPictures->getById( $iPictureId );
        
        if( ! sizeof( $arPicture ) )
        {
            show_404();
        }
        
        $this->oPictures->preview( $iPictureId, $this->iArticleId );

        $this->session->set_flashdata( 'alert', array(
            'class' => 'alert-success',
            'message' => 'Operación realizada con éxito'
        ) );

        redirect( '/admin/pictures?article_id=' . $this->iArticleId, 'refresh' );
    }
}

/* End of file pictures.php */
/* Location: ./application/controllers/admin/pictures.php */
