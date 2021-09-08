<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Dashboard extends MX_Controller {

    function __construct() {

        parent::__construct();
        if ($this->user_auth->is_logged_in()) {
            $user_details = $this->user_auth->get_all_session();
            if ($user_details['is_backend_user'] == 0) {
                redirect($this->config->item('base_url') . 'counter/employee/' . $user_details['user_id']);
            }
        }

        if (!in_array($this->router->method, array('login', 'logout'))) {
            if (!$this->user_auth->is_logged_in()) {
                redirect($this->config->item('base_url') . 'users/login');
            }
        }

        $this->load->model('counterscreen/counterscreen_model');
        $this->load->model('dashboard/dashboard_model');
        $this->template->write_view('session_msg', 'users/session_msg');

        date_default_timezone_set($this->timezone->timezone());
    }

    function index() {

        $data = array();
        $data['title'] = 'Counter Screen-Current Queue Process ';
        $client_id = $this->user_auth->get_user_id();
        $data['token'] = $this->dashboard_model->get_all_tokens($client_id);
        $data['total_token'] = $this->dashboard_model->get_count_of_total_token($client_id);
        $data['missed_token'] = $this->dashboard_model->get_count_of_token_status($data['value'] = 'Missed');
        $data['success_token'] = $this->dashboard_model->get_count_of_token_status($data['value'] = 'success');
        $data['hold_token'] = $this->dashboard_model->get_count_of_token_status($data['value'] = 'Hold');
        if ($data['token']['emp_status_data']) {
            $data["emp_data"] = json_encode($data['token']['emp_status_data']);
        } else {
            $data["emp_data"] = [];
        }
        $this->template->write_view('content', 'dashboard/index', $data);
        $this->template->render();
    }

    function get_add_image_data() {
        $client_id = $this->user_auth->get_user_id();
        $type = $this->input->post('type');
        $count = $this->input->post('count');
        $data = $this->dashboard_model->get_add_image_data($type, $count, $client_id);

        if ($data)
            echo json_encode($data);
        else
            echo 0;
    }

    function get_add_content_data() {
        $client_id = $this->user_auth->get_user_id();
        $type = $this->input->post('type');
        $count = $this->input->post('count');
        $data = $this->dashboard_model->get_add_conetnt_data($type, $count, $client_id);
        if ($data)
            echo json_encode($data);
        else
            echo 0;
    }

}
