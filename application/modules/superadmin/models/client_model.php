

<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Client_model extends CI_Model {

    private $user_table = 'que_users';
    var $primaryTable = 'que_users tab_1';
    var $selectColumn = 'tab_1.*';
    var $column_order = array('tab_1.id', 'tab_1.user_id', 'CONCAT(tab_1.firstname, " ", tab_1.lastname)', 'tab_1.username', 'tab_1.email_address', 'tab_1.mobile_number', 'tab_1.status');
    var $column_search = array('tab_1.id', 'tab_1.user_id', 'CONCAT(tab_1.firstname, " ", tab_1.lastname)', 'tab_1.username', 'tab_1.email_address', 'tab_1.mobile_number', 'tab_1.status');
    var $order = array('tab_1.id' => 'desc ');

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function insert_client($data) {
        if ($this->db->insert($this->user_table, $data)) {
            $client_id = $this->db->insert_id();
            return $client_id;
        }
        return FALSE;
    }

    function update_client($data, $user_id) {
        $this->db->where('id', $user_id);
        if ($this->db->update($this->user_table, $data)) {

            return 1;
        }
        return 0;
    }

    function delete_client($id, $data) {
        $this->db->where('id', $id);
        if ($this->db->update($this->user_table, $data)) {
            return 1;
        }

        return 0;
    }

    function get_client_by_id($id) {
        $this->db->select('tab_1.*');
        $this->db->where('tab_1.id', $id);
        $this->db->where('tab_1.is_deleted', 0);
        $query = $this->db->get($this->user_table . ' AS tab_1');
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return NULL;
    }

    function is_user_available($username) {
        $this->db->select($this->user_table . '.id');
        $this->db->where($this->user_table . '.is_deleted', 0);
        $this->db->where($this->user_table . '.status', 1);
        $this->db->where('LCASE(username)', strtolower($username));
        $query = $this->db->get($this->user_table);
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }

        return NULL;
    }

    function is_email_address_available($email) {
        $this->db->select('tab_1.*');
        $this->db->where('LCASE(tab_1.email_address)', strtolower($email));
        $this->db->where('tab_1.status', 1);
        $this->db->where('tab_1.is_deleted', 0);
        $query = $this->db->get($this->user_table . ' AS tab_1');
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return 0;
    }

    function is_mobile_number_available($mobile) {
        $this->db->select('*');
        $this->db->where('mobile_number', $mobile);
        $this->db->where('status', 1);
        $this->db->where('is_deleted', 0);
        $query = $this->db->get($this->user_table);
        if ($query->num_rows > 0) {
            $res = $query->result_array();

            return $res;
        }
        return 0;
    }

    public function get_datatables($search_data) {
        $this->db->select('tab_1.*');

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
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $this->db->where('tab_1.is_deleted', 0);
        $this->db->where('tab_1.client_id', 0);

        $query = $this->db->get($this->user_table . ' AS tab_1');
        return $query->result();
    }

    public function count_all() {
        $this->db->where('is_deleted', 0);
        $this->db->where('tab_1.client_id', 0);
        $this->db->from($this->primaryTable);
        return $this->db->count_all_results();
    }

    public function count_filtered($search_data) {
        $this->db->select('tab_1.*');

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

        $this->db->where('tab_1.is_deleted', 0);
        $this->db->where('tab_1.client_id', 0);
        $query = $this->db->get($this->user_table . ' AS tab_1');
        return $query->num_rows();
    }

}
?>