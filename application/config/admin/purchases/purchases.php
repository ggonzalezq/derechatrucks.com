<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$config['validation'][0]['field'] = 'customer_id';
$config['validation'][0]['label'] = 'cliente';
$config['validation'][0]['rules'] = 'trim|required';

$config['validation'][1]['field'] = 'purchase_brand';
$config['validation'][1]['label'] = 'marca';
$config['validation'][1]['rules'] = 'trim|required';

$config['validation'][2]['field'] = 'purchase_model';
$config['validation'][2]['label'] = 'modelo';
$config['validation'][2]['rules'] = 'trim|required';

$config['validation'][3]['field'] = 'purchase_year';
$config['validation'][3]['label'] = 'año';
$config['validation'][3]['rules'] = 'trim|required|greater_than[1984]|less_than[' . ( ( ( int ) date( 'Y' ) ) + ( 2 ) ) . ']';

$config['validation'][4]['field'] = 'article_id';
$config['validation'][4]['label'] = 'articulo';
$config['validation'][4]['rules'] = 'trim|required';

$config['validation'][5]['field'] = 'purchase_status';
$config['validation'][5]['label'] = 'status';
$config['validation'][5]['rules'] = 'trim|required';

/* End of file purchases.php */
/* Location: ./application/config/admin/purchases/purchases.php */