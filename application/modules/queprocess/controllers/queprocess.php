<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Queprocess extends MX_Controller {

    function __construct() {
        parent::__construct();
        $main_module = 'queprocess';

        $access_arr = array(
            'queprocess/index' => array('add', 'edit', 'delete', 'view'),
            'queprocess/subcategory' => 'no_restriction',
            'queprocess/token' => 'no_restriction',
            'queprocess/login' => 'no_restriction'
        );
        $this->load->model('masters/category_type_model');
        $this->load->model('token_model');
    }

    function index() {
        $data = array();
        $data['title'] = 'Queue_process-List of user details';
        $this->load->helper('cookie');
        if (get_cookie($this->config->item('autologin_cookie_name'), TRUE)) {
            $cookie_details = unserialize(get_cookie($this->config->item('autologin_cookie_name')));
            $user_id = $cookie_details['user_id'];
            $pwd = $cookie_details['key'];
            $data['category'] = $this->token_model->get_all_active_category($user_id);
            $this->load->view('queprocess/category', $data);
        } else {
            $this->load->view('queprocess/login', $data);
        }
    }

    public function subcategory($id) {
        $data = array();
        $data['title'] = 'Queue_process-List Subcategory details';
        $cookie_details = unserialize(get_cookie($this->config->item('autologin_cookie_name')));
        $user_id = $cookie_details['user_id'];
        $data['subcategory'] = $this->category_type_model->get_subcategory_based_on_id($id, $user_id);
        $data['counter_id'] = $this->token_model->get_counter_id($id);
        $this->load->view('queprocess/subcategory', $data);
    }

    public function token_generate($id) {
        $data = array();
        $data['title'] = 'Queue_process-Token';
        $data['category'] = $this->token_model->get_all_catagory($id);
        $data['counter_id'] = $this->token_model->get_counter_id($id);
        $this->load->view('queprocess/generate_token', $data);
    }

    public function token($cat_id) {
        $data = array();
        $token_details = $this->token_model->get_token_code($cat_id);

        $data['token_number'] = $token_details['token_number'];
        $data['counter_id'] = $token_details['counter_name'];
        $cookie_details = unserialize(get_cookie($this->config->item('autologin_cookie_name')));
        $user_id = $cookie_details['user_id'];
        $data['company_name'] = $this->token_model->get_company_name($user_id);
        $this->token_model->update_missed_for_noentry_tkns($token_details['counter_id']);
        $datas['category_id'] = $cat_id;
        $datas['counter_id'] = $token_details['counter_id'];
        $datas['token_number'] = $token_details['token_number'];
        $datas['emp_id'] = $token_details['emp_id'];
        $datas['created_date'] = date('Y-m-d H:i:s');
        $token_detailss = $this->token_model->insert_token_details($datas);

        if (!empty($token_details)) {
            $this->token_model->update_increment_code($cat_id);
        }

        echo json_encode($data);
    }

    function get_feedback() {
        $this->load->view('queprocess/feed_back');
    }

    function get_comments() {
        $input_post = array();
        $cookie_details = unserialize(get_cookie($this->config->item('autologin_cookie_name')));
        $user_id = $cookie_details['user_id'];
        $input_post = $this->input->post();
        $input_post['client_id'] = $user_id;
        $input_data = $this->token_model->insert_feedback($input_post);
        echo json_encode($input_data);
    }

    function login() {
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        if ($this->input->post()) {
            $client_id = $this->token_model->admin_login($username, $password);
        }
        if (isset($client_id) && $client_id != '') {
            $this->user_auth->create_autologin($client_id, $password);
            redirect($this->config->item('base_url') . 'queprocess');
        } else {
            $this->session->set_flashdata('flashError', 'Invalid User');
            redirect($this->config->item('base_url') . 'queprocess?login=fail');
        }
    }

}
