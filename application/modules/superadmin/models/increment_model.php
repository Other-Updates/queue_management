<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Increment_model extends CI_Model {

    private $increment_table = 'que_increment';
    private $prefix_list = array(
        'client_code' => 'CLIENT',
    );

    function __construct() {
        date_default_timezone_set('Asia/Kolkata');
        parent::__construct();
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

    function get_new_increment_code($type) {
        $this->db->where('type', $type);
        $query = $this->db->get($this->increment_table);
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return NULL;
    }

    function get_last_increment_code_id($type) {
        $this->db->where('type', $type);
        $query = $this->db->get($this->increment_table);
        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            return $result['0']['last_increment_id'];
        }
        return FALSE;
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

    function update_increment_code($type) {
        $last_id = $this->get_last_increment_code_id($type);
        $data = array();
        $data['last_increment_id'] = $last_id + 1;
        $this->db->where('type', $type);
        if ($this->db->update($this->increment_table, $data)) {
            return true;
        }

        return false;
    }

}
