<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$config['validation'][0]['field'] = 'identity';
$config['validation'][0]['label'] = 'nombre de usuario';
$config['validation'][0]['rules'] = 'trim|xss_clean|required';

$config['validation'][1]['field'] = 'password';
$config['validation'][1]['label'] = 'contraseña';
$config['validation'][1]['rules'] = 'trim|xss_clean|required';

/* End of file users.php */
/* Location: ./application/config/admin/users/user-login.php */
