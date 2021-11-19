<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Counter_model extends CI_Model
{

    private $table_name = 'que_counter';

    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    function insert_counter($data)
    {
        if ($this->db->insert($this->table_name, $data)) {
            $insert_id = $this->db->insert_id();
            return $insert_id;
        }
        return FALSE;
    }

    function update_counter($data, $id)
    {

        $this->db->where('id', $id);
        if ($this->db->update($this->table_name, $data)) {
            return TRUE;
        }
        return FALSE;
    }

    function get_all_counter($client_id)
    {
        $this->db->select($this->table_name . '.*');
        $this->db->where('status', 1);
        $this->db->where('is_deleted', 0);
        $this->db->where('client_id', $client_id);
        $query = $this->db->get($this->table_name);
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return NULL;
    }

    function delete_counter($id)
    {
        $this->db->where('id', $id);
        if ($this->db->delete($this->table_name)) {
            return 1;
        }
        return 0;
    }

    function get_all_edit_counters_for_employee($id, $client_id)
    {
        $this->db->select('que_counter.*');
        $this->db->where('que_counter.is_deleted', 0);
        $this->db->where('que_category_type.status', 1);
        //        $this->db->where('que_counter.client_id', $client_id);
        $this->db->join('que_category_type', 'que_counter.id=que_category_type.counter_id', 'LEFT');
        $query = $this->db->get('que_counter');
        if ($query->num_rows() > 0) {
            $data = $query->result_array();
            $results = '';
            foreach ($data as $result) {
                $this->db->where('que_assign_counter.counter_id', $result['id']);
                $this->db->where('que_assign_counter.id !=', $id);
                $datas = $this->db->get('que_assign_counter');
                if ($datas->num_rows() == 0) {
                    $results[] = $result;
                }
            }
            return $results;
        }
        return false;
    }

    function get_counter_by_id($id)
    {
        $this->db->select($this->table_name . '.*');
        $this->db->where($this->table_name . '.id', $id);
        $this->db->where($this->table_name . '.is_deleted', 0);
        $query = $this->db->get($this->table_name);
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return NULL;
    }

    function get_all_counters($client_id)
    {
        $this->db->select($this->table_name . '.*');
        $this->db->where($this->table_name . '.is_deleted', 0);
        $this->db->where($this->table_name . '.client_id', $client_id);
        $query = $this->db->get($this->table_name);
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return NULL;
    }

    function is_counter_name_available($counter_name, $client_id)
    {
        $this->db->select($this->table_name . '.id');
        $this->db->where('LCASE(counter_name)', strtolower($counter_name));
        $this->db->where($this->table_name . '.is_deleted', 0);
        $this->db->where($this->table_name . '.client_id', $client_id);
        $query = $this->db->get($this->table_name);
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return NULL;
    }
}
