<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Emp_counter extends MX_Controller {

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
        $main_module = 'employee_management';
        $access_arr = array(
            'emp_counter/index' => array('add', 'edit', 'delete', 'view'),
            'emp_counter/add' => array('add'),
            'emp_counter/edit' => array('edit'),
            'emp_counter/delete' => array('delete'),
            'emp_counter/is_counter_name_available' => array('add', 'edit')
        );

//        if (!$this->user_auth->is_permission_allowed($access_arr, $main_module)) {
//            redirect($this->config->item('base_url'));
//        }

        $this->load->model('employee_management/emp_counter_model');
        $this->load->model('masters/counter_model');
        $this->load->model('employee_management/employee_model');
        $this->load->model('emp_counter_model');
        $this->template->write_view('session_msg', 'users/session_msg');
        date_default_timezone_set($this->timezone->timezone());
    }

    function index() {
        $data = array();
        $data['title'] = 'Masters - Manage Counter';
        $client_id = $this->user_auth->get_user_id();
        $data['counter'] = $this->emp_counter_model->get_all_assigned_counters($client_id);
        $this->template->write_view('content', 'employee_management/emp_counter_list', $data);
        $this->template->render();
    }

    function add() {
        $data = array();
        $data['title'] = 'Masters - Add New Counter';
        $client_id = $this->user_auth->get_user_id();
        if ($this->input->post('emp_counter', TRUE)) {
            $emp_counter = $this->input->post('emp_counter');
            $emp_counter['created_date'] = date('Y-m-d H:i:s');
            if ($emp_counter['counter_id'] == 'hold' || $emp_counter['counter_id'] == 'idle') {
                $emp_counter['emp_status'] = 0;
            } else {
                $emp_counter['emp_status'] = 1;
            }

            $insert = $this->emp_counter_model->insert_emp_counter($emp_counter);
            $this->session->set_flashdata('flashSuccess', ' Counter Assigned successfully !');
            redirect($this->config->item('base_url') . 'employee_management/emp_counter');
        }
        $data['counter'] = $this->emp_counter_model->get_all_active_counters($client_id);
        $data['emp'] = $this->emp_counter_model->get_all_employee($client_id);
        $this->template->write_view('content', 'employee_management/add_emp_counter', $data);
        $this->template->render();
    }

    function edit($id) {

        $data = array();
        $data['title'] = 'Masters - Edit Counter';
        $client_id = $this->user_auth->get_user_id();
        if ($this->input->post('emp_counter', TRUE)) {
            $emp_counter = $this->input->post('emp_counter');
            if ($emp_counter['counter_id'] == 'hold' || $emp_counter['counter_id'] == 'idle') {
                $emp_counter['emp_status'] = 0;
            } else {
                $emp_counter['emp_status'] = 1;
            }

            $update = $this->emp_counter_model->update_emp_counter($emp_counter, $id);
            if (!empty($update)) {
                $this->session->set_flashdata('flashSuccess', 'Assigned Counter successfully updated!');
                redirect($this->config->item('base_url') . 'employee_management/emp_counter');
            }
        }
        $data['emp_counter'] = $this->emp_counter_model->get_counter_by_id($id);
//        $data['counter'] = $this->counter_model->get_all_edit_counters_for_employee($id, $client_id);
        $data['counter'] = $this->emp_counter_model->get_all_active_counters($client_id);
        $data['emp'] = $this->employee_model->get_all_employee($client_id);
        $this->template->write_view('content', 'employee_management/edit_emp_counter', $data);
        $this->template->render();
    }

    function delete($id) {
        $id = $this->input->post('id');
        $data = array('is_deleted' => 1);
        $delete = $this->emp_counter_model->delete_counter($id);

        if ($delete == 1) {
            $this->session->set_flashdata('flashSuccess', ' Assigned Counter successfully deleted!');
            echo '1';
        } else {
            $this->session->set_flashdata('flashError', 'Operation Failed!');
            echo '0';
        }
    }

    function is_counter_name_available() {
        $counter_id = $this->input->post('counter_id');
        $id = $this->input->post('id');
        $result = $this->emp_counter_model->is_counter_name_available($counter_id);
        echo json_encode($result);
    }

}
