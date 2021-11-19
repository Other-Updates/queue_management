<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Employee extends MX_Controller
{

    function __construct()
    {
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
        $main_module = 'employee_management';
        $access_arr = array(
            'employee/index' => array('add', 'edit', 'delete', 'view'),
            'employee/add' => array('add'),
            'employee/edit' => array('edit'),
            'employee/delete' => array('delete'),
            'employee/is_user_name_available' => 'no_restriction',
            'employee/my_profile' => 'no_restriction',
            'employee/is_email_address_available' => 'no_restriction',
            'employee/is_mobile_number_available' => 'no_restriction',
        );

        if (!$this->user_auth->is_permission_allowed($access_arr, $main_module)) {
            redirect($this->config->item('base_url'));
        }
        $this->load->model('employee_management/employee_model');
        $this->load->model('employee_management/emp_increment_model');
    }

    function index()
    {
        $data = array();
        $data['title'] = 'Members- Manage Members';
        $client_id = $this->user_auth->get_user_id();
        $data['employee'] = $this->employee_model->get_all_employee($client_id);
        $this->template->write_view('content', 'employee_management/index', $data);
        $this->template->render();
    }

    function add()
    {
        $data = array();
        $data['title'] = 'Employee - Add New Employee';
        $client_id = $this->user_auth->get_user_id();
        if ($this->input->post('employee')) {
            $employee = $this->input->post('employee');
            $employee['client_id'] = $client_id;
            $employee['emp_id'] = $this->employee_model->get_increment_code_based_client($client_id);
            $insert_id = $this->employee_model->insert_employee($employee);
            if (!empty($insert_id)) {
                $this->session->set_flashdata('flashSuccess', 'New Employee successfully added!');
                redirect($this->config->item('base_url') . 'employee_management/employee');
            }
        }
        $data['emp_id'] = $this->employee_model->get_increment_code_based_client($client_id);
        $this->template->write_view('content', 'employee_management/add_employee', $data);
        $this->template->render();
    }

    function edit($id)
    {
        $data = array();
        $data['title'] = 'Employee - Edit Employee';
        if ($this->input->post('employee')) {
            $employee = $this->input->post('employee');
            if (empty($employee['password']) || trim($employee['password']) == '')
                unset($employee['password']);
            $employee['updated_date'] = date('Y-m-d H:i:s');
            $update = $this->employee_model->update_employee($employee, $id);
            if (!empty($update)) {
                $this->session->set_flashdata('flashSuccess', 'Employee successfully updated!');
                redirect($this->config->item('base_url') . 'employee_management/employee');
            }
        }

        $data['employee'] = $this->employee_model->get_employee_by_id($id);
        $this->template->write_view('content', 'employee_management/edit_employee', $data);
        $this->template->render();
    }

    public function delete($id)
    {
        $id = $this->input->post('id');
        $data = array('is_deleted' => 1);
        $delete = $this->employee_model->delete_employee($id);
        if ($delete == 1) {
            $this->session->set_flashdata('flashSuccess', 'Employee details successfully deleted!');
            echo '1';
        } else {
            $this->session->set_flashdata('flashError', 'Operation Failed!');
            echo '0';
        }
    }

    function is_user_name_available()
    {
        $username = $this->input->post('username');
        $id = $this->input->post('id');
        $result = $this->employee_model->is_user_available($username, $id);
        if (!empty($result[0]['id'])) {
            echo 'yes';
        } else {
            echo 'no';
        }
    }

    function is_email_address_available()
    {
        $email = $this->input->post('email');
        $id = $this->input->post('id');
        $result = $this->employee_model->is_email_address_available($email, $id);
        if (!empty($result[0]['id'])) {
            echo 'yes';
        } else {
            echo 'no';
        }
    }

    function is_mobile_number_available()
    {
        $mobile = $this->input->post('mobile');
        $id = $this->input->post('id');
        $result = $this->employee_model->is_mobile_number_available($mobile, $id);
        if (!empty($result[0]['id'])) {
            echo 'yes';
        } else {
            echo 'no';
        }
    }
}
