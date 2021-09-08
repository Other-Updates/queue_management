<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Advertisement_model extends CI_Model {

    private $advertisement_table = 'que_advertisement';
    private $add_details_table = 'que_add_details';

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function insert_add_data($data) {
        if ($this->db->insert($this->advertisement_table, $data)) {
            $insert_id = $this->db->insert_id();
            return $insert_id;
        }
        return FALSE;
    }

    function update_add_data($data, $id) {
        $this->db->where('id', $id);
        if ($this->db->update($this->advertisement_table, $data)) {
            return TRUE;
        }
        return FALSE;
    }

    function insert_add_details($data) {
        if ($this->db->insert($this->add_details_table, $data)) {
            $insert_id = $this->db->insert_id();
            return $insert_id;
        }
        return FALSE;
    }

    function delete_add_details($id) {
        $this->db->where('add_id', $id);
        if ($this->db->delete($this->add_details_table)) {

            return 1;
        }
        return 0;
    }

    function update_category($data, $id) {
        $data['updated_date'] = date('Y-m-d H:i:s');
        $this->db->where('id', $id);
        if ($this->db->update($this->que_category, $data)) {
            return TRUE;
        }
        return FALSE;
    }

    function delete_add($id) {
        $this->db->where('id', $id);
        if ($this->db->update($this->advertisement_table, ['is_deleted' => 1])) {
            return 1;
        }
        return 0;
    }

    function get_category_details_id($id) {
        $this->db->select($this->que_category . '.*');
        $this->db->where($this->que_category . '.id', $id);
        $query = $this->db->get($this->que_category);
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return NULL;
    }

    function is_add_name_exists($add_name, $client_id) {
        $this->db->select($this->advertisement_table . '.*');
        $this->db->where($this->advertisement_table . '.client_id', $client_id);
        $this->db->where('LCASE(name)', strtolower($name));
        $query = $this->db->get($this->advertisement_table);

        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return 0;
    }

    function get_all_add($client_id) {
        $this->db->select($this->advertisement_table . '.*');
        $this->db->where($this->advertisement_table . '.is_deleted', 0);
        $this->db->where($this->advertisement_table . '.client_id', $client_id);
        $this->db->order_by('id', DESC);
        $query = $this->db->get($this->advertisement_table);
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return NULL;
    }

    function get_add_by_id($id) {
        $this->db->select($this->advertisement_table . ".*");
        $this->db->where($this->advertisement_table . '.id', $id);
        $this->db->where($this->advertisement_table . '.is_deleted', 0);
        $this->db->where($this->advertisement_table . '.status', 1);
        $query = $this->db->get($this->advertisement_table);

        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return NULL;
    }

    function get_add_details_by_id($id, $type) {
        $this->db->select($this->add_details_table . ".*");
        $this->db->where($this->add_details_table . '.add_id', $id);
        $this->db->where($this->add_details_table . '.is_deleted', 0);
        $this->db->where($this->add_details_table . '.status', 1);
        $query = $this->db->get($this->add_details_table);

        if ($query->num_rows() > 0) {
            $add_details = $query->result_array();
            foreach ($add_details as $key => $data) {
                if ($type == 1)
                    $add_img = 'attachments/advertisements/images/' . $data['add_data'];
                if ($type == 2)
                    $add_img = 'attachments/advertisements/videos/' . $data['add_data'];

                $add_details[$key]['add_img'] = base_url() . $add_img;
            }
            return $add_details;
        }
        return NULL;
    }

}

?>