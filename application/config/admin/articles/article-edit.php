<?php

/*
 * @author  ggonzalez
 * @date    17 March 2013
 */

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$config['validation'][0]['field'] = 'article_year';
$config['validation'][0]['label'] = 'año';
$config['validation'][0]['rules'] = 'trim|xss_clean|required|greater_than[1899]|less_than[' . ( ( ( int ) date( 'Y' ) ) + ( 2 ) ) . ']';

$config['validation'][1]['field'] = 'article_sleeper';
$config['validation'][1]['label'] = 'camarote';
$config['validation'][1]['rules'] = 'trim|xss_clean';

$config['validation'][2]['field'] = 'article_capacity';
$config['validation'][2]['label'] = 'capacidad';
$config['validation'][2]['rules'] = 'trim|xss_clean';

$config['validation'][3]['field'] = 'category_id';
$config['validation'][3]['label'] = 'categoria';
$config['validation'][3]['rules'] = 'trim|xss_clean|required';

$config['validation'][5]['field'] = 'article_color';
$config['validation'][5]['label'] = 'color';
$config['validation'][5]['rules'] = 'trim|xss_clean|required';

$config['validation'][6]['field'] = 'article_comments';
$config['validation'][6]['label'] = 'comentarios';
$config['validation'][6]['rules'] = 'trim|xss_clean';

$config['validation'][7]['field'] = 'article_differential';
$config['validation'][7]['label'] = 'diferencial';
$config['validation'][7]['rules'] = 'trim|xss_clean';

$config['validation'][8]['field'] = 'article_brakes';
$config['validation'][8]['label'] = 'frenos';
$config['validation'][8]['rules'] = 'trim|xss_clean|required';

$config['validation'][9]['field'] = 'article_brand';
$config['validation'][9]['label'] = 'marca';
$config['validation'][9]['rules'] = 'trim|xss_clean|required';

$config['validation'][10]['field'] = 'article_model';
$config['validation'][10]['label'] = 'modelo';
$config['validation'][10]['rules'] = 'trim|xss_clean|required';

$config['validation'][11]['field'] = 'article_engine';
$config['validation'][11]['label'] = 'motor';
$config['validation'][11]['rules'] = 'trim|xss_clean';

$config['validation'][12]['field'] = 'article_price';
$config['validation'][12]['label'] = 'precio';
$config['validation'][12]['rules'] = 'trim|xss_clean|required|greater_than[0]|numeric';

$config['validation'][13]['field'] = 'article_currency';
$config['validation'][13]['label'] = 'tipo de moneda';
$config['validation'][13]['rules'] = 'trim|xss_clean|required';

$config['validation'][14]['field'] = 'article_wheels';
$config['validation'][14]['label'] = 'rines';
$config['validation'][14]['rules'] = 'trim|xss_clean';

$config['validation'][15]['field'] = 'article_tires';
$config['validation'][15]['label'] = 'rodado';
$config['validation'][15]['rules'] = 'trim|xss_clean';

$config['validation'][16]['field'] = 'article_status';
$config['validation'][16]['label'] = 'status';
$config['validation'][16]['rules'] = 'trim|xss_clean|required';

$config['validation'][18]['field'] = 'article_ubication';
$config['validation'][18]['label'] = 'ubicación';
$config['validation'][18]['rules'] = 'trim|xss_clean';

$config['validation'][19]['field'] = 'article_suspension';
$config['validation'][19]['label'] = 'suspensión';
$config['validation'][19]['rules'] = 'trim|xss_clean|required';

$config['validation'][20]['field'] = 'article_transmission';
$config['validation'][20]['label'] = 'transmisión';
$config['validation'][20]['rules'] = 'trim|xss_clean';


/* End of file article-edit.php */
/* Location: ./application/config/admin/articles/article-edit */
