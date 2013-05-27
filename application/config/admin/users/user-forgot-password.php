<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$config['validation'][0]['field'] = 'identity';
$config['validation'][0]['label'] = 'email';
$config['validation'][0]['rules'] = 'trim|xss_clean|required|valid_email';

/* End of file users.php */
/* Location: ./application/config/admin/users/user-forgot-password.php */
