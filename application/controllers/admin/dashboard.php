<?php
/*
 * @author  ggonzalez
 * @date    12 March 2013
 */

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    public function __construct()
    {   
        parent::__construct();
        $this->load->library( 'ion_auth' );
        
        if( ! $this->ion_auth->logged_in() )
        {
            redirect('admin/login', 'refresh');
        }
        else
        {
            redirect('admin/articles', 'refresh');
        }
    }
}

/* End of file dashboard.php */
/* Location: ./application/controllers/admin/dashboard.php */
