<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admincounter_model extends CI_Model {

    private $que_token_details = 'que_token_details';
    private $que_assign_counter = 'que_assign_counter';
    private $que_employee = 'que_employee';
    private $que_manage_token = 'que_manage_token';
    private $que_counter = 'que_counter';
    var $selectColumn = 'que_token_details.*';
    var $column_order = array('que_token_details.id', 'que_token_details.token_number', 'que_token_details.token_status', 'que_token_details.remarks');
    var $column_search = array('que_token_details.id', 'que_token_details.token_number', 'que_token_details.token_status', 'que_token_details.remarks');
    var $order = array('que_token_details.id' => 'asc');

    function __construct() {
        date_default_timezone_set('Asia/Kolkata');
        parent::__construct();
    }

    public function get_all_token() {
        $this->db->select('*');
        $this->db->where('DATE_FORMAT(created_date,"%Y-%m-%d")', date('Y-m-d'));
        $query = $this->db->get('que_token_details');


        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return NULL;
    }

    function get_search_token($tokennum, $status) {
        $this->db->select('*');
        $this->db->where('token_number', $tokennum);
        $this->db->where('token_status', $status);
        $this->db->order_by('id', 'desc');
        $this->db->where('DATE_FORMAT(created_date,"%Y-%m-%d")', date('Y-m-d'));
        $query = $this->db->get('que_token_details');

        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return 0;
    }

    function update_hold_reassign($re_tkn_id, $re_tkn_status, $re_tkn_num) {

        $this->db->set('token_status', 'Hold-Reassign');
        $this->db->where('id', $re_tkn_id);
        $this->db->where('token_number', $re_tkn_num);
        $this->db->where('token_status', $re_tkn_status);
        if ($this->db->update($this->que_token_details)) {

            return 1;
        }
        return 0;
    }

    function update_missed_reassign($re_tkn_id, $re_tkn_status, $re_tkn_num) {
        $this->db->set('token_status', 'Missed-Reassign');
        $this->db->where('id', $re_tkn_id);
        $this->db->where('token_number', $re_tkn_num);
        $this->db->where('token_status', $re_tkn_status);
        if ($this->db->update($this->que_token_details)) {

            return 1;
        }
        return 0;
    }

    function insert_edit_employee($id) {
        $this->db->select('*');
        $this->db->where('id', $id);
        $que_tkn_details = $this->db->get('que_token_details')->result_array();
        if ($que_tkn_details) {
            $data = $this->get_insert_edit_tkn_details($que_tkn_details);

            //insert_edit_tkn
            $this->db->insert('que_edit_token_details', $data);

            return 1;
        } else {
            return false;
        }
    }

    function get_insert_edit_tkn_details($que_tkn_details) {

        $insert_edit_data_queue = [
            "tkn_detail_id" => $que_tkn_details[0]['id'],
            "category_id" => $que_tkn_details[0]['category_id'],
            "emp_id" => $que_tkn_details[0]['emp_id'],
            "counter_id" => $que_tkn_details[0]['counter_id'],
            "token_number" => $que_tkn_details[0]['token_number'],
            "token_status" => $que_tkn_details[0]['token_status'],
            "remarks" => $que_tkn_details[0]['remarks'],
            "transfer_counter_id" => $que_tkn_details[0]['transfer_counter_id'],
            "tkn_intime" => $que_tkn_details[0]['tkn_intime'],
            "tkn_outtime" => $que_tkn_details[0]['tkn_outtime'],
            "processing_time" => $que_tkn_details[0]['processing_time'],
            "created_date" => $que_tkn_details[0]['created_date'],
            "updated_date" => $que_tkn_details[0]['updated_date'],
        ];


        return $insert_edit_data_queue;
    }

    function update_edit_tkn($que_tkn_details) {
        $update_edit_data_queue = [
            "category_id" => $que_tkn_details[0]['category_id'],
            "emp_id" => $que_tkn_details[0]['emp_id'],
            "counter_id" => $que_tkn_details[0]['counter_id'],
            "token_number" => $que_tkn_details[0]['token_number'],
            "token_status" => $que_tkn_details[0]['token_status'],
            "remarks" => '',
            "transfer_counter_id" => '',
            "tkn_intime" => date('H:i:s'),
            "tkn_outtime" => '',
            "processing_time" => '',
            "created_date" => date('Y-m-d H:i:s'),
            "updated_date" => date('Y-m-d H:i:s'),
        ];
        $this->db->where('id', $que_tkn_details[0]['id']);
        $this->db->update('que_token_details', $update_edit_data_queue);
        return 1;
    }

    function get_missed_token($tokennum) {
        $this->db->select('*');
        $this->db->where('token_number', $tokennum);
        $this->db->where('token_status', 'Missed');
        $this->db->where('DATE_FORMAT(created_date,"%Y-%m-%d")', date('Y-m-d'));
        $query = $this->db->get('que_token_details');

        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return 0;
    }

    function get_intime($id) {
        $this->db->select('*');
        $this->db->where('id', $id);
        $this->db->where('DATE_FORMAT(que_token_details.created_date,"%Y-%m-%d")', date('Y-m-d'));
        $query = $this->db->get('que_token_details')->result_array();
        $result = $query[0]['tkn_intime'];
        return $result;
    }

    function get_hold_tkn_details($tkn_num) {
        $this->db->select('*');
        $this->db->where('token_number', $tkn_num);
        $this->db->where('DATE_FORMAT(created_date,"%Y-%m-%d")', date('Y-m-d'));
        $query = $this->db->get('hold_token_details');

        if ($query->num_rows() > 0) {
            $data = $query->result_array();
            $result = $data[0]['processing_time'];
        }
        return $result;
    }

    function insert_hold_token($insert_data) {
        $this->db->insert('hold_token_details', $insert_data);
    }

    function update_intime($update, $date) {
        $this->db->set('tkn_intime', $date);
        $this->db->where('id', $update);
        if ($this->db->update($this->que_token_details)) {

            return 1;
        }
        return 0;
    }

    function update_next_tkn_intime($id, $current_counter) {
        $this->db->where('counter_id', $current_counter);
        $this->db->where('id >', $id);
        $this->db->where('token_status', '');
        $check_process_tkn = $this->db->get('que_token_details')->result_array();
        if (count($check_process_tkn) > 0) {
            $process_tkn_id = $check_process_tkn[0]['id'];
            $this->db->where('id', $process_tkn_id);
            $total_time = $this->time_difference($check_process_tkn[0]['que_start_time'], date('H:i:s'));
            $this->db->update('que_token_details', ["tkn_intime" => date('H:i:s'), "que_total_waiting_time" => $total_time]);
            return true;
        }
    }

    function get_last_inc_details($id, $counter_id) {
        $this->db->where('id >', $id);
        $this->db->where('counter_id', $counter_id);
        $this->db->where('token_status', '');
        $this->db->limit(6);
        $get_inprogress_token = $this->db->get('que_token_details')->result_array();
        if ($get_inprogress_token) {
            return $get_inprogress_token;
        } else {
            return 0;
        }
    }

    function check_record_exists($id) {
        $this->db->where('id >', $id);
        $this->db->where('DATE_FORMAT(created_date,"%Y-%m-%d")', date('Y-m-d'));
        $this->db->order_by('id', 'desc');
        $query = $this->db->get('que_token_details')->result_array();
        if ($query) {
            return $query;
        } else {
            return 0;
        }
    }

    function get_last_inc_tranfer_counter($id, $counter_id) {
        $this->db->where('id >', $id);
        $this->db->where('counter_id', $counter_id);
        $this->db->where('token_status', '');
        $this->db->limit(6);
        $get_inprogress_token = $this->db->get('que_token_details')->result_array();
        if ($get_inprogress_token) {
            return $get_inprogress_token;
        } else {
            return "";
        }
    }

    function search_token($tokennum, $status) {
        $this->db->select('*');
        $this->db->where('token_number', $tokennum);
        $this->db->where('token_status', $status);
        $this->db->order_by('id', 'desc');
        $this->db->where('DATE_FORMAT(created_date,"%Y-%m-%d")', date('Y-m-d'));
        $query = $this->db->get('que_token_details');

        if ($query->num_rows() > 0) {
            $data = $query->result_array();
//            if ($data[0]['token_status'] == $status) {
            return 1;
//            }
        }
        return 0;
    }

    function search_missed_token($tokennum) {
        $this->db->select('*');
        $this->db->where('token_number', $tokennum);
        $this->db->where('token_status', 'Missed');
        $this->db->where('DATE_FORMAT(created_date,"%Y-%m-%d")', date('Y-m-d'));
        $query = $this->db->get('que_token_details');

        if ($query->num_rows() > 0) {
            return 1;
        }
        return 0;
    }

    function time_difference($in_time, $out_time) {
        $time1 = new DateTime($in_time);
        $time2 = new DateTime($out_time);
        $inter = $time2->diff($time1);
        $hours = $inter->h;
        if ($inter->h < 10) {
            $hours = "0" . $inter->h;
        }
        $mins = $inter->i;
        if ($inter->i < 10) {
            $mins = "0" . $inter->i;
        }
        $sec = $inter->s;
        if ($inter->s < 10) {
            $sec = "0" . $inter->s;
        }

        return $hours . ":" . $mins . ":" . $sec;
    }

    function update_status($data, $id, $current_counter) {
        $this->db->select('tkn_intime');
        $this->db->where('id', $id);
        $current_tkn_details = $this->db->get('que_token_details')->result_array();
        $total_time = "00:00:00";
        if ($current_tkn_details)
            $total_time = $this->time_difference($current_tkn_details[0]['tkn_intime'], date('H:i:s'));
        if ($data['token_status'] == "Hold")
            $remark = $data['hold'];
        else
            $remark = $data['remarks'];

        $update_status = [
            "token_status" => $data['token_status'],
            "updated_date" => date('Y-m-d H:i:s'),
            "tkn_outtime" => date('H:i:s'),
            "remarks" => $remark,
            "processing_time" => $total_time,
        ];

        $this->db->where('id', $id);
        $data = $this->db->update($this->que_token_details, $update_status);
        return $data;
    }

    function edit_update_status($data, $id, $current_counter) {
        $total_time = $this->time_difference($data['edit_in_time'], date('H:i:s'));
        if ($data['token_status'] == "Hold")
            $remark = $data['hold'];
        else
            $remark = $data['remarks'];
        $created_date = date('Y-m-d') . " " . $data['edit_in_time'];
        $update_status = [
            "token_status" => $data['token_status'],
            "updated_date" => date('Y-m-d H:i:s'),
            "created_date" => $created_date,
            "tkn_intime" => $data['edit_in_time'],
            "tkn_outtime" => date('H:i:s'),
            "remarks" => $remark,
            "processing_time" => $total_time,
        ];
        $this->db->where('id', $id);
        $this->db->update($this->que_token_details, $update_status);
        return 1;
    }

    function update_reassign_token($data, $id) {
        $this->db->where('id', $id);
        if ($this->db->update($this->que_token_details, $data)) {
            return 1;
        }
        return 0;
    }

    function get_username($id) {
        $this->db->select('*');
        $this->db->where('id', $id);
        $query = $this->db->get('que_employee')->result_array();
        return $query[0]['username'];
    }

    function get_all_empty_status($id) {

        $this->db->select('*');
        $this->db->where('emp_id', $id);
        $query = $this->db->get('que_assign_counter');
        if ($query->num_rows() > 0) {
            $data = $query->result_array();
            foreach ($data as $result) {
                $counter_id = $result['counter_id'];
                $this->db->select('*');
                $this->db->where('token_status', '');
                $this->db->where('counter_id', $counter_id);
                $this->db->where('DATE_FORMAT(created_date,"%Y-%m-%d")', date('Y-m-d'));
                $details = $this->db->get('que_token_details')->result_array();

                return $details;
            }
        }
    }

    function employee_login($username, $password, $status) {
        $this->db->select('*');
        $this->db->where('username', $username);
        $this->db->where('password', md5($password));
        $this->db->where('status', $status);
        $query = $this->db->get('que_employee');

        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return 0;
    }

    function search_data($counter_id, $search_data, $token_status) {
        $this->db->select('*');
        $this->db->where('counter_id', $counter_id);
        $this->db->where('DATE_FORMAT(created_date,"%Y-%m-%d")', date('Y-m-d'));

        if ($token_status == 0) {
            $this->db->where('token_status', ' ');
            $this->db->order_by('id', 'asc');
        } else {
            $this->db->where('token_status !=', '');
            $this->db->order_by('id', 'desc');
        }

        $i = 0;
        foreach ($this->column_search as $item) { // loop column
            if ($search_data['search']['value']) { // if datatable send POST for search
                if ($i === 0) { // first loop
                    $this->db->like($item, $search_data['search']['value']);
                } else {
                    $this->db->or_like($item, $search_data['search']['value']);
                }
            }
            $i++;
        }

        if (isset($_POST['order'])) {
            // $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order)) {
            //$order = $this->order;
            //$this->db->order_by(key($order), $order[key($order)]);
        }

        if (isset($_POST['length']) && $_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);


        // $this->db->order_by('id','asc');

        $query = $this->db->get($this->que_token_details);

        return $query;
    }

    function get_token_details_by_id($id, $search_data) {

        $counter_id = $this->get_counterid($id);
        if ($counter_id != '') {


            $query1 = $this->search_data($counter_id, $search_data, 0);
            $query2 = $this->search_data($counter_id, $search_data, 1);
            $details1 = $query1->result_array();
            $details2 = $query2->result_array();
            $details = array_merge($details1, $details2);

            foreach ($details as $key => $data) {
                if ($data['token_status'] == "Transfer" || $data['token_status'] == "") {
                    $details[$key]['is_edit'] = 0;
                }
                if ($data['token_status'] == "Success") {
                    $details[$key]['is_edit'] = 1;
                }

                if ($data['token_status'] == "Hold" || $data['token_status'] == "Missed") {

                    $this->db->where('id !=', $data['id']);
                    $this->db->where('token_number', $data['token_number']);
                    $this->db->where('counter_id', $data['counter_id']);
                    $this->db->where('DATE_FORMAT(created_date,"%Y-%m-%d")', date('Y-m-d'));
                    $result_exists = $this->db->get('que_token_details')->result_array();
                    $details[$key]['is_edits'] = $result_exists;
                    if (count($result_exists) == 0) {
                        $details[$key]['is_edit'] = 1;
                    } elseif (count($result_exists) > 1) {
                        $details[$key]['is_edit'] = 0;
                    } else {
                        if ($result_exists[0]['token_status'] == "Hold" || $result_exists[0]['token_status'] == "Missed") {
                            $details[$key]['is_edit'] = 1;
                        } else {
                            $details[$key]['is_edit'] = 0;
                        }
                    }
                }
            }

            return $details;
        }
    }

    function get_counterid($id) {
        $this->db->select('*');
        $this->db->where('emp_id', $id);
        $query = $this->db->get('que_assign_counter')->result_array();
        return $query[0]['counter_id'];
    }

    function get_emp_tkn_data($id) {
        $counter_id = $this->get_counterid($id);
        $this->db->select('*');
        $this->db->where('counter_id', $counter_id);
        $this->db->where('token_status', '');
        $this->db->where('DATE_FORMAT(created_date,"%Y-%m-%d")', date('Y-m-d'));
        $empty_tkn = $this->db->get('que_token_details')->result_array();

        $list['count_empty_tkn'] = count($empty_tkn);
        $list['empty_tkn_number'] = $empty_tkn[0]['token_number'];
        $list['empty_tkn_id'] = $empty_tkn[0]['id'];
        return $list;
    }

    function get_token($tokennum) {
        $this->db->select('*');
        $this->db->where('token_status', 'Hold');
        $this->db->where('token_number', $tokennum);
        $query = $this->db->get($this->que_token_details);


        if ($query->num_rows() > 0) {
            $data = $query->result_array();
            return $data;
        } else {
            return 0;
        }
    }

    function get_all_empty_token($cat_id) {
        $this->db->select('*');
        $this->db->where('category_id', $cat_id);
        $this->db->where('token_status', '');
        $this->db->limit('6');
        $this->db->order_by('id', desc);
        $this->db->where('DATE_FORMAT(created_date,"%Y-%m-%d")', date('Y-m-d'));

        $query = $this->db->get('que_token_details');

        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return 0;
    }

    function get_emp_id_from_assign_counter($id) {
        $this->db->select('emp_id');
        $this->db->where('counter_id', $id);
        $counter_data = $this->db->get('que_assign_counter')->result_array();
        if ($counter_data)
            return $counter_data[0]['emp_id'];
    }

    function insert_last_token($data) {
        if ($this->db->insert_batch($this->que_manage_token, $data)) {
            return true;
        }
        return FALSE;
    }

    function check_process_tokn($counter_id) {
        $this->db->where('counter_id', $counter_id);
        $this->db->where('token_status !=', '');
        $this->db->where('DATE_FORMAT(que_token_details.created_date,"%Y-%m-%d")', date('Y-m-d'));
        $query = $this->db->get('que_token_details');
        if ($query->num_rows() == 0)
            return 1;
        else
            return 0;
    }

    function get_counter($id) {
        $this->db->select('que_counter.*');
        $this->db->where('emp_id', $id);
        $this->db->join('que_counter', 'que_counter.id=que_assign_counter.counter_id');
        $query = $this->db->get('que_assign_counter')->result_array();

        foreach ($query as $key => $data) {
            $this->db->where('counter_id', $data['id']);
            $get_category_details = $this->db->get('que_category_type')->result_array();
            $query[$key]['category_name'] = $get_category_details[0]['category_type'];

            $explode_counter = explode('-', $data['counter_name']);
            $query[$key]['counter_space_name'] = $explode_counter[0] . " " . $explode_counter[1];
        }
        return $query;
    }

    function get_all_counter($id, $user_id) {
        $this->db->select('que_counter.counter_name');
        $this->db->where('que_assign_counter.emp_id', $id);
        $this->db->where('que_counter.client_id', $user_id);
        $this->db->join('que_counter', 'que_counter.id=que_assign_counter.counter_id');
        $query = $this->db->get('que_assign_counter');
//        $result = $query[0]['counter_name');

        if ($query->num_rows() > 0) {
            $result = $query->result_array();

            $name = $result[0]['counter_name'];

            $this->db->select($this->que_counter . '.*');
            $this->db->where('status', 1);
            $this->db->where("counter_name !=", $name);
            $counters = $this->db->get($this->que_counter)->result_array();
        }

        return $counters;
    }

    function get_counter_id($counter_name) {
        $this->db->where('counter_name', $counter_name);
        $counter_details = $this->db->get('que_counter')->result_array();
        if ($counter_details) {
            return $counter_details[0]['id'];
        }
    }

    function get_tranfer_token() {
        $this->db->select('que_token_details.*,que_counter.id AS trans_id');
//        $this->db->where('token_number', $tokennum);
        $this->db->where('que_token_details.token_status', 'Transfer');
        $this->db->join('que_counter', 'que_counter.counter_name=que_token_details.remarks');
        $this->db->where('DATE_FORMAT(que_token_details.created_date,"%Y-%m-%d")', date('Y-m-d'));
        $query = $this->db->get('que_token_details');



        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            $name = $result[0]['trans_id'];
        }
        return $name;
    }

    /*   function get_tranfer_token_details() {
      $this->db->select('que_token_details.*,que_counter.id AS trans_id');
      //        $this->db->where('token_number', $tokennum);
      $this->db->where('que_token_details.token_status', 'Transfer');
      $this->db->join('que_counter', 'que_counter.counter_name=que_token_details.remarks');
      $this->db->where('DATE_FORMAT(que_token_details.created_date,"%Y-%m-%d")', date('Y-m-d'));
      $query = $this->db->get('que_token_details');



      if ($query->num_rows() > 0) {
      $result = $query->result_array();
      $name = $result[0]['trans_id'];
      }
      return $result;
      }
     */

    function get_tranfer_token_details($counter_id, $token_number) {

        $this->db->where('token_number', $token_number);
        $this->db->where('token_status', 'Transfer');
        $this->db->order_by('id', 'desc');
        $this->db->where('DATE_FORMAT(que_token_details.created_date,"%Y-%m-%d")', date('Y-m-d'));
        $get_transfer_token = $this->db->get('que_token_details')->result_array();
        if ($get_transfer_token) {
            return $get_transfer_token;
        } else {
            return "";
        }
    }

    function get_transfer_counter($counter_id) {
        $this->db->select('*');
        $this->db->where('token_status', '');
        $this->db->where('DATE_FORMAT(que_token_details.created_date,"%Y-%m-%d")', date('Y-m-d'));
        $this->db->where('counter_id', $counter_id);
        $this->db->limit('6');
        $query = $this->db->get('que_token_details');
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return 0;
    }

    function get_last_insert_counter_details($id) {
        $this->db->where('id >', $id);
        $this->db->order_by('id', 'desc');
        $query = $this->db->get('que_token_details');
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return 0;
    }

    function get_employee_counter() {
        $this->db->select('que_counter.*');
        $this->db->join('que_counter', 'que_counter.id=que_assign_counter.counter_id');
        $query = $this->db->get('que_assign_counter');
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    function get_employee_active_counter($user_id) {
        $this->db->select('que_counter.*');
        $this->db->where('emp_status', 1);
        $this->db->where('que_counter.client_id', $user_id);
        $this->db->join('que_counter', 'que_counter.id=que_assign_counter.counter_id');
        $query = $this->db->get('que_assign_counter');
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    function check_counter_active($counter_name, $client_id) {
        $this->db->select('id');
        $this->db->where('counter_name', $counter_name);
        $this->db->where('status', 1);
        $this->db->where('client_id', $client_id);
        $counter_details = $this->db->get('que_counter')->result_array();
        $this->db->select('emp_status');
        $this->db->where('counter_id', $counter_details[0]['id']);
        $this->db->where('status', 1);
        $emp_assign_counter_details = $this->db->get('que_assign_counter')->result_array();

        if ($emp_assign_counter_details[0]['emp_status'] == 1)
            echo 1;
        else
            echo 0;
    }

    function get_all_emp_counter_details($id) {
        $this->db->select('*');
        $this->db->where('emp_id', $id);

        $query = $this->db->get('que_assign_counter');
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    function update_emp_status($emp_status, $emp_id, $counter_id) {

        $this->db->select('*');
        $this->db->where('counter_id', $counter_id);
        $this->db->where('emp_id', $emp_id);
        $this->db->where('token_status', ' ');
        if ($emp_status == 0) {
            $this->db->where('tkn_intime !=', ' ');
            $this->db->where('tkn_outtime', NULL);

            $update_data = ['tkn_intime' => ''];
        } else {
            $this->db->where('tkn_intime', '');
            $this->db->where('tkn_outtime', NULL);
            $this->db->or_where('tkn_intime', '00:00:00');
            $update_data = ['tkn_intime' => date('H:i:s')];
        }


        $this->db->where('DATE_FORMAT(que_token_details.created_date,"%Y-%m-%d")', date('Y-m-d'));
        $check_user_in_progress = $this->db->get('que_token_details')->result_array();

        foreach ($check_user_in_progress as $key => $data) {
            $this->db->where('id', $data['id']);
            $this->db->update('que_token_details', $update_data);
        }

        $this->db->set('emp_status', $emp_status);
        $this->db->where('emp_id', $emp_id);
        if ($this->db->update($this->que_assign_counter)) {

            return true;
        }
        return FALSE;
    }

    function chk_emp_counter($emp_id) {
        $this->db->select('*');
        $this->db->where('emp_id', $emp_id);
        $query = $this->db->get('que_assign_counter')->result_array();
        return $query[0]['counter_id'];
    }

    function get_emp_status($id) {
        $this->db->select('*');
        $this->db->where('emp_id', $id);
        $query = $this->db->get('que_assign_counter')->result_array();
        return $query[0]['emp_status'];
    }

}
