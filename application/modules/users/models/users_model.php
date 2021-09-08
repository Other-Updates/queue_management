<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Users_model extends CI_Model {

    private $que_users = 'que_users';
    private $user_type_table = 'que_user_types';

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function insert_user($data) {
        $data['password'] = md5($data['password']);
        if ($this->db->insert($this->que_users, $data)) {
            $user_id = $this->db->insert_id();
            return $user_id;
        }
        return FALSE;
    }

    function update_user($data, $user_id) {
        if (empty($data['password'])) {
            unset($data['password']);
        } else {
            $data['password'] = md5($data['password']);
        }
        $data['updated_date'] = date('Y-m-d H:i:s');
        $this->db->where('id', $user_id);
        if ($this->db->update($this->que_users, $data)) {
            return TRUE;
        }
        return FALSE;
    }

    function delete_user($id, $data) {
        $this->db->where('id', $id);
        if ($this->db->update($this->que_users, $data)) {
            return 1;
        }
        return 0;
    }

    function reset_password($user, $user_id) {
        $id = base64_decode(urldecode($user_id));
        $this->db->where('id', $id);
        if ($this->db->update($this->que_users, $user)) {
            return TRUE;
        }
        return FALSE;
    }

    function get_all_users($client_id) {
        $this->db->select('tab_1.*, tab_2.id AS user_type_id, tab_2.user_type_name');
        $this->db->where('tab_1.client_id', $client_id);
        $this->db->where('tab_1.is_deleted', 0);
        $this->db->join($this->user_type_table . ' AS tab_2', 'tab_2.id = tab_1.user_type_id', 'LEFT');
        $query = $this->db->get($this->que_users . ' AS tab_1');
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return NULL;
    }

    function get_users_by_user_type($user_type_id) {
        $this->db->select('tab_1.*, tab_2.id AS user_type_id, tab_2.user_type_name');
        $this->db->join($this->user_type_table . ' AS tab_2', 'tab_2.id = tab_1.user_type_id', 'LEFT');
        $this->db->where('tab_1.user_type_id', $user_type_id);
        $this->db->where('tab_1.is_deleted', 0);
        $query = $this->db->get($this->que_users . ' AS tab_1');
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return NULL;
    }

    function get_username_by_id($user_id) {
        $this->db->select('CONCAT_WS(" ", firstname, lastname) AS name', FALSE);
        $this->db->where('tab_1.id', $user_id);
        $this->db->where('tab_1.is_deleted', 0);
        $query = $this->db->get($this->que_users . ' AS tab_1');
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return NULL;
    }

    function get_user_by_id($user_id) {
        $this->db->select('tab_1.*, tab_2.id AS user_type_id, tab_2.user_type_name');
        $this->db->join($this->user_type_table . ' AS tab_2', 'tab_2.id = tab_1.user_type_id', 'LEFT');
        $this->db->where('tab_1.id', $user_id);
        $this->db->where('tab_1.is_deleted', 0);
        $query = $this->db->get($this->que_users . ' AS tab_1');
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return NULL;
    }

    function is_user_available($username, $id = NULL) {
        $this->db->select($this->que_users . '.id');
        $this->db->where('LCASE(username)', strtolower($username));
        if (!empty($id))
            $this->db->where('id !=', $id);
        $this->db->where('is_deleted', 0);
        $query = $this->db->get($this->que_users);
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return NULL;
    }

    function is_email_address_available($email, $id = NULL) {
        $this->db->select($this->que_users . '.id');
        $this->db->where('LCASE(email_address)', strtolower($email));
        if (!empty($id))
            $this->db->where('id !=', $id);
        $this->db->where('is_deleted', 0);
        $query = $this->db->get($this->que_users);
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return NULL;
    }

    function is_mobile_number_available($mobile, $id = NULL) {
        $this->db->select($this->que_users . '.id');
        $this->db->where('LCASE(mobile_number)', strtolower($mobile));
        if (!empty($id))
            $this->db->where('id !=', $id);
        $this->db->where('is_deleted', 0);
        $query = $this->db->get($this->que_users);
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return NULL;
    }

    function get_user_by_login($username, $password) {
        $password = md5($password);
        $this->db->select('tab_1.*, tab_2.id AS user_type_id, tab_2.user_type_name');
        $this->db->join($this->user_type_table . ' AS tab_2', 'tab_2.id = tab_1.user_type_id', 'LEFT');
        $this->db->where('password = ', $password);
        $where = '(LOWER(username) = "' . strtolower($username) . '" OR LOWER(tab_1.email_address) = "' . strtolower($username) . '")';
        $this->db->where($where);
        $this->db->where('tab_1.status', 1);
        $this->db->where('tab_1.is_deleted', 0);
        $this->db->group_by('tab_1.id');
        $query = $this->db->get($this->que_users . ' AS tab_1');

        if ($query->num_rows() == 1) {
            return $query->row();
        }
        return NULL;
    }

    function get_last_5_users() {
        $this->db->select($this->que_users . '.*');
        $this->db->order_by($this->que_users . '.id', 'desc');
        $this->db->limit(5);
        $this->db->where('is_deleted', 0);
        $query = $this->db->get($this->que_users);
        if ($query->num_rows() >= 1) {
            return $query->result_array();
        }
        return false;
    }

    function get_increment_id() {
        $this->db->select($this->increment_table . '.*');
        $query = $this->db->get($this->increment_table);
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return NULL;
    }

    function update_increment_table($data) {
        if ($this->db->update($this->increment_table, $data)) {
            return TRUE;
        }
        return FALSE;
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

            $usercheck = $check['user_type_id'];
        }

        return $usercheck;
    }

    function check_admin_login($username, $password) {
        $this->db->select('*');
        $this->db->where('username', $username);
        $this->db->where('password', md5($password));
        $this->db->where('is_deleted', 0);
        $this->db->where('status', 1);
        $query = $this->db->get('que_users')->result_array();
        foreach ($query as $check) {

            $usercheck['user_type_id'] = $check['user_type_id'];
            $usercheck['expire_date'] = $check['expire_date'];
        }

        return $usercheck;
    }

    function get_increment_code_based_client($client_id) {
        $this->db->where('client_id', $client_id);
        $query = $this->db->get('que_users');
        if ($query->num_rows() > 0) {
            $COUNT = $query->num_rows();
            $inc_count = $COUNT + 1;
            $increment_id = str_pad($inc_count, 4, '0', STR_PAD_LEFT);
            $entry_number = 'USER' . '-' . $increment_id;
        } else {
            $increment_id = str_pad(1, 4, '0', STR_PAD_LEFT);
            $entry_number = 'USER' . '-' . $increment_id;
        }
        return $entry_number;
    }

}
