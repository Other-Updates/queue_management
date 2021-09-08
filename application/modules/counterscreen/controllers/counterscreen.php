<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Counterscreen extends MX_Controller {

    function __construct() {
        parent::__construct();
        $main_module = 'counterscreen';
        $access_arr = array(
            'counterscreen/index' => array('add', 'edit', 'delete', 'view'),
            'counterscreen/index' => array('add', 'edit', 'delete', 'view'),
            'counterscreen/token' => 'no_restriction',
            'counterscreen/current_que_process' => 'no_restriction',
            'counterscreen/get_add_videos' => 'no_restriction',
            'counterscreen/login' => 'no_restriction'
        );


        $this->load->model('counterscreen_model');
        $this->load->model('dashboard/dashboard_model');
        $this->load->model('counterscreen/counterscreen_model');
        $this->load->model('queprocess/token_model');
    }

    function index() {
        $data = array();
        $data['title'] = 'Counter Screen-Current Queue Process ';
        $this->load->helper('cookie');
        if (get_cookie($this->config->item('autologin_cookie_name'), TRUE)) {
            $cookie_details = unserialize(get_cookie($this->config->item('autologin_cookie_name')));
            $user_id = $cookie_details['user_id'];
            $data['token'] = $this->counterscreen_model->get_all_tokens($user_id);
            $data['add_vidoes'] = $this->counterscreen_model->get_videos_data($user_id);
            $this->load->view('counterscreen', $data);
        } else {
            $this->load->view('counterscreen/login', $data);
        }
    }

    function current_que_process() {
        if (get_cookie($this->config->item('autologin_cookie_name'), TRUE)) {
            $cookie_details = unserialize(get_cookie($this->config->item('autologin_cookie_name')));
            $user_id = $cookie_details['user_id'];
            $result = $this->counterscreen_model->get_all_tokens($user_id);
            if ($result) {
                echo json_encode($result);
            } else {
                echo 0;
            }
        } else {
            $this->load->view('counterscreen/login', $data);
        }
    }

    function get_add_videos() {
        if (get_cookie($this->config->item('autologin_cookie_name'), TRUE)) {
            $cookie_details = unserialize(get_cookie($this->config->item('autologin_cookie_name')));
            $user_id = $cookie_details['user_id'];
            $result = $this->counterscreen_model->get_videos_data($user_id);
            if ($result) {
                echo json_encode($result);
            } else {
                echo 0;
            }
        } else {
            $this->load->view('counterscreen/login', $data);
        }
    }

    function update_voice_status($id) {

        $result = $this->counterscreen_model->update_voice_status($id);
        if ($result != '') {
            echo 1;
        } else {
            echo 0;
        }
    }

    function get_add_image_data() {
        if (get_cookie($this->config->item('autologin_cookie_name'), TRUE)) {
            $cookie_details = unserialize(get_cookie($this->config->item('autologin_cookie_name')));
            $user_id = $cookie_details['user_id'];
            $type = $this->input->post('type');
            $count = $this->input->post('count');
            $data = $this->dashboard_model->get_add_image_data($type, $count, $user_id);
            if ($data)
                echo json_encode($data);
            else
                echo 0;
        }else {
            $this->load->view('counterscreen/login', $data);
        }
    }

    function get_add_content_data() {
        if (get_cookie($this->config->item('autologin_cookie_name'), TRUE)) {
            $cookie_details = unserialize(get_cookie($this->config->item('autologin_cookie_name')));
            $user_id = $cookie_details['user_id'];
            $type = $this->input->post('type');
            $count = $this->input->post('count');
            $data = $this->dashboard_model->get_add_conetnt_data($type, $count, $user_id);
            if ($data)
                echo json_encode($data);
            else
                echo 0;
        }
        else {
            $this->load->view('counterscreen/login', $data);
        }
    }

    function login() {
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        if ($this->input->post()) {
            $client_id = $this->token_model->admin_login($username, $password);
        }
        if (isset($client_id) && $client_id != '') {
            $this->user_auth->create_autologin($client_id, $password);
            redirect($this->config->item('base_url') . 'counterscreen');
        } else {
            $this->session->set_flashdata('flashError', 'Invalid User');
            redirect($this->config->item('base_url') . 'counterscreen?login=fail');
        }
    }

}
