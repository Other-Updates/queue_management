<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Superadmin_model extends CI_Model {

    private $superadmin_table = 'que_superadmin';

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function get_superadmin_by_login($username, $password) {
        $password = md5($password);
        $this->db->select('tab_1.*');
        $this->db->where('password = ', $password);
        $where = '(LOWER(tab_1.username) = "' . strtolower($username) . '" OR LOWER(tab_1.email_address) = "' . strtolower($username) . '")';
        $this->db->where($where);
        $this->db->where('tab_1.status', 1);
        $this->db->where('tab_1.is_deleted', 0);
        $this->db->group_by('tab_1.id');
        $query = $this->db->get($this->superadmin_table . ' AS tab_1');

        if ($query->num_rows() == 1) {
            return $query->row();
        }

        return NULL;
    }

    function get_superadmin_by_id($user_id) {
        $this->db->select('tab_1.*');
        $this->db->where('tab_1.id', $user_id);
        $query = $this->db->get($this->superadmin_table . ' AS tab_1');
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }

        return NULL;
    }

    function update_superadmin($data, $user_id) {
        $this->db->where('id', $user_id);
        if ($this->db->update($this->superadmin_table, $data)) {
            return TRUE;
        }

        return FALSE;
    }

    function is_email_address_available($email, $id = NULL) {
        $this->db->select($this->superadmin_table . '.id');
        $this->db->where($this->superadmin_table . '.is_deleted', 0);
        $this->db->where($this->superadmin_table . '.status', 1);
        $this->db->where('LCASE(email_address)', strtolower($email));
        $query = $this->db->get($this->superadmin_table);
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return NULL;
    }

    function is_mobile_number_available($mobile) {
        $this->db->select($this->superadmin_table . '.id');
        $this->db->where($this->superadmin_table . '.is_deleted', 0);
        $this->db->where($this->superadmin_table . '.status', 1);
        $this->db->where('LCASE(mobile_number)', strtolower($mobile));
        $query = $this->db->get($this->superadmin_table);
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }

        return NULL;
    }

    function is_user_available($username) {
        $this->db->select($this->superadmin_table . '.id');
        $this->db->where($this->superadmin_table . '.is_deleted', 0);
        $this->db->where($this->superadmin_table . '.status', 1);
        $this->db->where('LCASE(username)', strtolower($username));
        $query = $this->db->get($this->superadmin_table);
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }

        return NULL;
    }

    function insert_super_admin($data) {
        if ($this->db->insert($this->superadmin_table, $data)) {
            $user_id = $this->db->insert_id();
            return $user_id;
        }
        return FALSE;
    }

}
