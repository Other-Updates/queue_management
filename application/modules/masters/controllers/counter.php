<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Counter extends MX_Controller {

    function __construct() {
        parent::__construct();
        if ($this->user_auth->is_logged_in()) {
            $user_details = $this->user_auth->get_all_session();
            if ($user_details['is_backend_user'] == 0) {
                redirect($this->config->item('base_url') . 'counter/employee/' . $user_details['user_id']);
            }
        }
        if (!$this->user_auth->is_logged_in()) {
            redirect($this->config->item('base_url') . 'users/login');
        }
        $main_module = 'masters';
        $access_arr = array(
            'counter/index' => array('add', 'edit', 'delete', 'view'),
            'counter/add' => array('add'),
            'counter/edit' => array('edit'),
            'counter/delete' => array('delete'),
            'counter/is_counter_name_available' => array('add', 'edit')
        );

        $this->load->model('masters/counter_model');
        $this->template->write_view('session_msg', 'users/session_msg');
        date_default_timezone_set($this->timezone->timezone());
    }

    function index() {
        $data = array();
        $data['title'] = 'Masters - Manage Counter';
        $client_id = $this->user_auth->get_user_id();
        $data['counter'] = $this->counter_model->get_all_counters($client_id);
        $this->template->write_view('content', 'masters/counter', $data);
        $this->template->render();
    }

    function add() {
        $data = array();
        $data['title'] = 'Masters - Add New Counter';
        $client_id = $this->user_auth->get_user_id();
        if ($this->input->post('counter', TRUE)) {
            $counter = $this->input->post('counter');
            $counter['created_date'] = date('Y-m-d H:i:s');
            $counter['client_id'] = $client_id;

            $insert = $this->counter_model->insert_counter($counter);

            $this->session->set_flashdata('flashSuccess', 'New Counter successfully added!');
            redirect($this->config->item('base_url') . 'masters/counter');
        }
        $this->template->write_view('content', 'masters/add_counter', $data);
        $this->template->render();
    }

    function edit($id) {
        $data = array();
        $data['title'] = 'Masters - Edit Counter';
        $client_id = $this->user_auth->get_user_id();
        if ($this->input->post('counter', TRUE)) {
            $counter = $this->input->post('counter');
            $counter['client_id'] = $client_id;
            if (!isset($counter['success_end_point']))
                $counter['success_end_point'] = 0;

            $update = $this->counter_model->update_counter($counter, $id);
            $this->session->set_flashdata('flashSuccess', 'Counter successfully updated!');
            redirect($this->config->item('base_url') . 'masters/counter');
        }
        $data['counter'] = $this->counter_model->get_counter_by_id($id);

        $this->template->write_view('content', 'masters/edit_counter', $data);
        $this->template->render();
    }

    function delete($id) {
        $id = $this->input->post('id');
        $data = array('is_deleted' => 1);
        $delete = $this->counter_model->delete_counter($id, $data);

        if ($delete == 1) {
            $this->session->set_flashdata('flashSuccess', 'Counter successfully deleted!');
            echo '1';
        } else {
            $this->session->set_flashdata('flashError', 'Operation Failed!');
            echo '0';
        }
    }

    function is_counter_name_available() {
        $client_id = $this->user_auth->get_user_id();
        $counter_name = $this->input->post('counter_name');
        $id = $this->input->post('id');
        $result = $this->counter_model->is_counter_name_available($counter_name, $client_id);
        if (!empty($result[0]['id'])) {
            echo 'yes';
        } else {
            echo 'no';
        }
    }

}
