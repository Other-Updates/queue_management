<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Subcategory extends MX_Controller {

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
            'subcategory/index' => array('add', 'edit', 'delete', 'view'),
            'subcategory/add' => array('add'),
            'subcategory/edit' => array('edit'),
            'subcategory/delete' => array('delete'),
            'subcategory/view' => array('view'),
            'subcategory/is_category_type_available' => array('add', 'edit'),
            'subcategory/session_data' => 'no_restriction'
        );
//        if (!$this->user_auth->is_permission_allowed($access_arr, $main_module)) {
//            redirect($this->config->item('base_url'));
//        }

        $this->load->model('masters/subcategory_model');
        $this->load->model('masters/token_increment_model');
    }

    public function index() {
        $data = array();
        $data['title'] = 'Category - Manage Category';
        $client_id = $this->user_auth->get_user_id();
        $data['token'] = $this->subcategory_model->get_all_category_details($client_id);
        $this->template->write_view('content', 'masters/category_list', $data);
        $this->template->render();
    }

    public function add() {
        $data = array();
        $data['title'] = 'Category- Create category';
        $client_id = $this->user_auth->get_user_id();
        if ($this->input->post('category')) {
            $category = $this->input->post('category');
            $category['created_date'] = date('Y-m-d H:i:s');
            $category['client_id'] = $client_id;
            $insert = $this->subcategory_model->insert_category($category);
            $this->subcategory_model->get_sub_category_type_class($category['category_id']);
            if (!empty($insert)) {
                $this->session->set_flashdata('flashSuccess', 'Category Added');
                redirect($this->config->item('base_url') . 'masters/subcategory');
            }
        }
        $data['category'] = $this->subcategory_model->get_all_category($client_id);
        $this->template->write_view('content', 'masters/add_category', $data);
        $this->template->render();
    }

    public function edit($id) {
        $data = array();
        $data['title'] = 'Category - Edit category';
        $client_id = $this->user_auth->get_user_id();
        if ($this->input->post('category')) {
            $category = $this->input->post('category');
            $category['updated_date'] = date('Y-m-d H:i:s');
            $category['client_id'] = $client_id;
            $update = $this->subcategory_model->update_category($category, $id);
            $this->session->set_flashdata('flashSuccess', 'Category Updated');
            redirect($this->config->item('base_url') . 'masters/subcategory');
        }

        $data['category'] = $this->subcategory_model->get_category_details_id($id);
        $data['category_type'] = $this->subcategory_model->get_all_category($client_id);
        $this->template->write_view('content', 'masters/edit_category', $data);
        $this->template->render();
    }

    function delete($id) {
        $id = $this->input->post('id');
        $catid = $this->input->post('catid');

        $data = array('is_deleted' => 1);
        $delete = $this->subcategory_model->delete_subcategory($id);
        $this->subcategory_model->get_sub_category_type_class($catid);
        if ($delete == 1) {
            $this->session->set_flashdata('flashSuccess', 'Category successfully deleted!');
            echo '1';
        } else {
            $this->session->set_flashdata('flashError', 'Operation Failed!');
            echo '0';
        }
    }

    function is_sub_category_available() {
        $subcategory_name = $this->input->post('subcategory_name');
        $category_id = $this->input->post('category_id');
        $client_id = $this->user_auth->get_user_id();
        $id = $this->input->post('id');
        $result = $this->subcategory_model->is_sub_category_available($subcategory_name, $category_id, $client_id);
        if (!empty($result[0]['id'])) {
            echo 'yes';
        } else {

            echo 'no';
        }
    }

    function session_data() {
        $session_data = $this->user_auth->get_from_session_table();
        $session_data = unserialize($session_data['user_data']);
        $app_name = $this->config->item('application_name');
        $session_data = $session_data[$app_name];
        $app_session = json_decode(json_encode($this->user_auth->cryptography('decrypt', $session_data)), true);
    }

}

?>