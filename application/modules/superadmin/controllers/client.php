<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Client extends MX_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('superadmin/superadmin_model');
        $this->load->model('superadmin/client_model');
        $this->load->model('superadmin/increment_model');
        $this->template->write_view('session_msg', 'users/session_msg');
        $this->template->set_master_template('../../themes/queue/superadmin_template.php');
    }

    function index() {

        $data = array();
        $data['title'] = 'Manage Client - Client';
        $this->template->write_view('content', 'superadmin/client_list', $data);
        $this->template->render();
    }

    function add() {
        $data = array();
        $data['title'] = 'Manage Client - Add New Client';

        if ($this->input->post('client')) {
            $client = $this->input->post('client');

            $profile_image = NULL;
            $config['upload_path'] = './attachments/profile_image/';
            $allowed_types = array('jpg', 'jpeg', 'png');
            $config['allowed_types'] = implode('|', $allowed_types);
            $config['max_size'] = '10000';
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if (!empty($_FILES['profile_image']['name'])) {

                $_FILES['profile_image'] = array(
                    'name' => $_FILES['profile_image']['name'],
                    'type' => $_FILES['profile_image']['type'],
                    'tmp_name' => $_FILES['profile_image']['tmp_name'],
                    'error' => $_FILES['profile_image']['error'],
                    'size' => $_FILES['profile_image']['size']
                );

                $random_hash = substr(str_shuffle(time()), 0, 3) . strrev(mt_rand(100000, 999999));
                $extension = pathinfo($_FILES['profile_image']['name'], PATHINFO_EXTENSION);
                $config['file_name'] = 'PI_' . $random_hash . '.' . $extension;
                $this->upload->initialize($config);
                $this->upload->do_upload('profile_image');
                $upload_data = $this->upload->data();

                // Make thumbnail image

                $this->load->library('image_lib');
                $config['image_library'] = 'gd2';
                $config['source_image'] = FCPATH . 'attachments/profile_image/' . $upload_data['file_name'];
                $config['create_thumb'] = TRUE;
                $config['maintain_ratio'] = FALSE;
                $config['width'] = 150;
                $config['height'] = 150;
                $config['new_image'] = FCPATH . 'attachments/profile_image/thumb/' . $upload_data['file_name'];
                $this->image_lib->initialize($config);
                $this->image_lib->resize();
                $profile_image = base_url() . 'attachments/profile_image/' . $upload_data['file_name'];
            }
            if (!empty($profile_image)) {
                $client['profile_image'] = $profile_image;
            } else {
                $client['profile_image'] = '';
            }
            // Logo Image
            $company_logo = NULL;
            $config['upload_path'] = './attachments/logo/';
            $allowed_types = array('jpg', 'jpeg', 'png');
            $config['allowed_types'] = implode('|', $allowed_types);
            $config['max_size'] = '1000';
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if (!empty($_FILES['company_logo']['name'])) {
                $_FILES['company_logo'] = array(
                    'name' => $_FILES['company_logo']['name'],
                    'type' => $_FILES['company_logo']['type'],
                    'tmp_name' => $_FILES['company_logo']['tmp_name'],
                    'error' => $_FILES['company_logo']['error'],
                    'size' => $_FILES['company_logo']['size']
                );
                $random_hash = substr(str_shuffle(time()), 0, 3) . strrev(mt_rand(100000, 999999));
                $extension = pathinfo($_FILES['company_logo']['name'], PATHINFO_EXTENSION);
                $config['file_name'] = 'PI_' . $random_hash . '.' . $extension;
                $this->upload->initialize($config);
                $this->upload->do_upload('company_logo');
                $upload_data = $this->upload->data();
                // Make thumbnail image
                $this->load->library('image_lib');
                $config['image_library'] = 'gd2';
                $config['source_image'] = FCPATH . 'attachments/logo/' . $upload_data['file_name'];
                $config['create_thumb'] = TRUE;
                $config['maintain_ratio'] = FALSE;
                $config['width'] = 150;
                $config['height'] = 150;
                $config['new_image'] = FCPATH . 'attachments/logo/thumb/' . $upload_data['file_name'];
                $this->image_lib->initialize($config);
                $this->image_lib->resize();
                if (!empty($upload_data['file_name'])) {
                    $company_logo = base_url() . 'attachments/logo/' . $upload_data['file_name'];
                }
            }


            if (!empty($upload_data['file_name'])) {
                $client['company_logo'] = $company_logo;
            } else {
                $client['company_logo'] = '';
            }


            $expire_date = explode(' ', $client['expire_date']);
            $date = explode('/', $expire_date[0]);
            $exp_date = $date[2] . "-" . $date[1] . "-" . $date[0];
            $fromatted_exp_date = $exp_date;
            $client['expire_date'] = $fromatted_exp_date;
            $client['password'] = md5($client['password']);
            $client['created_date'] = date('Y-m-d H:i:s');
            $client['user_type_id'] = 1;
            $client['is_backend_user'] = 1;
            $client['is_admin'] = 1;
            $client['user_id'] = $this->increment_model->get_increment_code('client');
            $insert_id = $this->client_model->insert_client($client);

            if (!empty($insert_id)) {
                $this->increment_model->update_increment_code('client');
                $this->session->set_flashdata('flashSuccess', 'New Client successfully added!');
                redirect($this->config->item('base_url') . 'superadmin/client');
            } else {
                $this->session->set_flashdata('flashError', 'Client not added! Please try again');
                redirect($this->config->item('base_url') . 'superadmin/client');
            }
        }
        $data['user_id'] = $this->increment_model->get_increment_code('client');
        $this->template->write_view('content', 'superadmin/add_client', $data);
        $this->template->render();
    }

    function edit($id) {

        $data = array();
        $data['title'] = 'Manage Client - Edit Client';

        if ($this->input->post('client')) {
            $client = $this->input->post('client');
            // Profile Picture
            $profile_image = NULL;
            $config['upload_path'] = './attachments/profile_image/';
            $allowed_types = array('jpg', 'jpeg', 'png');
            $config['allowed_types'] = implode('|', $allowed_types);
            $config['max_size'] = '10000';
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if (!empty($_FILES['profile_image']['name'])) {

                $_FILES['profile_image'] = array(
                    'name' => $_FILES['profile_image']['name'],
                    'type' => $_FILES['profile_image']['type'],
                    'tmp_name' => $_FILES['profile_image']['tmp_name'],
                    'error' => $_FILES['profile_image']['error'],
                    'size' => $_FILES['profile_image']['size']
                );

                $random_hash = substr(str_shuffle(time()), 0, 3) . strrev(mt_rand(100000, 999999));
                $extension = pathinfo($_FILES['profile_image']['name'], PATHINFO_EXTENSION);
                $config['file_name'] = 'PI_' . $random_hash . '.' . $extension;
                $this->upload->initialize($config);
                $this->upload->do_upload('profile_image');
                $upload_data = $this->upload->data();

                // Make thumbnail image

                $this->load->library('image_lib');
                $config['image_library'] = 'gd2';
                $config['source_image'] = FCPATH . 'attachments/profile_image/' . $upload_data['file_name'];
                $config['create_thumb'] = TRUE;
                $config['maintain_ratio'] = FALSE;
                $config['width'] = 150;
                $config['height'] = 150;
                $config['new_image'] = FCPATH . 'attachments/profile_image/thumb/' . $upload_data['file_name'];
                $this->image_lib->initialize($config);
                $this->image_lib->resize();
                $profile_image = base_url() . 'attachments/profile_image/' . $upload_data['file_name'];
            }
            if (!empty($profile_image))
                $client['profile_image'] = $profile_image;

            // Logo Image

            $company_logo = NULL;
            $config['upload_path'] = './attachments/logo/';
            $allowed_types = array('jpg', 'jpeg', 'png');
            $config['allowed_types'] = implode('|', $allowed_types);
            $config['max_size'] = '1000';
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if (!empty($_FILES['company_logo']['name'])) {
                $_FILES['company_logo'] = array(
                    'name' => $_FILES['company_logo']['name'],
                    'type' => $_FILES['company_logo']['type'],
                    'tmp_name' => $_FILES['company_logo']['tmp_name'],
                    'error' => $_FILES['company_logo']['error'],
                    'size' => $_FILES['company_logo']['size']
                );
                $random_hash = substr(str_shuffle(time()), 0, 3) . strrev(mt_rand(100000, 999999));
                $extension = pathinfo($_FILES['company_logo']['name'], PATHINFO_EXTENSION);
                $config['file_name'] = 'PI_' . $random_hash . '.' . $extension;
                $this->upload->initialize($config);
                $this->upload->do_upload('company_logo');
                $upload_data = $this->upload->data();
                // Make thumbnail image
                $this->load->library('image_lib');
                $config['image_library'] = 'gd2';
                $config['source_image'] = FCPATH . 'attachments/logo/' . $upload_data['file_name'];
                $config['create_thumb'] = TRUE;
                $config['maintain_ratio'] = FALSE;
                $config['width'] = 150;
                $config['height'] = 150;
                $config['new_image'] = FCPATH . 'attachments/logo/thumb/' . $upload_data['file_name'];
                $this->image_lib->initialize($config);
                $this->image_lib->resize();
                if (!empty($upload_data['file_name'])) {
                    $company_logo = base_url() . 'attachments/logo/' . $upload_data['file_name'];
                }
            }


            if (!empty($upload_data['file_name'])) {
                $client['company_logo'] = $company_logo;
            }


            $expire_date = explode(' ', $client['expire_date']);
            $date = explode('/', $expire_date[0]);
            $exp_date = $date[2] . "-" . $date[1] . "-" . $date[0];
            $fromatted_exp_date = $exp_date;
            $client['expire_date'] = $fromatted_exp_date;


            if (empty($client['password']) || trim($client['password']) == '')
                unset($client['password']);
            else
                $client['password'] = md5($client['password']);



            $client['updated_date'] = date('Y-m-d H:i:s');

            $update = $this->client_model->update_client($client, $id);
            if (!empty($update)) {
                $this->session->set_flashdata('flashSuccess', 'Client successfully updated!');
                redirect($this->config->item('base_url') . 'superadmin/client');
            }
        }
        $data['client'] = $this->client_model->get_client_by_id($id);
        $this->template->write_view('content', 'superadmin/edit_client', $data);
        $this->template->render();
    }

    function delete($id) {
        $id = $this->input->post('id');
        $data = array('is_deleted' => 1);
        $delete = $this->client_model->delete_client($id, $data);
        if ($delete == 1) {
            $this->session->set_flashdata('flashSuccess', 'Client successfully deleted!');
            echo '1';
        } else {
            $this->session->set_flashdata('flashError', 'Operation Failed!');
            echo '0';
        }
    }

    function client_ajaxList() {
        $search_data = array();
        $search_data = $this->input->post();
        $list = $this->client_model->get_datatables($search_data);

        $data = array();
        $no = $_POST['start'];
        foreach ($list as $ass) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = ucwords($ass->user_id);
            $row[] = ucfirst($ass->firstname) . " " . ucfirst($ass->lastname);
            $row[] = $ass->username;
            $row[] = (!empty($ass->expire_date)) ? date('d-M-Y', strtotime($ass->expire_date)) : '';
            if ($ass->status == '1') {
                $status = '<span class = "label label-success">Active</span>';
            } else {
                $status = '<span class = "label label-default">Inactive</span>';
            }
            $row[] = $status;

            $row1 = '<a href = "' . $this->config->item('base_url') . 'superadmin/client/edit/' . $ass->id . '" title = "Edit" class = "btn btn-info btn-xs"><i class = "glyphicon glyphicon-edit"></i></a>&nbsp;
        <a href = "javascript:void(0);" class = "btn btn-danger btn-xs" onclick = "delete_client(' . $ass->id . ')" title = "Delete"><i class = "glyphicon glyphicon-trash"></i></a>';

            $row[] = $row1;
            $data[] = $row;
        }
        $output = array(
            'draw' => $_POST['draw'],
            'recordsTotal' => $this->client_model->count_all(),
            'recordsFiltered' => $this->client_model->count_filtered($search_data),
            'data' => $data,
        );
        echo json_encode($output);
        exit;
    }

    function is_user_name_available() {
        $username = $this->input->post('username');
        $result = $this->client_model->is_user_available($username);
        if (!empty($result[0]['id'])) {
            echo 1;
        } else {
            echo 0;
        }
    }

    function is_email_address_available() {
        $email = $this->input->post('email');
        $result = $this->client_model->is_email_address_available($email);
        if (!empty($result[0]['id'])) {
            echo 1;
        } else {
            echo 0;
        }
    }

    function is_mobile_number_available() {
        $mobile = $this->input->post('mobile');
        $result = $this->client_model->is_mobile_number_available($mobile);
        if (!empty($result[0]['id'])) {
            echo 1;
        } else {
            echo 0;
        }
    }

}

?>