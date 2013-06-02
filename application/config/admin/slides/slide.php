<?php

/*
 * @author  ggonzalez
 * @date    1 June 2013
 */

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$i = 0;
$config['validation'][$i]['field'] = 'slide_title';
$config['validation'][$i]['label'] = 'título';
$config['validation'][$i]['rules'] = 'trim|xss_clean';

$i++;
$config['validation'][$i]['field'] = 'slide_anchor';
$config['validation'][$i]['label'] = 'link';
$config['validation'][$i]['rules'] = 'trim|xss_clean|valid_url';

$i++;
$config['validation'][$i]['field'] = 'slide_badge';
$config['validation'][$i]['label'] = 'badge oferta';
$config['validation'][$i]['rules'] = 'trim|xss_clean';

$config['upload']['upload_path'] = BASEPATH . '../uploads/slides';
$config['upload']['allowed_types'] = 'gif|jpg|jpeg|png';
$config['upload']['overwrite'] = FALSE;
$config['upload']['remove_spaces'] = TRUE;

$config['image_manipulation']['width'] = 100;
$config['image_manipulation']['height'] = 100;

/* End of file slide.php */
/* Location: ./application/config/admin/articles/slide.php */
