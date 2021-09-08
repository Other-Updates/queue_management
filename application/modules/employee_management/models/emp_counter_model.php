<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Emp_counter_model extends CI_Model {

    private $que_assign_counter = 'que_assign_counter';
    private $que_counter = 'que_counter';
    private $que_employee = 'que_employee';

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function insert_emp_counter($data) {
        if ($this->db->insert($this->que_assign_counter, $data)) {
            $insert_id = $this->db->insert_id();
            return $insert_id;
        }
        return FALSE;
    }

    function update_emp_counter($data, $id) {

        $this->db->where('id', $id);
        if ($this->db->update($this->que_assign_counter, $data)) {
            return TRUE;
        }
        return FALSE;
    }

    function delete_counter($id) {
        $this->db->where('id', $id);
        if ($this->db->delete($this->que_assign_counter)) {
            return 1;
        }
        return 0;
    }

    function get_all_counters() {
        $this->db->select('que_counter.*');
        $this->db->where('que_counter.is_deleted', 0);
        $this->db->where('que_category_type.status', 1);
        $this->db->join('que_category_type', 'que_counter.id=que_category_type.counter_id', 'LEFT');
        $query = $this->db->get('que_counter');
        if ($query->num_rows() > 0) {
            $data = $query->result_array();
            $results = '';
            foreach ($data as $result) {
                $this->db->where('que_assign_counter.counter_id', $result['id']);
                $datas = $this->db->get('que_assign_counter');
                if ($datas->num_rows() == 0) {
                    $results[] = $result;
                }
            }
            return $results;
        }
        return false;
    }

    function get_all_active_counters($client_id) {
        $this->db->select('que_counter.*');
        $this->db->where('que_counter.is_deleted', 0);
        $this->db->where('que_counter.status', 1);
        $this->db->where('que_counter.client_id', $client_id);
        $query = $this->db->get('que_counter');
        if ($query->num_rows() > 0) {
            $data = $query->result_array();


            return $data;
        }
        return false;
    }

    function get_all_employee($client_id) {
        $this->db->select($this->que_employee . '.*');
        $this->db->where($this->que_employee . '.client_id', $client_id);
        $this->db->where($this->que_employee . '.status', 1);
        $query = $this->db->get($this->que_employee);
        if ($query->num_rows() > 0) {
            $data = $query->result_array();
            $results = '';
            foreach ($data as $result) {
                $this->db->where('que_assign_counter.emp_id', $result['id']);
                $datas = $this->db->get('que_assign_counter');
                if ($datas->num_rows() == 0) {
                    $results[] = $result;
                }
            }
            return $results;
        }
        return false;
    }

    function get_counter_by_id($id) {
        $this->db->select('que_assign_counter .*, que_counter.counter_name,que_employee.emp_name');
        $this->db->where('que_assign_counter' . '.id', $id);
        $this->db->join('que_counter', 'que_counter.id=que_assign_counter.counter_id', 'LEFT');
        $this->db->join('que_employee', 'que_employee.id=que_assign_counter.emp_id', 'LEFT');
        $this->db->where('que_assign_counter' . '.is_deleted', 0);
        $query = $this->db->get('que_assign_counter');
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return NULL;
    }

    function get_all_assigned_counters($client_id) {
        $this->db->select('que_assign_counter.*,que_counter.counter_name,que_employee.emp_name');
        $this->db->join('que_counter', 'que_counter.id=que_assign_counter.counter_id', 'LEFT');
        $this->db->join('que_employee', 'que_employee.id=que_assign_counter.emp_id', 'LEFT');
        $this->db->where('que_employee' . '.client_id', $client_id);
        $this->db->order_by('id', DESC);
        $query = $this->db->get('que_assign_counter');
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return NULL;
    }

    function is_counter_name_available($counter_id) {
        $this->db->select($this->que_assign_counter . '.id');
        $this->db->where($this->que_assign_counter . '.counter_id', $counter_id);
        $this->db->where($this->que_assign_counter . '.is_deleted', 0);

        $query = $this->db->get($this->que_assign_counter);
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return 0;
    }

}
