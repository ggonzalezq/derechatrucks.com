<?php
/*
 * @author ggonzalez
 * @26 October 2012
 */

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Articles extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper( 'Articles' );
        $this->load->helper( 'Categories' );
    }
    public function index()
    {
        $this->load->model( 'Article_model', 'oArticles' );
        $this->load->model( 'Category_model', 'oCategories' );
        $this->load->model( 'Picture_model', 'oPictures' );
        
        $arArticles = array();
        $arCategories = array();
        $arPicture = array();
        
        define( 'FRONTPAGE', '' );
       
        $arArticles = $this->oArticles->getAll( TRUE );
        
        foreach( $arArticles as $k => $v  )
        {
            $arArticles[$k] = ArticlesHelper::getArticleFormatted( $v );
            $arPicture = $this->oPictures->getByPicturePreview( $arArticles[$k]['article_id'] );
            
            if( sizeof( $arPicture ) )
            {
                $arArticles[$k] = array_merge( $arArticles[$k], $arPicture );
            }
        }
        
        $arCategories = $this->oCategories->getCategories();
        $arCategories = CategoriesHelper::getCategoriesTree( $arCategories );
        $arCategories = CategoriesHelper::getCategoriesLeveled( $arCategories );
        
        $this->load->view( 'public/articles/index', array(
            'arCategories' => $arCategories,
            'arArticles' => $arArticles,
            'sTitle' => 'Derecha Trucks'
        ) );
    }
    public function article( $sPermalink, $iArticleId )
    {
        $this->load->model( 'Category_model', 'oCategories' );
        $this->load->model( 'Article_model', 'oArticles' );
        $this->load->model( 'Picture_model', 'oPictures' );
        $this->load->helper( 'Articles' );
        $this->load->helper( 'form' );
        $this->load->library( 'form_validation' );
        
        $arArticle = array();
        $arCategories = array();
        $arPictures = array();
        $bSent = FALSE;
        $iArticleId = ( int ) $iArticleId;
        
        
        $arArticle = $this->oArticles->getById( TRUE, $iArticleId );
        
        if( ! sizeof( $arArticle ) )
        {
            show_404();
        }
       
        $arArticle = ArticlesHelper::getArticleFormatted( $arArticle );
        
        if( $sPermalink !== $arArticle['article_permalink'] )
        {
            show_404();
        }
        
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
            $this->email->subject( $this->input->post( 'subject' ) );
            $this->email->message( implode( "\n", array( 
                'Nombre:' . $this->input->post( 'name' ),
                'Telefono:' . $this->input->post( 'telephone' ),
                'Email:' . $this->input->post( 'email' ),
                'Asunto:' . $this->input->post( 'subject' ),
                'Comentarios:' . $this->input->post( 'comments' )
            ) ) );
            
            if( $this->email->send() )
            {
                $bSent = TRUE;
            }
        }
        
        
        $arPictures = $this->oPictures->getByArticleid( ( int ) $arArticle['article_id'] );
        
        $this->load->view( 'public/articles/article', array(
            'arArticle' => $arArticle,
            'arCategories' => $arCategories,
            'arPictures' => $arPictures,
            'bSent' => $bSent,
            'sTitle' => $arArticle['title']
        ) );
    }
}

/* End of file articles.php */
/* Location: ./application/controllers/articles.php */