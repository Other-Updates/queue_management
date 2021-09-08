<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Counter extends MX_Controller {

    function __construct() {

        parent::__construct();
        $main_module = 'counterscreen';
        $access_arr = array(
            'counter/index' => array('add', 'edit', 'delete', 'view'),
            'counter/subcategory' => 'no_restriction',
            'counter/token' => 'no_restriction',
            'counter/login' => 'no_restriction',
            'counter/employee' => 'no_restriction',
            'counter/check_counter_active' => 'no_restriction',
            'counter/search_token' => 'no_restriction',
            'counter/insert_emp_idle_start_time' => 'no_restriction',
            'counter/update_emp_idle_end_time' => 'no_restriction',
            'counter/detectDevice' => 'no_restriction',
            'counter/counter_ajax' => 'no_restriction'
        );
        $this->load->model('counter/admincounter_model');
        $this->load->model('masters/counter_model');
        $this->load->model('queprocess/token_model');
    }

    function index($id) {
        $data = array();
        $this->load->helper('cookie');
        $data['title'] = 'Queue_process-List of user details';
        $data['token'] = $this->admincounter_model->get_all_token();
        $data['status'] = $this->admincounter_model->get_all_empty_status();
        $this->template->write_view('content', 'all_counter', $data);
        $this->template->render();
    }

    function check_counter_active() {
        $cookie_details = unserialize(get_cookie($this->config->item('autologin_cookie_name')));
        $user_id = $cookie_details['user_id'];
        $counter_name = $this->input->post('counter_name');
        $data = $this->admincounter_model->check_counter_active($counter_name, $user_id);
        if ($data == 1)
            echo 1;
        else
            echo 0;
    }

    function employee($id) {
        $data = array();

        $this->load->helper('cookie');
        if ($this->user_auth->is_logged_in() && get_cookie($this->config->item('autologin_cookie_name'), TRUE)) {
            $user_details = $this->user_auth->get_all_session();
            if ($user_details['is_backend_user'] == 0) {
                $cookie_details = unserialize(get_cookie($this->config->item('autologin_cookie_name')));
                $user_id = $cookie_details['user_id'];
                if ($id != '') {
                    $data['title'] = 'Queue_process-List of user details';
                    $data['token'] = $this->admincounter_model->get_token_details_by_id($id);
                    $empty_tkn_details = $this->admincounter_model->get_emp_tkn_data($id, $search_data);
                    $data['progress_tkn_count'] = $empty_tkn_details['count_empty_tkn'];
                    $data['status'] = $this->admincounter_model->get_all_empty_status($id);
                    $data['counter'] = $this->admincounter_model->get_all_counter($id, $user_id);
                    $data['emp_id'] = $id;
                    $data['emp_status'] = $this->admincounter_model->get_emp_status($id);
                    $data['username'] = $this->admincounter_model->get_username($id);
                    //$data['get_assign_employee_counter'] = $this->admincounter_model->get_employee_counter();
                    $data['get_assign_employee_counter'] = $this->admincounter_model->get_employee_active_counter($user_id);
                    $data['assign_counter'] = $this->admincounter_model->get_all_emp_counter_details($id);
                    $data['counter_details'] = $this->admincounter_model->get_counter($id);
                    $data['counter_name'] = $data['counter_details'][0]['counter_name'];
                    $this->load->view('admincounter', $data);
                } else {
                    redirect($this->config->item('base_url') . 'users/login');
                }
            } else {
                redirect($this->config->item('base_url'));
            }
        } else {
            $data['id'] = $id;
            $this->load->view('counter/login', $data);
        }
    }

    function counter_ajax() {


        $search_data = array();
        $search_data = $this->input->post();

        $id = $this->input->post('employee_id');
        $list = $this->admincounter_model->get_token_details_by_id($id, $search_data);
        $empty_tkn_details = $this->admincounter_model->get_emp_tkn_data($id, $search_data);
        $progress_tkn_count = $empty_tkn_details['count_empty_tkn'];
        $progress_tkn_number = $empty_tkn_details['empty_tkn_number'];
        $empty_tkn_id = $empty_tkn_details['empty_tkn_id'];

        $data = array();
        $no = $_POST['start'];

        if (count($list) > 0) {
            foreach ($list as $key => $ass) {

                if ($ass['token_status'] == "Success")
                    $style = "color:green";
                if ($ass['token_status'] == "Hold")
                    $style = "color:skyblue";
                if ($ass['token_status'] == "Transfer")
                    $style = "color:orange";
                if ($ass['token_status'] == "Missed")
                    $style = "color:red";
                if ($ass['token_status'] == 'Hold-Reassign' || $ass['token_status'] == 'Missed-Reassign')
                    $style = "color:#0b6d9a";

                $token_number = '<span class="curr_num token_num' . $ass['id'] . '">' . $ass['token_number'] . "</span>";
                $token_status = '<span style="' . $style . '"  class="tkn_status' . $ass['id'] . '">' . $ass['token_status'] . '</span>';
                if ($ass['is_edit'] == 0) {
                    $remarks = '<span class="remar' . $ass['id'] . '">' . ucfirst($ass['remarks']) . '</span>';
                } else {
                    $remarks = '<span class="remar' . $ass['id'] . '">' . ucfirst($ass['remarks']) . '</span><span class="fa fa-edit edit" onclick="update(' . $ass['id'] . ')"style="float:right;margin-top: 7px;color: #0b6d9a;" title="Edit"></span>';
                }

                $no++;
                $row = array();
                $row[] = '<span class="tkn_details" data-id="' . $ass['id'] . '" >' . $no . '</span>';
                $row[] = $token_number;
                $row[] = $token_status;
                $row[] = $remarks;
                $row[] = $progress_tkn_count;
                $row[] = $progress_tkn_number;
                $row[] = $empty_tkn_id;

                $data[] = $row;
            }
        }

        $output = array(
            'draw' => $_POST['draw'],
            'recordsTotal' => count($data),
            'recordsFiltered' => count($data),
            'data' => $data,
        );

        echo json_encode($output);
        exit;
    }

    function edit_update_status($id, $emp_id) {
        $data = array();
        $data['title'] = 'Admin- Token Status';
        $cookie_details = unserialize(get_cookie($this->config->item('autologin_cookie_name')));
        $user_id = $cookie_details['user_id'];


        $post_data = $this->input->post();
        $this->db->where('emp_id', $emp_id);
        $counter_details = $this->db->get('que_assign_counter')->result_array();
        $current_counter = $counter_details[0]['counter_id'];
        $status = $this->input->post('status');
        //insert_edit_tkn
        $this->admincounter_model->insert_edit_employee($id);
        $update = $this->admincounter_model->edit_update_status($status, $id, $current_counter);
        if ($update)
            $this->admincounter_model->update_next_tkn_intime($id, $current_counter);
        if ($status['token_status'] == "Transfer") {
            // $result = $this->tranfer_token($status['remarks'], $status['token_number'], $current_counter);
            $result = $this->token_model->insert_transfer_data($status['remarks'], $status['token_number'], $user_id);
        }
        if (!empty($update)) {
            echo 1;
            exit;
            // $this->session->set_flashdata('flashSuccess', 'Token Status successfully updated!');
            // redirect($this->config->item('base_url') . 'counter/employee/' . $emp_id);
        }

        $data['token'] = $this->admincounter_model->get_all_token();
        $this->template->write_view('content', 'admincounter', $data);
        $this->template->render();
    }

    function update_status($id, $emp_id) {
        $data = array();
        $data['title'] = 'Admin- Token Status';
        $cookie_details = unserialize(get_cookie($this->config->item('autologin_cookie_name')));
        $user_id = $cookie_details['user_id'];
        $post_data = $this->input->post();
        $this->db->where('emp_id', $emp_id);
        $counter_details = $this->db->get('que_assign_counter')->result_array();
        $current_counter = $counter_details[0]['counter_id'];
        if ($this->input->post('status')) {
            $status = $this->input->post('status');

            $update = $this->admincounter_model->update_status($status, $id, $current_counter);

            if ($update)
                $this->admincounter_model->update_next_tkn_intime($id, $current_counter);

            if ($status['token_status'] == "Transfer") {

                $result = $this->token_model->insert_transfer_data($status['remarks'], $status['token_number'], $user_id);
                //  $result = $this->tranfer_token($status['remarks'], $status['token_number'], $current_counter);
            }
            if (!empty($update)) {
                //$this->session->set_flashdata('flashSuccess', 'Token Status successfully updated!');
                echo 1;
                exit;
                // redirect($this->config->item('base_url') . 'counter/employee/' . $emp_id);
            }
        }

        $data['token'] = $this->admincounter_model->get_all_token();
        $this->template->write_view('content', 'admincounter', $data);
        $this->template->render();
    }

    function get_insert_transfer_tkn_details($trans_counter, $counter_id) {
        $emp_id = $this->admincounter_model->get_emp_id_from_assign_counter($counter_id);

        $insert_tranfer_data_queue = [
            "category_id" => $trans_counter[0]['category_id'],
            "emp_id" => $emp_id,
            "counter_id" => $counter_id,
            "token_number" => $trans_counter[0]['token_number'],
            "token_status" => '',
            "remarks" => '',
            "transfer_counter_id" => $counter_id,
            "created_date" => date('Y-m-d H:i:s'),
            "updated_date" => date('Y-m-d H:i:s'),
        ];

        $data = $this->admincounter_model->check_process_tokn($counter_id);
        if ($data == 1)
            $insert_tranfer_data_queue['tkn_intime'] = date('H:i:s');

        return $insert_tranfer_data_queue;
    }

    function tranfer_token_bylast_queue($counter_name, $token_number, $current_counter) {
        $datas = array();
        //transfer counter id
        $counter_id = $this->admincounter_model->get_counter_id($counter_name);
        if (!empty($counter_id)) {
            //transfer token details
            $transfer_token = $this->admincounter_model->get_tranfer_token_details($current_counter, $token_number);
            //current token details
            $trans_counter = $this->admincounter_model->get_transfer_counter($counter_id);

            $insert_tranfer_data_queue = $this->get_insert_transfer_tkn_details($transfer_token, $counter_id);
        }
    }

    function tranfer_token($counter_name, $token_number, $current_counter) {
        $datas = array();
        //transfer counter id
        $counter_id = $this->admincounter_model->get_counter_id($counter_name);
        if (!empty($counter_id)) {
            //transfer token details
            $transfer_token = $this->admincounter_model->get_tranfer_token_details($current_counter, $token_number);
            //current token details
            $trans_counter = $this->admincounter_model->get_transfer_counter($counter_id);
            $insert_tranfer_data_queue = $this->get_insert_transfer_tkn_details($transfer_token, $counter_id);
            // $trans_counter=0;
            if ($trans_counter != 0) {
                //  $first_inc_id = $trans_counter[0]['id'];
                $count_inprogress_token = count($trans_counter);
                $last_token_id = $count_inprogress_token - 1;
                $last_tokenid = $trans_counter[$last_token_id]['id'];

                //Get all insert after token

                $inprogress_tokens = $this->admincounter_model->get_last_insert_counter_details($last_tokenid);
                //$inprogress_tokens=0;
                if ($inprogress_tokens != 0) {
                    //insert transfer token
                    $count_inprogress_token = count($inprogress_tokens);
                    $last_token_count = $count_inprogress_token - 1;
                    $first_inc_id = $inprogress_tokens[$last_token_count]['id'];
                    $last_inc_id = $inprogress_tokens[0]['id'];

                    foreach ($inprogress_tokens as $key => $token_data) {
                        $insert_data = $this->get_insert_data($token_data);
                        if ($key == 0) {
                            $data = $this->db->insert('que_token_details', $insert_data);
                        } else {
                            $inc_id = $token_data['id'] + 1;
                            $this->db->where('id', $inc_id);
                            $data = $this->db->update('que_token_details', $insert_data);
                        }
                        if ($first_inc_id == $token_data['id']) {
                            $this->db->where('id', $token_data['id']);
                            $this->db->update('que_token_details', $insert_tranfer_data_queue);
                        }
                    }
                } else {
                    $data = $this->db->insert('que_token_details', $insert_tranfer_data_queue);
                }
            } else {
                $data = $this->db->insert('que_token_details', $insert_tranfer_data_queue);
            }
        }

        return $data;
    }

    function get_insert_data($transfer_token) {
        $insert_trans = [
            "category_id" => $transfer_token['category_id'],
            "counter_id" => $transfer_token['counter_id'],
            "emp_id" => $transfer_token['emp_id'],
            "token_number" => $transfer_token['token_number'],
            "token_status" => $transfer_token['token_status'],
            "remarks" => $transfer_token['remarks'],
            "tkn_intime" => $transfer_token['tkn_intime'],
            "tkn_outtime" => $transfer_token['tkn_outtime'],
            "processing_time" => $transfer_token['processing_time'],
            "created_date" => $transfer_token['created_date'],
            "updated_date" => $transfer_token['updated_date'],
        ];
        return $insert_trans;
    }

    function reassign_token($tokennum) {
        $datas = array();
        //$tokennum='SN-0013';
        //$status="Missed";
        $post_data = $this->input->post();
        $tokennum = $post_data['tokennum'];
        $status = $post_data['status'];
        $data = $this->admincounter_model->search_token($tokennum, $status);

        if ($data == 1) {
            //get_firstand_last_inc_id
            $hold_token = $this->admincounter_model->get_search_token($tokennum, $status);
            $re_tkn_id = $hold_token[0]['id'];
            $re_tkn_status = $hold_token[0]['token_status'];
            $re_tkn_num = $hold_token[0]['token_number'];
            if ($re_tkn_status == 'Hold') {
                $this->admincounter_model->update_hold_reassign($re_tkn_id, $re_tkn_status, $re_tkn_num);
            }
            if ($re_tkn_status == 'Missed') {
                $this->admincounter_model->update_missed_reassign($re_tkn_id, $re_tkn_status, $re_tkn_num);
            }
            if (!empty($hold_token)) {
                $first_inc_id = $hold_token[0]['id'];
                $get_last_ic_details = $this->admincounter_model->get_last_inc_details($first_inc_id, $hold_token[0]['counter_id'], $status);
            }
            $insert_data = [
                "category_id" => $hold_token[0]['category_id'],
                "counter_id" => $hold_token[0]['counter_id'],
                "emp_id" => $hold_token[0]['emp_id'],
                "token_number" => $hold_token[0]['token_number'],
                "token_status" => '',
                "remarks" => '',
                "tkn_intime" => '',
                "tkn_outtime" => '',
                "que_start_time" => date('H:i:s'),
                "created_date" => date('Y-m-d H:i:s'),
                "updated_date" => date('Y-m-d H:i:s'),
            ];

            if ($get_last_ic_details == 0) {
                $insert_data['tkn_intime'] = date('H:i:s');
                $insert_data['que_total_waiting_time'] = "00:00:00";
                $this->db->insert('que_token_details', $insert_data);
            } else {

                $count_inprogress_token = count($get_last_ic_details);
                $last_token_count = $count_inprogress_token - 1;
                $last_inc_id = $get_last_ic_details[$last_token_count]['id'];
                //check_record_exists
                $check_record_exists = $this->admincounter_model->check_record_exists($last_inc_id);
                if ($check_record_exists != 0) {
                    $count_inprogress_token = count($check_record_exists);
                    $last_token_count = $count_inprogress_token - 1;
                    $first_inc_id = $check_record_exists[$last_token_count]['id'];
                    $last_inc_id = $check_record_exists[0]['id'];
                    foreach ($check_record_exists as $key => $token_data) {
                        $exists_data = $this->get_insert_data($token_data);
                        if ($key == 0) {
                            $data = $this->db->insert('que_token_details', $exists_data);
                        } else {
                            $inc_id = $token_data['id'] + 1;
                            $this->db->where('id', $inc_id);
                            $data = $this->db->update('que_token_details', $exists_data);
                        }
                        if ($first_inc_id == $token_data['id']) {
                            $this->db->where('id', $token_data['id']);
                            $this->db->update('que_token_details', $insert_data);
                        }
                    }
                } else {
                    $this->db->insert('que_token_details', $insert_data);
                }
            }
        }

        echo json_encode($data);
    }

    function current_que_process() {
        $this->load->model('counterscreen/counterscreen_model');
        $result = $this->counterscreen_model->get_all_token();
        if ($result) {
            echo json_encode($result);
        } else {
            echo 0;
        }
    }

    function update_emp_status() {
        $emp_id = $this->input->post('emp_id');
        $emp_status = $this->input->post('emp_status');
        $counter_id = $this->input->post('counter_id');
        $data = $this->admincounter_model->update_emp_status($emp_status, $emp_id, $counter_id);
        // redirect($this->config->item('base_url') . 'counter/employee/' . $emp_id);
        echo $data;
    }

    function update_admin_emp_status($emp_id, $emp_status) {
        $data['chk_emp_counter'] = $this->admincounter_model->chk_emp_counter($emp_id);

        $data['update'] = $this->admincounter_model->update_admin_emp_status($emp_status, $emp_id);
        redirect($this->config->item('base_url') . 'counter/employee/' . $emp_id);
    }

    function insert_emp_idle_start_time() {
        $data = $this->input->post();
        $idle_start = $data['idle_start'];
        $log_data['user_id'] = $data['emp_id'];
        $log_data['user_type_id'] = 2;
        $log_data['log_type'] = 2;
        $log_data['log_in'] = $idle_start;
        $log_data['log_out'] = '';
        $log_data['device_name'] = $this->detectDevice();
        $ip = $this->input->ip_address();
        $log_data['ip_address'] = $ip;
        $insert = $this->db->insert('que_log_details', $log_data);
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

    function update_emp_idle_end_time() {
        $data = $this->input->post();

        $update_data['log_out'] = $data['idle_end'];
        $this->db->where('user_id', $data['emp_id']);
        $this->db->where('log_type', 2);
        $this->db->where('log_out', '0000-00-00 00:00:00');
        $data = $this->db->update('que_log_details', $update_data);
    }

    function login($id) {
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        if ($this->input->post()) {
            $client_id = $this->token_model->admin_login($username, $password);
        }
        if (isset($client_id) && $client_id != '') {
            $this->user_auth->create_autologin($client_id, $password);
            redirect($this->config->item('base_url') . 'counter/employee/' . $id);
        } else {
            $this->session->set_flashdata('flashError', 'Invalid User');
            redirect($this->config->item('base_url') . 'counter/employee/' . $id . '?login = fail');
        }
    }

}
