<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Users extends MX_Controller {

    function __construct() {
        parent::__construct();
        if (!in_array($this->router->method, array('login', 'logout', 'register'))) {
            if (!$this->user_auth->is_logged_in()) {
                redirect($this->config->item('base_url') . 'users/login');
            }
        }
        $main_module = 'users';
        $access_arr = array(
            'users/index' => array('add', 'edit', 'delete', 'view'),
            'users/add' => array('add'),
            'users/edit' => array('edit'),
            'users/delete' => array('delete'),
            'users/is_user_name_available' => 'no_restriction',
            'users/my_profile' => 'no_restriction',
            'users/is_email_address_available' => 'no_restriction',
            'users/is_mobile_number_available' => 'no_restriction',
            'users/login' => 'no_restriction',
            'users/logout' => 'no_restriction',
            'users/session_data' => 'no_restriction',
            'users/detectDevice' => 'no_restriction'
        );
        if (!$this->user_auth->is_permission_allowed($access_arr, $main_module)) {
            redirect($this->config->item('base_url'));
        }
        $this->load->helper('cookie');
        $this->load->model('users/users_model');
        $this->load->model('users/user_type_model');
        $this->load->model('users/increment_model');
        $this->load->model('counter/admincounter_model');
        $this->template->write_view('session_msg', 'users/session_msg');

        date_default_timezone_set($this->timezone->timezone());
    }

    function index() {
        $data = array();
        $data['title'] = 'Users - Manage Users';
        $client_id = $this->user_auth->get_user_id();
        $data['users'] = $this->users_model->get_all_users($client_id);
        $this->template->write_view('content', 'users/index', $data);
        $this->template->render();
    }

    function add() {
        $data = array();
        $data['title'] = 'Users - Add New User';
        $client_id = $this->user_auth->get_user_id();
        if ($this->input->post('user')) {
            $profile_image = NULL;
            $config['upload_path'] = './attachments/profile_image/'; //define where the files will be uploaded
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
//                $config['source_image'] = FCPATH . 'attachments/profile_image/' . $upload_data['file_name'];

                $config['create_thumb'] = TRUE;
                $config['maintain_ratio'] = FALSE;
                $config['width'] = 150;
                $config['height'] = 150;
                $config['new_image'] = FCPATH . 'attachments/profile_image/' . $upload_data['file_name'];
                $this->image_lib->initialize($config);
                $this->image_lib->resize();
                $profile_image = base_url() . 'attachments/profile_image/' . $upload_data['file_name'];
            }
            $user = $this->input->post('user');
            $dob = explode(' ', $user['dob']);
            $date = explode('/', $dob[0]);
            $dobt = $date[2] . "-" . $date[1] . "-" . $date[0];
            $from_date_time = $dobt;
            if (!empty($profile_image))
                $user['profile_image'] = $profile_image;
            $user['dob'] = $from_date_time;
            $user['user_id'] = $this->increment_model->get_increment_code('user_code');
            $user['created_date'] = date('Y-m-d H:i:s');
            $user['client_id'] = $client_id;
            $user['is_backend_user'] = 1;

            $insert_id = $this->users_model->insert_user($user);
            if (!empty($insert_id)) {

                $this->session->set_flashdata('flashSuccess', 'New User successfully added!');
                redirect($this->config->item('base_url') . 'users');
            }
        }
        $data['user_types'] = $this->user_type_model->get_all_active_user_types($client_id);
        $data['user_id'] = $this->users_model->get_increment_code_based_client($client_id);
        $this->template->write_view('content', 'users/add_user', $data);
        $this->template->render();
    }

    function edit($id) {
        $data = array();
        $data['title'] = 'Users - Edit User';
        $client_id = $this->user_auth->get_user_id();
        if ($this->input->post('user')) {
            // Profile Picture
            $profile_image = NULL;
            $config['upload_path'] = './attachments/profile_image/'; //define where the files will be uploaded
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
//                $config['source_image'] = FCPATH . 'attachments/profile_image/' . $upload_data['file_name'];

                $config['create_thumb'] = TRUE;
                $config['maintain_ratio'] = FALSE;
                $config['width'] = 150;
                $config['height'] = 150;
                $config['new_image'] = FCPATH . 'attachments/profile_image/' . $upload_data['file_name'];
                $this->image_lib->initialize($config);
                $this->image_lib->resize();
                $profile_image = base_url() . 'attachments/profile_image/' . $upload_data['file_name'];
            }
            $user = $this->input->post('user');
            $dob = explode(' ', $user['dob']);
            $date = explode('/', $dob[0]);
            $dobt = $date[2] . "-" . $date[1] . "-" . $date[0];
            $from_date_time = $dobt;
            if (!empty($profile_image))
                $user['profile_image'] = $profile_image;
            if (empty($user['password']) || trim($user['password']) == '')
                unset($user['password']);
            $user['dob'] = $from_date_time;
            $user['updated_date'] = date('Y-m-d H:i:s');
            $user['client_id'] = $client_id;
            $update = $this->users_model->update_user($user, $id);
            if (!empty($update)) {
                $this->session->set_flashdata('flashSuccess', 'User successfully updated!');
                redirect($this->config->item('base_url') . 'users');
            }
        }
        $data['user_types'] = $this->user_type_model->get_all_active_user_types($client_id);
        $data['user'] = $this->users_model->get_user_by_id($id);
        $this->template->write_view('content', 'users/edit_user', $data);
        $this->template->render();
    }

    function my_profile() {
        $data = array();
        $id = $this->user_auth->get_user_id();
        $data['title'] = 'My Profile';
        if ($this->input->post('user')) {
            $profile_image = NULL;
            $config['upload_path'] = './attachments/profile_image/'; //define where the files will be uploaded
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
                $this->load->library('image_lib');
                $config['image_library'] = 'gd2';
//                $config['source_image'] = FCPATH . 'attachments/profile_image/' . $upload_data['file_name'];

                $config['create_thumb'] = TRUE;
                $config['maintain_ratio'] = FALSE;
                $config['width'] = 150;
                $config['height'] = 150;
                $config['new_image'] = FCPATH . 'attachments/profile_image/' . $upload_data['file_name'];
                $this->image_lib->initialize($config);
                $this->image_lib->resize();
                $profile_image = base_url() . 'attachments/profile_image/' . $upload_data['file_name'];
            }
            $user = $this->input->post('user');
            $dob = explode(' ', $user['dob']);
            $date = explode('/', $dob[0]);
            $dobt = $date[2] . "-" . $date[1] . "-" . $date[0];
            $from_date_time = $dobt;
            if (!empty($profile_image))
                $user['profile_image'] = $profile_image;
            $user['dob'] = $from_date_time;
            $user['updated_date'] = date('Y-m-d H:i:s');

            $update = $this->users_model->update_user($user, $id);
            if (!empty($update)) {
                $this->session->set_flashdata('flashSuccess', 'User successfully updated!');
                redirect($this->config->item('base_url'));
            }
        }
        $data['user'] = $this->users_model->get_user_by_id($id);
        //echo "<pre>";print_r($data);exit;
        $this->template->write_view('content', 'users/my_profile', $data);
        $this->template->render();
    }

    public function delete($id) {
        $id = $this->input->post('id');
        $data = array('is_deleted' => 1);
        $delete = $this->users_model->delete_user($id, $data);
        if ($delete == 1) {
            $this->session->set_flashdata('flashSuccess', 'Members details successfully deleted!');
            echo '1';
        } else {
            $this->session->set_flashdata('flashError', 'Operation Failed!');
            echo '0';
        }
    }

    function is_user_name_available() {
        $username = $this->input->post('username');
        $id = $this->input->post('id');
        $result = $this->users_model->is_user_available($username, $id);
        if (!empty($result[0]['id'])) {
            echo 'yes';
        } else {
            echo 'no';
        }
    }

    function is_email_address_available() {
        $email = $this->input->post('email');
        $id = $this->input->post('id');
        $result = $this->users_model->is_email_address_available($email, $id);
        if (!empty($result[0]['id'])) {
            echo 'yes';
        } else {
            echo 'no';
        }
    }

    function is_mobile_number_available() {
        $mobile = $this->input->post('mobile');
        $id = $this->input->post('id');
        $result = $this->users_model->is_mobile_number_available($mobile, $id);
        if (!empty($result[0]['id'])) {
            echo 'yes';
        } else {
            echo 'no';
        }
    }

    function login($status = NULL) {
        $data = array();
        $this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');
        if ($this->form_validation->run()) {
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            $usercek = $this->users_model->check_admin_login($username, $password);


            if ($usercek['user_type_id'] == '1') {
                $today = date('Y-m-d');
                $expire_date = $usercek['expire_date'];
                if ($expire_date < $today) {
                    $data = $this->session->set_flashdata('flashError', 'Your package has been expired, Please contact administrator', $data);
                    redirect($this->config->item('base_url') . 'users/login?login=fail');
                }
            }
            $cek = $this->admincounter_model->employee_login($username, $password, 1);

            if ($this->user_auth->login($this->form_validation->set_value('username'), $this->form_validation->set_value('password')) && $usercek['user_type_id'] == '1') {

                $user_id = $this->user_auth->get_user_id();
                $this->user_auth->create_autologin($user_id, $password); //store values in cookie
                redirect($this->config->item('base_url'));
            } if ($this->user_auth->login($this->form_validation->set_value('username'), $this->form_validation->set_value('password')) && $cek != 0) {
                $log_data['user_id'] = $this->user_auth->get_user_id();
                $log_data['user_type_id'] = 2;
                $log_data['log_type'] = 1;
                $log_data['log_in'] = date('Y-m-d H:i:s');
                $log_data['log_out'] = '';
                $log_data['device_name'] = $this->detectDevice();
                $ip = $_SERVER['REMOTE_ADDR'];
                $log_data['ip_address'] = $ip;
                $insert = $this->db->insert('que_log_details', $log_data);


                $client_details = $this->users_model->get_user_by_id($cek[0]['client_id']);
                $user_id = $client_details[0]['id'];
                $password = $client_details[0]['password'];
                $this->user_auth->create_autologin($user_id, $password);
                redirect($this->config->item('base_url') . 'counter/employee/' . $cek[0]['id']);
            } else {
                $data = $this->session->set_flashdata('flashError', 'Invalid User', $data);
                redirect($this->config->item('base_url') . 'users/login?login=fail');
            }
        }
        $data['login_status'] = 'success';
        if (isset($status) && $status != NULL) {
            $data['status'] = $status;
        }
        if (isset($_REQUEST['login']) && $_REQUEST['login'] == 'fail') {
            $data['login_status'] = 'fail';
        }
        $this->template->set_master_template('../../themes/queue/template_login.php');
        $this->template->write_view('content', 'users/login', $data);
        $this->template->render();
    }

    function logout($status = NULL) {
        $data = array();
        $user_id = $this->user_auth->get_user_id();
        $this->user_auth->logout();

        $update_data['log_out'] = date('Y-m-d H:i:s');
        $this->db->where('user_id', $user_id);
        $this->db->where('log_type', 1);
        $this->db->where('log_out', '0000-00-00 00:00:00');

        $data = $this->db->update('que_log_details', $update_data);

        if (isset($status) && $status != NULL) {
            redirect($this->config->item('base_url') . 'users/login?inactive=true');
        }
        redirect($this->config->item('base_url') . 'users/login');
    }

    function session_data() {
        $session_data = $this->user_auth->get_from_session_table();
        $session_data = unserialize($session_data['user_data']);
        $app_name = $this->config->item('application_name');
        $session_data = $session_data[$app_name];
        $app_session = json_decode(json_encode($this->user_auth->cryptography('decrypt', $session_data)), true);
    }

    function detectDevice() {
        $userAgent = $_SERVER["HTTP_USER_AGENT"];
        $devicesTypes = array(
            "computer" => array("msie 10", "msie 9", "msie 8", "windows.*firefox", "windows.*chrome", "x11.*chrome", "x11.*firefox", "macintosh.*chrome", "macintosh.*firefox", "opera"),
            "tablet" => array("tablet", "android", "ipad", "tablet.*firefox"),
            "mobile" => array("mobile ", "android.*mobile", "iphone", "ipod", "opera mobi", "opera mini"),
            "bot" => array("googlebot", "mediapartners-google", "adsbot-google", "duckduckbot", "msnbot", "bingbot", "ask", "facebook", "yahoo", "addthis")
        );
        foreach ($devicesTypes as $deviceType => $devices) {
            foreach ($devices as $device) {
                if (preg_match("/" . $device . "/i", $userAgent)) {
                    $deviceName = $deviceType;
                }
            }
        }
        return ucfirst($deviceName);
    }

}
