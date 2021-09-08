<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Category_type extends MX_Controller {

    function __construct() {
        parent::__construct();
        if ($this->user_auth->is_logged_in()) {
            $user_details = $this->user_auth->get_all_session();
            if ($user_details['is_backend_user'] == 0) {
                redirect($this->config->item('base_url') . 'counter/employee/' . $user_details['user_id']);
            }
        }
        if (!$this->user_auth->is_logged_in())
            redirect($this->config->item('base_url') . 'users/login');
        $main_module = 'masters';
        $access_arr = array(
            'category_type/index' => array('add', 'edit', 'delete', 'view'),
            'category_type/add' => array('add'),
            'category_type/edit' => array('edit'),
            'category_type/delete' => array('delete'),
            'category_type/view' => array('view'),
            'category_type/is_category_type_available' => array('add', 'edit')
        );

        if (!$this->user_auth->is_permission_allowed($access_arr, $main_module)) {
            redirect($this->config->item('base_url'));
        }
        $this->load->model('masters/category_type_model');
        $this->load->model('counter_model');
    }

    public function index() {
        $data = array();
        $data['title'] = 'Category - Manage Category Types';
        $client_id = $this->user_auth->get_user_id();
        $data['category'] = $this->category_type_model->get_all_category_type($client_id);
        $this->template->write_view('content', 'masters/category_type_list', $data);
        $this->template->render();
    }

    public function add() {
        $data = array();
        $datas['title'] = 'Category Types - Add New Category Type';
        $client_id = $this->user_auth->get_user_id();
        if ($this->input->post('category')) {

            $category = $this->input->post('category');
            $category['created_date'] = date('Y-m-d H:i:s');
            $category['client_id'] = $client_id;

            $insert = $this->category_type_model->insert_category_type($category);

            $this->category_type_model->get_category_type_class($category['status'], $insert);
            if (!empty($insert)) {
                $i = 0;
                foreach ($category as $key => $val) {
                    $data[$i]['category_id'] = $insert;
                    $data[$i]['code'] = strtoupper($category['prefix']);
                    $data[$i]['type'] = 'token_code';
                    $data[$i]['counter_id'] = $category['counter_id'];
                    $data[$i]['inc_date'] = date('Y-m-d H:i:s');
                    $data[$i]['last_increment_id'] = '1';
                }
            }

            $token_num = $this->category_type_model->insert_token_details($data);
            $this->session->set_flashdata('flashSuccess', 'Category Added');
            redirect($this->config->item('base_url') . 'masters/category_type');
        }
        $data['counter'] = $this->category_type_model->get_all_active_counters($client_id);
        $this->template->write_view('content', 'masters/add_category_type', $data);
        $this->template->render();
    }

    public function edit($id) {
        $data = array();
        $data['title'] = 'Manage Category - Edit Category Type';
        $client_id = $this->user_auth->get_user_id();
        if ($this->input->post('category')) {
            $category = $this->input->post('category');
            $category['updated_date'] = date('Y-m-d H:i:s');

            $category['client_id'] = $client_id;
            $update = $this->category_type_model->update_category_type($category, $id);
            if (!empty($update)) {
                unset($category['category_type']);
                unset($category['prefix']);
                unset($category['status']);
                unset($category['updated_date']);
                unset($category['client_id']);
                $token_num = $this->category_type_model->update_token_details($category, $id);
            }
            //update_class
            $this->category_type_model->get_category_type_class($category['status'], $id);
            $this->session->set_flashdata('flashSuccess', 'Category_Type Updated');
            redirect($this->config->item('base_url') . 'masters/category_type');
        };
        $data['counter'] = $this->category_type_model->get_all_active_counters($client_id);
        $data['category'] = $this->category_type_model->get_category_type_by_id($id);
        $this->template->write_view('content', 'masters/edit_category_type', $data);
        $this->template->render();
    }

    function delete($id) {
        $id = $this->input->post('id');
        $data = array('is_deleted' => 1);
        $delete = $this->category_type_model->delete_category_type($id);
        if ($delete == 1) {
            $this->session->set_flashdata('flashSuccess', 'Category type successfully deleted!');
            $this->category_type_model->get_category_type_class(1, null);
            echo '1';
        } else {
            $this->session->set_flashdata('flashError', 'Operation Failed!');
            echo '0';
        }
    }

    function is_category_type_available() {
        $category_type = $this->input->post('category_type');
        $client_id = $this->user_auth->get_user_id();
        $result = $this->category_type_model->is_category_type_available($category_type, $client_id);
        if (!empty($result[0]['id'])) {

            echo 'yes';
        } else {

            echo 'no';
        }
    }

}
