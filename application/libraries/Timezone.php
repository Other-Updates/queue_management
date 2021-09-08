<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Timezone {

    private $error = array();
    function __construct() {
	$this->ci = & get_instance();
	$this->ci->load->library('user_auth');        
    }
    
    function timezone() {
        $timezone = $this->ci->user_auth->get_timezone();
        $timezone = !empty($timezone)?$timezone:'Asia/kolkata';
        return $timezone;
    }    
}