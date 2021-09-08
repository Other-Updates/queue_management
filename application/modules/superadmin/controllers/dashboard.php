<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Dashboard extends MX_Controller {

    function __construct() {
        parent::__construct();
        $main_module = 'dashboard';
        $access_arr = array(
            'dashboard/index' => array('view')
        );
        $this->load->model('users/users_model');
        $this->load->model('superadmin/dashboard_model');
        $this->template->write_view('session_msg', 'users/session_msg');
        $this->template->set_master_template('../../themes/queue/superadmin_template.php');
    }

    function index() {

        $data = array();
        $data['title'] = 'Dashboard';
        $data['clients'] = $this->dashboard_model->get_total_clients();
        $data['recent_clients'] = $this->dashboard_model->get_all_clients();
        $this->template->write_view('content', 'superadmin/dashboard', $data);
        $this->template->render();
    }

}
