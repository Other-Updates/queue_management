<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Superadmin extends MX_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('superadmin/superadmin_model');
        $this->load->model('superadmin/increment_model');
        $this->template->write_view('session_msg', 'users/session_msg');
        date_default_timezone_set($this->timezone->timezone());
        $this->template->set_master_template('../../themes/queue/superadmin_template.php');
    }

    function index($status = NULL) {

        $data = array();
        $this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');
        if ($this->form_validation->run()) {
            $username = $this->input->post('username');
            $password = $this->input->post('password');

            $location_info['updated_date'] = date('Y-m-d H:i:s');

            $result = $this->user_auth->super_login($username, $password);

            if (isset($result) && $result == 1) {
                $user_type = $result['user_type'];

                if ($user_type == 0) {
                    redirect($this->config->item('base_url') . 'superadmin/dashboard');
                } else {
                    $data = $this->session->set_flashdata('flashError', 'Invalid User', $data);
                    redirect($this->config->item('base_url') . 'superadmin?login=fail');
                }
            } else {
                $data = $this->session->set_flashdata('flashError', 'Invalid User', $data);
                redirect($this->config->item('base_url') . 'superadmin?login=fail');
            }
        }

        $data['login_status'] = 'success';
        if (isset($status) && $status != NULL) {
            $data['status'] = $status;
        }
        if (isset($_REQUEST['login']) && $_REQUEST['login'] == 'fail') {
            $data['login_status'] = 'fail';
        }
        $this->template->set_master_template('../../themes/queue/superadmin_login.php');
        $this->template->write_view('content', 'superadmin/login', $data);
        $this->template->render();
    }

    function my_profile() {

        $data = array();
        $id = $this->user_auth->get_user_id();

        $data['title'] = 'My Profile';
        if ($this->input->post('super_admin')) {

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
            $super_admin = $this->input->post('super_admin');
            $dob = explode(' ', $super_admin['dob']);
            $date = explode('/', $dob[0]);
            $dob_date = $date[2] . '-' . $date[1] . '-' . $date[0];
            if (!empty($profile_image))
                $super_admin['profile_image'] = $profile_image;
            if (empty($super_admin['password']) || trim($super_admin['password']) == '')
                unset($super_admin['password']);
            else
                $super_admin['password'] = md5($super_admin['password']);
            $super_admin['dob'] = $dob_date;
            $super_admin['updated_date'] = date('Y-m-d H:i:s');

            $update = $this->superadmin_model->update_superadmin($super_admin, $id);
            if (!empty($update)) {
                $this->session->set_flashdata('flashSuccess', 'Superadmin Details successfully updated!');
                redirect($this->config->item('base_url') . 'superadmin/dashboard');
            }
        }
        $data['super_admin'] = $this->superadmin_model->get_superadmin_by_id($id);
        $this->template->write_view('content', 'superadmin/my_profile', $data);
        $this->template->render();
    }

    function register() {
        $data = array();
        $data['title'] = 'Register';

        if ($this->input->post('super_admin')) {

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
            $super_admin = $this->input->post('super_admin');
            $dob = explode(' ', $super_admin['dob']);
            $date = explode('/', $dob[0]);
            $dob_date = $date[2] . '-' . $date[1] . '-' . $date[0];
            if (!empty($profile_image))
                $super_admin['profile_image'] = $profile_image;
            if (empty($super_admin['password']) || trim($super_admin['password']) == '')
                unset($super_admin['password']);
            else
                $super_admin['password'] = md5($super_admin['password']);
            $super_admin['dob'] = $dob_date;
            $super_admin['updated_date'] = date('Y-m-d H:i:s');

            $super_admin['super_admin_id'] = $this->increment_model->get_increment_code('super_admin');

            $insert_id = $this->superadmin_model->insert_super_admin($super_admin);
            if (!empty($insert_id)) {
                $this->increment_model->update_increment_code('super_admin');
                $this->session->set_flashdata('flashSuccess', 'Superadmin Registered successfully!');
                redirect($this->config->item('base_url') . 'superadmin/login');
            }
        }
        $data['super_admin_id'] = $this->increment_model->get_increment_code('super_admin');

        $this->template->set_master_template('../../themes/points/super_admin_register.php');
        $this->template->write_view('content', 'superadmin/register', $data);
        $this->template->render();
    }

    function logout($status = NULL) {
        $data = array();
        $this->user_auth->logout();
        if (isset($status) && $status != NULL) {
            redirect($this->config->item('base_url') . 'superadmin?inactive=true');
        }
        redirect($this->config->item('base_url') . 'superadmin');
    }

    function session_data() {
        $session_data = $this->user_auth->get_from_session_table();
        $session_data = unserialize($session_data['user_data']);
        $app_name = $this->config->item('application_name');
        $session_data = $session_data[$app_name];
        $app_session = json_decode(json_encode($this->user_auth->cryptography('decrypt', $session_data)), true);
    }

    function is_user_name_available() {
        $username = $this->input->post('username');
        $result = $this->superadmin_model->is_user_available($username);
        if (!empty($result[0]['id'])) {
            echo 1;
        } else {
            echo 0;
        }
    }

    function is_email_address_available() {
        $email = $this->input->post('email');
        $result = $this->superadmin_model->is_email_address_available($email);
        if (!empty($result[0]['id'])) {
            echo 1;
        } else {
            echo 0;
        }
    }

    function is_mobile_number_available() {
        $mobile = $this->input->post('mobile');
        $result = $this->superadmin_model->is_mobile_number_available($mobile);
        if (!empty($result[0]['id'])) {
            echo 1;
        } else {
            echo 0;
        }
    }

}
