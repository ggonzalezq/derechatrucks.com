<?php

/*
 * @author  ggonzalez
 * @date    17 March 2013
 */

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$config['validation'][0]['field'] = 'picture_alt';
$config['validation'][0]['label'] = 'texto alternativo';
$config['validation'][0]['rules'] = 'trim|xss_clean';

$config['validation'][1]['field'] = 'picture_title';
$config['validation'][1]['label'] = 'título';
$config['validation'][1]['rules'] = 'trim|xss_clean';

$config['upload']['upload_path'] = BASEPATH . '../uploads/articles/';
$config['upload']['allowed_types'] = 'gif|jpg|jpeg|png';
$config['upload']['overwrite'] = FALSE;
$config['upload']['remove_spaces'] = TRUE;

$config['image_manipulation'][0]['width'] = 150;
$config['image_manipulation'][0]['height'] = 150;
$config['image_manipulation'][0]['new_image'] = '/thumbnail';

$config['image_manipulation'][1]['width'] = 400;
$config['image_manipulation'][1]['height'] = 300;
$config['image_manipulation'][1]['new_image'] = '/small';

$config['image_manipulation'][2]['width'] = 600;
$config['image_manipulation'][2]['height'] = 450;
$config['image_manipulation'][2]['new_image'] = '/medium';

$config['image_manipulation'][3]['width'] = 800;
$config['image_manipulation'][3]['height'] = 600;
$config['image_manipulation'][3]['new_image'] = '/large';





/* End of file article-new.php */
/* Location: ./application/config/admin/articles/article-new */
