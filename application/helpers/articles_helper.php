<?php
/*
 * @author ggonzalez
 * @29 October 2012
 */

if ( ! defined('BASEPATH')) exit( 'No direct script access allowed' );


class ArticlesHelper
{
    public static function getArticleFormatted( $arArticle = array() )
    {
        if( ( ! is_array( $arArticle ) ) ||
            ( ! sizeof( $arArticle ) ) )
        {
            return FALSE;
        }
        
        $arBrakes = array();
        $arCurrencies = array();
        $arStatus = array();
        $arSuspension = array();
        $sCurrency = '';
        $sPrice = '';
        
        $arBrakes = ArticlesHelper::getBrakes();
        $arCurrencies = ArticlesHelper::getCurrencies();
        $arStatus = ArticlesHelper::getArticleStatus();
        $arSuspension = ArticlesHelper::getSuspension();
        
        $sPrice .= '$';
        $sPrice .= number_format( $arArticle['article_price'] );
        $sPrice .= ' ';
        $sPrice .= $arCurrencies[$arArticle['article_currency']];
        
        
        $arArticle['title'] = ArticlesHelper::getArticlePreparedTitle(
                NULL,
                $arArticle['article_brand'],
                $arArticle['article_model'],
                $arArticle['article_year'],
                NULL
        );
        
        //article_sleeper
        if( $arArticle['article_sleeper'] === '0' )
        {
            $arArticle['article_sleeper'] = 'Si';
        }
        else
        {
            $arArticle['article_sleeper'] = 'No';
        }
        
        //article_brakes
        $arArticle['article_brakes'] = $arBrakes[$arArticle['article_brakes']];
        
        //article_price
        $arArticle['article_price'] = $sPrice;
        
        //article_status
        $arArticle['article_status'] = $arStatus[$arArticle['article_status']];
        //article_suspension
        $arArticle['article_suspension'] = $arSuspension[$arArticle['article_suspension']];
        
        //article_video
        if( $arArticle['article_video'] !== '')
        {
            $arArticle['youtube_id'] = UtilsHelper::getYouTubeId( $arArticle['article_video'] );
        }
        
        return $arArticle;
        
    }
    /*
     * Return the title of the article prepared
     * @param       string      $sSKU
     * @param       string      $sBrand
     * @param       string      $sModel
     * @param       int         $iYear
     * @param       string      $sPrice
     * @return      string
     */
    public static function getArticlePreparedTitle( $sSKU = NULL, $sBrand = NULL, $sModel = NULL, $iYear = NULL, $sPrice = NULL )
    {   
        return implode( ' ', array( $sSKU, $sBrand, $sModel, $iYear, $sPrice ) );
    }
    /*
     * Return all the available currencies
     * @return  array
     */
    public static function getCurrencies()
    {
        return array(
            1 => 'MXN',
            2 => 'USD'
        );
    }
    /*
     * Return an array with all the available status of the article
     * @return  array
     */
    public static function getArticleStatus()
    {
        return array(
            1 => 'Disponible',
            2 => 'No disponible',
            3 => 'Proceso de venta'
        );
    }
    /*
     * Return an array with all the available brake types
     * @return  array
     */
    public static function getBrakes()
    {
        return array(
            1 => 'Aire',
            3 => 'Hidráulico',
            2 => 'Motor'
        );
    }
    /*
     * Return all the available stores
     * @return  array
     */
    public static function getStores()
    {
        return array(
            1 => 'Hermosillo',
            2 => 'Guadalajara'
        );
    }
    /*
     * Return all the available suspension types
     * @return  array
     */
    public static function getSuspension()
    {
        return array(
            1 => 'Aire',
            2 => 'Hendrickson',
            3 => 'Muelles'
        );
    }
    /**
     * Generate a dynamic sku for the articles
     * @param   string  $sCategory
     * @param   int     $iArticleId
     * @return  mixed   boolean / string
     */
    public static function getStockKeepingUnit( $sCategory = NULL, $iArticleId = NULL )
    {
        if( ( $sCategory === NULL ) ||
            ( $iArticleId === NULL ) )
        {
            return FALSE;
        }
        
        $arCategoryWords = array();
        $arReturn = array();
        $sCategoryInitials = '';
        
        $arReturn[] = 'DT';
        
        $sCategory = strtoupper( $sCategory );
        $arCategoryWords = explode( ' ', $sCategory );
        
        foreach( $arCategoryWords as $k => $v )
        {
            $sCategoryInitials .= substr( $v, 0, 1 );
        }
        
        $arReturn[] = $sCategoryInitials;
        $arReturn[] = ( int ) $iArticleId + 400;
        
        return implode( '-', $arReturn );
        
    }
}

/* End of file articles_helper.php */
/* Location: ./application/helpers/articles_helper.php */