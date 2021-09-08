<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Token_model extends CI_Model {

    private $increment_table = 'token_increment';
    private $que_token_details = 'que_token_details';
    private $que_category_type = 'que_category_type';
    private $que_assign_counter = 'que_assign_counter';
    private $que_counter = 'que_counter';
    private $que_users = 'que_users';
    private $que_employee = 'que_employee';
    private $que_feedback = 'que_feedback';
    private $prefix_list = array(
        'user_code' => 'TKN',
    );

    function __construct() {
        date_default_timezone_set('Asia/Kolkata');
        parent::__construct();
    }

    function get_increment_id($type) {
        $prefix = '';
        $prefix = date('y') . '/' . date('m');

        $this->db->where('type', $type);
        $this->db->where('prefix', $prefix);
        $query = $this->db->get($this->increment_table);
        if ($query->num_rows() == 0) {
            $this->insert_increment_id($type);
            $result = $this->get_new_increment_id($type);
        } else {
            $result = $query->result_array();
        }

        $entry_number = '';
        $entry_number = $result['0']['code'] . '/' . $result['0']['prefix'] . '-' . $result['0']['last_increment_id'];
        return $entry_number;
    }

    function get_new_increment_id($type) {
        $prefix = '';
        $prefix = date('y') . '/' . date('m');
        $this->db->where('type', $type);
        $this->db->where('prefix', $prefix);
        $new_query = $this->db->get($this->increment_table);
        $new_result = $new_query->result_array();
        return $new_result;
    }

    function get_all_category_type() {
        $this->db->select('que_category_type .*,que_category.sub_category');
//        $this->db->group_by('que_category.category_id');
//        $this->db->where('que_category.category_id !=', ' ');
        $this->db->group_by('que_category_type.id');
        $this->db->where('que_assign_counter.emp_id !=', ' ');
        $this->db->join('que_assign_counter', 'que_assign_counter.counter_id=que_category_type.counter_id', 'LEFT');
        $this->db->join('que_category', 'que_category.category_id=que_category_type.id', 'LEFT');
        $query = $this->db->get($this->que_category_type);
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return NULL;
    }

    function get_all_active_category($client_id) {

        $this->db->select('que_category_type .*');
        $this->db->where('que_category_type.status', 1);
        $this->db->where('que_category_type.client_id', $client_id);
        $query = $this->db->get($this->que_category_type);
        if ($query->num_rows() > 0) {
            $data = $query->result_array();

            foreach ($data as $key => $result) {
                $this->db->select('*');
                $this->db->where('category_id', $result['id']);
                $this->db->where('que_category.status', 1);
                $get_sub_category = $this->db->get('que_category')->result_array();
                if (!empty($get_sub_category)) {
                    $data[$key]['sub_category'] = $get_sub_category;
                } else {
                    $data[$key]['sub_category'] = '';
                }
            }

            return $data;
        }
        return NULL;
    }

    function get_counter_id($id) {
        $this->db->select('*');
        $this->db->where('category_id', $id);
        $query = $this->db->get($this->increment_table);
        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            $counter_id = $result[0]['counter_id'];
            $this->db->select('*');
            $this->db->where('counter_id', $counter_id);
            $data = $this->db->get($this->que_assign_counter)->num_rows();
        }
        return $data;

        return NULL;
    }

    function insert_increment_id($type) {
        $data = array();
        $data['prefix'] = '';
        $data['prefix'] = date('y') . '/' . date('m');
        $data['type'] = $type;
        $data['code'] = $this->prefix_list[$type];

        $data['last_increment_id'] = '001';
        if ($this->db->insert($this->increment_table, $data)) {
            $data['id'] = $this->db->insert_id();
            return $data;
        }
        return false;
    }

    function update_increment_id($type) {
        $prefix = '';
        $prefix = date('y') . '/' . date('m');
        $last_id = $this->get_increment_id($type);
        $inc_arr = explode('-', $last_id);
        $str = $inc_arr[1];
        $str = $str + 1;
        $str = sprintf('%1$03d', $str);
        $data = array();
        $data['last_increment_id'] = $str;
        $this->db->where('type', $type);
        $this->db->where('prefix', $prefix);
        if ($this->db->update($this->increment_table, $data)) {
            return true;
        }
        return false;
    }

    function get_increment_code($type) {
        $this->db->where('type', $type);
        $query = $this->db->get($this->increment_table);
        if ($query->num_rows() == 0) {
            $this->insert_increment_code($type);
            $result = $this->get_new_increment_code($type);
        } else {
            $result = $query->result_array();
        }
        $entry_number = '';
        $increment_id = str_pad($result['0']['last_increment_id'], 4, '0', STR_PAD_LEFT);
        $entry_number = $result['0']['code'] . '-' . $increment_id;
        return $entry_number;
    }

    function get_token_code($cat_id) {
        $this->db->select('token_increment.*,que_counter.counter_name,que_assign_counter.emp_id');
        $this->db->where('token_increment.category_id', $cat_id);
        $this->db->join($this->que_assign_counter, 'que_assign_counter.counter_id = token_increment.counter_id');
        $this->db->join($this->que_counter, 'que_counter.id = token_increment.counter_id');
        $counter_data = $this->db->get('token_increment')->result_array();

        $this->db->select('*');
        $date = date('Y-m-d');
        $this->db->where('category_id', $cat_id);
        $this->db->where('DATE_FORMAT(inc_date,"%Y-%m-%d") =', $date);
        $data = $this->db->get($this->increment_table)->result_array();

        $last_increment_id_result = array();
        if (count($data) > 0) {
            $last_id = $data[0]['last_increment_id'];
            $last_increment_id_result = $last_id;
        } else {
            $inc_date = date('Y-m-d H:i:s');
            $last_increment_id = 1;
            $update_data = array();
            $update_data = [
                "inc_date" => $inc_date,
                "last_increment_id" => $last_increment_id,
            ];

            $this->db->where('category_id', $cat_id);
            $list = $this->db->update($this->increment_table, $update_data);
            $last_increment_id_result = $last_increment_id;
        }

        $increment_id = str_pad($last_increment_id_result, 4, '0', STR_PAD_LEFT);
        $entry_number = $counter_data['0']['code'] . $increment_id;
        $result = ["token_number" => $entry_number, "increment_number" => $last_increment_id_result, "token_id" => $counter_data[0]['id'], "counter_name" => $counter_data[0]['counter_name'], "counter_id" => $counter_data[0]['counter_id'], "emp_id" => $counter_data[0]['emp_id']];

        return $result;
    }

    function get_process_counter_by_cat($id) {

        $this->db->select('*');
        $query = $this->db->get('que_category_type')->result_array();
        foreach ($query as $key => $data) {
            $get_counters = explode(',', $data['counter_id']);
            if (in_array($id, $get_counters)) {
                $data_result = $query[$key];
                $token['cat_id'] = $data_result['id'];
                $token['counter_id'] = $get_counters[0];
                $token['counter_name'] = $this->get_counter_name($get_counters[0]);
                $token['emp_id'] = $this->get_emp_id_from_counter($get_counters[0]);

                return $token;
            }
        }
    }

    function get_counter_name($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('que_counter')->result_array();
        return $query[0]['counter_name'];
    }

    function get_emp_id_from_counter($id) {
        $this->db->where('counter_id', $id);
        $query = $this->db->get('que_assign_counter')->result_array();
        return $query[0]['emp_id'];
    }

    function get_emp_name($emp_id) {
        $this->db->select('*');
        $this->db->where('id', $emp_id);
        $data = $this->db->get('que_employee');
        if ($data->num_rows() > 0) {
            $result = $data->result_array();
            return $result['0']['emp_name'];
        }
        return FALSE;
    }

    function get_last_increment_code_id($cat_id) {
        $this->db->select('*');
//        $this->db->where('type', $type);
        $this->db->where('category_id', $cat_id);
        $query = $this->db->get($this->increment_table);

        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            return $result['0']['last_increment_id'];
        }
        return FALSE;
    }

    /*  function insert_token_details($data) {
      if ($this->db->insert_batch($this->que_token_details, $data)) {
      //            $this->db->order_by('que_token_details.id', 'desc');
      return true;
      }
      return FALSE;
      } */

    function update_missed_for_noentry_tkns($counter_id) {
        $this->db->select('*');
        $this->db->where('counter_id', $counter_id);
        $this->db->where('token_status', '');
        $this->db->where('que_token_details.created_date <', date('Y-m-d'));
        $token_details = $this->db->get('que_token_details')->result_array();

        if (!empty($token_details)) {
            foreach ($token_details as $key => $result) {
                $this->db->where('id', $result['id']);
                $this->db->update('que_token_details', ['token_status' => "Missed"]);
            }
        }
    }

    function insert_token_details($data) {

        $counter_id = $data['counter_id'];
        $emp_id = $data['emp_id'];
        $check_token = $this->check_token_exists_forcurrdate($counter_id, $data, $emp_id);

        $data['que_start_time'] = date('H:i:s');

        if ($check_token == 1) {
            $data['tkn_intime'] = date('H:i:s');
            $data['que_total_waiting_time'] = date('H:i:s');

            $data['que_total_waiting_time'] = "00:00:00";
        }


        $this->db->insert('que_token_details', $data);
        $insert_id = $this->db->insert_id();
        if ($insert_id) {

            return true;
        } else {
            return false;
        }
    }

    function insert_transfer_data($counter_name, $token_number, $client_id) {
        $this->db->select('id');
        $this->db->where('counter_name', $counter_name);
        $this->db->where('status', 1);
        $this->db->where('client_id', $client_id);
        $counter_details = $this->db->get('que_counter')->result_array();

        $this->db->select('id');
        $this->db->where('counter_id', $counter_details[0]['id']);
        $this->db->where('status', 1);
        $cat_details = $this->db->get('que_category_type')->result_array();


        $this->db->select('emp_id');
        $this->db->where('counter_id', $counter_details[0]['id']);
        $this->db->where('status', 1);
        $emp_assign_counter_details = $this->db->get('que_assign_counter')->result_array();

        if ($cat_details[0]['id'] != "")
            $cat_id = $cat_details[0]['id'];
        else
            $cat_id = 0;

        $data['category_id'] = $cat_id;
        $data['counter_id'] = $counter_details[0]['id'];
        $data['emp_id'] = $emp_assign_counter_details[0]['emp_id'];
        $data['token_number'] = $token_number;
        $data['token_status'] = '';


        $this->insert_token_details($data);
    }

    function check_token_exists_forcurrdate($counter_id, $data, $emp_id) {

        //check_emp_active
        $this->db->select('emp_status');
        $this->db->where('counter_id', $counter_id);
        $this->db->where('emp_id', $emp_id);
        $get_emp_status = $this->db->get('que_assign_counter')->result_array();

        if ($get_emp_status[0]['emp_status'] == 1) {
            $this->db->select('*');
            $this->db->where('counter_id', $counter_id);
            $this->db->where('DATE_FORMAT(que_token_details.created_date,"%Y-%m-%d")', date('Y-m-d'));
            $token_details = $this->db->get('que_token_details');
            if ($token_details->num_rows() == 0) {
                return 1;
            } else {
                $this->db->select('*');
                $this->db->where('token_status', '');
                $this->db->where('counter_id', $counter_id);
                $this->db->where('DATE_FORMAT(que_token_details.created_date,"%Y-%m-%d")', date('Y-m-d'));
                $token_details_check = $this->db->get('que_token_details');
                if ($token_details_check->num_rows() == 0) {
                    return 1;
                }
            }
        } else {
            return 0;
        }
    }

    function get_first_token($cat_id) {
        $this->db->select('*');
        $this->db->limit(1);
        $this->db->where('category_id', $cat_id);
        $this->db->where('DATE_FORMAT(que_token_details.created_date,"%Y-%m-%d")', date('Y-m-d'));
        $query = $this->db->get('que_token_details')->result_array();

        $result = $query[0]['id'];
        return $result;
    }

    function get_first_token_date($cat_id) {
        $this->db->select('*');
        $this->db->limit(1);
        $this->db->where('category_id', $cat_id);
//        $this->db->order_by('id', 'desc');
        $this->db->where('DATE_FORMAT(que_token_details.created_date,"%Y-%m-%d")', date('Y-m-d'));
        $query = $this->db->get('que_token_details')->result_array();

        $result = $query[0]['created_date'];
        return $result;
    }

    function update_intime($first_id, $date) {
        $this->db->set('tkn_intime', $date);
        $this->db->where('id', $first_id);
        if ($this->db->update($this->que_token_details)) {

            return 1;
        }
        return 0;
    }

    function get_new_increment_code($type) {
        $this->db->where('type', $type);
        $query = $this->db->get($this->increment_table);
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return NULL;
    }

    function insert_increment_code($type) {
        $data = array();
        $data['type'] = $type;
        $data['code'] = $this->prefix_list[$type];
        $data['last_increment_id'] = 1;
        $this->db->where('type', $type);
        if ($this->db->insert($this->increment_table, $data)) {
            return true;
        }
        return false;
    }

    function update_increment_code($cat_id) {
        $last_id = $this->get_last_increment_code_id($cat_id);
        $data = array();
        $data['last_increment_id'] = $last_id + 1;
        $this->db->where('category_id', $cat_id);
        if ($this->db->update($this->increment_table, $data)) {

            return true;
        }
        return false;
    }

    function get_company_name($user_id) {
        $this->db->select('*');
        $this->db->where('id', $user_id);
        $query = $this->db->get($this->que_users);

        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            return ucfirst($result[0]['company_name']);
        }
        return NULL;
    }

    function insert_feedback($data) {

        $this->db->insert('que_feedback', $data);
        $query = $this->db->insert_id();

        return $query;
    }

    function get_all_catagory($id) {
        $this->db->select('que_category_type .*');
        $this->db->where('que_category_type.id', $id);
        $query = $this->db->get($this->que_category_type);
        if ($query->num_rows() > 0) {

            $data = $query->result_array();

            // $explode_data=explode(',',$data[0]['counter_id']);
            $this->db->where('que_assign_counter.counter_id', $data[0]['counter_id']);
            $this->db->where('que_assign_counter.emp_id !=', ' ');
            $que_assign = $this->db->get('que_assign_counter')->result_array();

            if (!empty($que_assign))
                return $data;
            else
                return NULL;
        }
        return NULL;
    }

    function admin_login($username, $password) {
        $this->db->select('*');
        $this->db->where('username', $username);
        $this->db->where('password', md5($password));
        $this->db->where('is_deleted', 0);
        $this->db->where('status', 1);
        $this->db->where('DATE_FORMAT(expire_date,"%Y-%m-%d") >=', date('Y-m-d'));
        $query = $this->db->get('que_users')->result_array();
        foreach ($query as $check) {

            $client_id = $check['id'];
        }

        return $client_id;
    }

}
