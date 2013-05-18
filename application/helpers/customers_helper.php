<?php
/*
 * @author ggonzalez
 * @17 February 2013
 */

if ( ! defined('BASEPATH')) exit( 'No direct script access allowed' );

class CustomersHelper
{
    /*
     * Return an array with all the media
     * @return      array
     */
    public static function getCustomerMedia()
    {
        return array(
            1 => 'Teléfono',
            'Radio',
            'Email',
            'Piso',
            'Website'
        );
    }
}

/* End of file customers_helper.php */
/* Location: ./application/helpers/customers_helper.php */