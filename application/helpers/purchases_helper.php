<?php
/*
 * @author ggonzalez
 * @24 February 2013
 */

if ( ! defined('BASEPATH')) exit( 'No direct script access allowed' );


class PurchasesHelper
{
    /*
     * Return an array with all the available status of the article
     * @return      array
     */
    public static function getPurchaseArticleStatus()
    {
        return array_reverse( array(
            'No disponible',
            'Disponible'
        ), TRUE );
    }
    /*
     * Return an array with all the available status of the purchase
     * @return      array
     */
    public static function getPurchaseStatus()
    {
        return array(
            1 => 'En proceso',
            'Interesado',
            'Vendido'
        );
    }
    /*
     * Return an array with all the available status of the purchase prepared for use in a dropdown
     * @return      array       $arPurchaseStatus
     */
    public static function getPurchaseStatusDropdown()
    {
        $arPurchaseStatus = array();
        $arPurchaseStatus = PurchasesHelper::getPurchaseStatus();
        $arPurchaseStatus[''] = 'Seleccione';
        ksort( $arPurchaseStatus );
        return $arPurchaseStatus;
    }
    
}

/* End of file purchases_helper.php */
/* Location: ./application/helpers/purchases_helper.php */