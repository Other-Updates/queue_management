<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Dashboard_model extends CI_Model {

    private $users_table = 'que_users';

    function __construct() {
        $this->load->database();
        parent::__construct();
    }

    function get_total_clients() {
        $this->db->select('tab_1.*');
        $this->db->where('tab_1.status', 1);
        $this->db->where('tab_1.is_deleted', 0);
        $this->db->where('tab_1.is_admin', 1);
        $query = $this->db->get($this->users_table . ' AS tab_1');
        if ($query->num_rows > 0) {
            return $query->result_array();
        }
        return Null;
    }

    function get_all_clients() {
        $this->db->select('tab_1.*');
        $this->db->where('tab_1.is_deleted', 0);
        $this->db->where('tab_1.is_admin', 1);
        $this->db->order_by('id', 'desc');
        $this->db->limit(10);
        $query = $this->db->get($this->users_table . ' AS tab_1');
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return NULL;
    }

}

?>