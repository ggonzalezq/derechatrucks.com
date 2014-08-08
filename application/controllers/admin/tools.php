<?php
/*
 * @author  ggonzalez
 * @date    7 August 2014
 */

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tools extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper( 'Templates' );
        $this->load->library( 'ion_auth' );
        $this->load->library( 'session' );
        $this->lang->load( 'auth' );
        define( 'TOOLS', '' );
    }
    public function backupDatabase()
    {
        if( ! $this->ion_auth->is_admin() )
        {
            show_404();
        }

        $this->load->dbutil();
        $this->load->helper( 'download' );
        
        define( 'BACKUP_DATABASE', '' );
        
        $sDatabase = '';
        $sFilename = '';
        
        $sDatabase =& $this->dbutil->backup();
        $sFilename = 'derechatrucks-' . date( 'j-n-Y-G-i-s' ) . '.sql.gz';
        
        force_download( $sFilename, $sDatabase ); 
    }
}

/* End of file tools.php */
/* Location: ./application/controllers/admin/tools.php */