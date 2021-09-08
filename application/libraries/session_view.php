<?php 
if ( ! defined('BASEPATH')) 
    exit('No direct script access allowed');

class Session_view {
    
    function __construct()
    {
        $this->ci =& get_instance();
        $this->ci->load->library('session');
        $this->ci->load->library('user_auth');
    }
	
    function clear_session($class = NULL, $method = NULL)
    {
        $class = (isset($class)) ? $class : $this->ci->router->class;
        $method = (isset($method)) ? $method : $this->ci->router->method;

        $filters = $this->ci->user_auth->get_from_session("filters");
        if(isset($filters[$class]))
        {
            $get_session = $filters[$class];
            if(isset($get_session[$method]))
            {
                $filter_arr = $filters;
                $filter_arr["filters"][$class][$method] = "";
                $this->ci->user_auth->store_in_session($filter_arr);
            }
        }
    }
	
    function add_session($class = NULL, $method = NULL, $data)
    {
        $class = (isset($class)) ? $class : $this->ci->router->class;
        $method = (isset($method)) ? $method : $this->ci->router->method;
        $old_data = $this->ci->user_auth->get_from_session("filters");
        
        if(isset($old_data[$class]) && !empty($old_data[$class]))
            $old_data[$class][$method]= $data;
        else
            $old_data[$class] = array($method => $data);
        
        $filter_arr["filters"] =  $old_data;
        $this->ci->user_auth->store_in_session($filter_arr);		
    }
	
    function get_session($class = NULL, $method = NULL)
    {		
        $class = (isset($class)) ? $class : $this->ci->router->class;
        $method = (isset($method)) ? $method : $this->ci->router->method;

        $filters = $this->ci->user_auth->get_from_session("filters");		
        if(isset($filters[$class]))
        {
            $session_data = $filters;
            $get_session = $session_data[$class];
            if(isset($get_session[$method]))
                return $get_session[$method];
        }
    }	
}