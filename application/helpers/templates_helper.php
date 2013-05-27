<?php
/*
 * @author ggonzalez
 * @24 February 2013
 */

if ( ! defined('BASEPATH')) exit( 'No direct script access allowed' );

class TemplatesHelper
{
    /*
     * Return an array with all the default CSS files included in the admin
     * @return      array
     */
    public static function getDefaultCSSFiles()
    {
        return array(
            'bootstrap.min',
            'bootstrap-responsive.min',
            'colorpicker',
            'datepicker',
            'uniform',
            'chosen',
            'unicorn.main',
            'unicorn.grey',
            'global'
        );
    }
    /*
     * Return an array with all the default CSS files included in the admin
     * @return      array
     */
    public static function getDefaultJSFiles()
    {
        return array(
            'jquery.min',
            'jquery.ui.custom',
            'jquery.gritter.min',
            'jquery.peity.min',
            'jquery.uniform',
            'jquery.chosen',
            'bootstrap.min',
            'bootstrap-colorpicker',
            'bootstrap-datepicker',
            'unicorn',
            'unicorn.form_common',
            'global'
        );
    }
}

/* End of file templates_helper.php */
/* Location: ./application/helpers/templates_helper.php */