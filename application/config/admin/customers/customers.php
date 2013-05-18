<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$config['validation'][0]['field'] = 'customer_name';
$config['validation'][0]['label'] = 'nombre';
$config['validation'][0]['rules'] = 'trim|required|is_unique[customers.customer_name]';

$config['validation'][1]['field'] = 'customer_address';
$config['validation'][1]['label'] = 'dirección';
$config['validation'][1]['rules'] = 'trim';

$config['validation'][2]['field'] = 'customer_telephone';
$config['validation'][2]['label'] = 'teléfono';
$config['validation'][2]['rules'] = "trim|valid_telephone|is_unique[customers.customer_telephone]";

$config['validation'][3]['field'] = 'customer_mobile';
$config['validation'][3]['label'] = 'celular';
$config['validation'][3]['rules'] = 'trim|valid_telephone|is_unique[customers.customer_mobile]';

$config['validation'][4]['field'] = 'customer_nextel';
$config['validation'][4]['label'] = 'nextel';
$config['validation'][4]['rules'] = 'trim|is_unique[customers.customer_nextel]';

$config['validation'][5]['field'] = 'customer_email';
$config['validation'][5]['label'] = 'email';
$config['validation'][5]['rules'] = 'trim|valid_email|is_unique[customers.customer_email]';

$config['validation'][6]['field'] = 'state_id';
$config['validation'][6]['label'] = 'estado';
$config['validation'][6]['rules'] = 'trim';

$config['validation'][7]['field'] = 'city_id';
$config['validation'][7]['label'] = 'ciudad';
$config['validation'][7]['rules'] = 'trim';

$config['validation'][8]['field'] = 'customer_media';
$config['validation'][8]['label'] = 'medio de comunicación';
$config['validation'][8]['rules'] = 'trim|required';

$config['validation'][9]['field'] = 'customer_comments';
$config['validation'][9]['label'] = 'comentarios';
$config['validation'][9]['rules'] = 'trim';

$config['validation'][1]['field'] = 'customer_company';
$config['validation'][1]['label'] = 'empresa';
$config['validation'][1]['rules'] = 'trim';


/* End of file customers.php */
/* Location: ./application/config/admin/customers/customers.php */
