<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$config['validation'][0]['field'] = 'username';
$config['validation'][0]['label'] = 'nombre de usuario';
$config['validation'][0]['rules'] = 'trim|xss_clean|required|min_length[5]|is_unique[users.username]';

$config['validation'][1]['field'] = 'group';
$config['validation'][1]['label'] = 'grupo';
$config['validation'][1]['rules'] = 'trim|xss_clean|required';

$config['validation'][2]['field'] = 'first_name';
$config['validation'][2]['label'] = 'nombre';
$config['validation'][2]['rules'] = 'trim|xss_clean|required';

$config['validation'][3]['field'] = 'last_name';
$config['validation'][3]['label'] = 'apellidos';
$config['validation'][3]['rules'] = 'trim|xss_clean|required';

$config['validation'][4]['field'] = 'email';
$config['validation'][4]['label'] = 'email';
$config['validation'][4]['rules'] = "trim|xss_clean|required|valid_email";

$config['validation'][5]['field'] = 'phone';
$config['validation'][5]['label'] = 'teléfono';
$config['validation'][5]['rules'] = "trim|xss_clean|required|valid_telephone";

$config['validation'][6]['field'] = 'password';
$config['validation'][6]['label'] = 'contraseña';
$config['validation'][6]['rules'] = "trim|xss_clean|required|min_length[8]|max_length[20]|matches[confirm_password]";

$config['validation'][7]['field'] = 'confirm_password';
$config['validation'][7]['label'] = 'confirmar contraseña';
$config['validation'][7]['rules'] = "trim|xss_clean|required";

/* End of file users.php */
/* Location: ./application/config/admin/users/user-new.php */
