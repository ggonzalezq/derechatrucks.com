<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * @author  ggonzalez
 * @date    1 March 2013
 */
class MY_Form_validation extends CI_Form_validation
{
    /*
     * Validate telephones
     * We are using this format (111) 111-1111
     * @param   string  $sTelephone
     * @return  bool    
     */
    public function valid_telephone( $sTelephone )
    {
        return ( ! preg_match( "/^\([0-9]{3}\) [0-9]{3}-[0-9]{4}$/", $sTelephone ) ) ? FALSE : TRUE;
    }
    /*
     * Override the generated error message
     * @param   string  $sKey
     * @param   string  $sValue
     * @return  void
     */
    public function set_error( $sKey, $sValue )
    {
        if( isset( $this->_field_data[$sKey] ) )
        {
            $this->_field_data[$sKey]['error'] = $sValue;
        }
    }
    
}

/* End of file MY_Form_validation.php */
/* Location: ./application/libraries/MY_Form_validation.php */
