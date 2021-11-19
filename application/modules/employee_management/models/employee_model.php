<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Employee_model extends CI_Model
{

    private $que_employee = 'que_employee';

    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    function insert_employee($data)
    {
        $data['password'] = md5($data['password']);
        if ($this->db->insert($this->que_employee, $data)) {
            $user_id = $this->db->insert_id();
            return $user_id;
        }
        return FALSE;
    }

    function update_employee($data, $user_id)
    {
        if (empty($data['password'])) {
            unset($data['password']);
        } else {
            $data['password'] = md5($data['password']);
        }
        $data['updated_date'] = date('Y-m-d H:i:s');
        $this->db->where('id', $user_id);
        if ($this->db->update($this->que_employee, $data)) {
            return TRUE;
        }
        return FALSE;
    }

    function delete_employee($id)
    {
        $this->db->where('id', $id);
        if ($this->db->delete($this->que_employee)) {
            return 1;
        }
        return 0;
    }

    function reset_password($user, $user_id)
    {
        $id = base64_decode(urldecode($user_id));
        $this->db->where('id', $id);
        if ($this->db->update($this->que_employee, $user)) {
            return TRUE;
        }
        return FALSE;
    }

    function get_all_employee($client_id)
    {
        $this->db->select('tab_1.*');
        $this->db->order_by('tab_1.id', 'desc');
        $this->db->where('tab_1.client_id', $client_id);
        $query = $this->db->get($this->que_employee . ' AS tab_1');
        if ($query->num_rows() > 0) {
            $data = $query->result_array();

            foreach ($data as $key => $result) {
                $this->db->select('counter_id,emp_status');
                $this->db->where('emp_id', $result['id']);
                $get_emp_counter = $this->db->get('que_assign_counter')->result_array();
                $data[$key]['emp_status'] = "";
                $data[$key]['counter_name'] = "";
                if (!empty($get_emp_counter)) {
                    if ($get_emp_counter[0]['emp_status'] == 1)
                        $data[$key]['emp_status'] = "Working";
                    else
                        $data[$key]['emp_status'] = "Idle";

                    $this->db->select('counter_name');
                    $this->db->where('id', $get_emp_counter[0]['counter_id']);
                    $get_counter_name = $this->db->get('que_counter')->result_array();
                    $data[$key]['counter_name'] = $get_counter_name[0]['counter_name'];
                }
            }

            return $data;
        }

        return NULL;
    }

    function get_employee_by_id($id)
    {
        $this->db->select('tab_1.*');

        $this->db->where('tab_1.id', $id);
        $query = $this->db->get($this->que_employee . ' AS tab_1');
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return NULL;
    }

    function is_user_available($username, $id = NULL)
    {
        $this->db->select($this->que_employee . '.id');
        $this->db->where('LCASE(username)', strtolower($username));
        if (!empty($id))
            $this->db->where('id !=', $id);
        $query = $this->db->get($this->que_employee);
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return NULL;
    }

    function is_email_address_available($email, $id = NULL)
    {
        $this->db->select($this->que_employee . '.id');
        $this->db->where('LCASE(email_address)', strtolower($email));
        if (!empty($id))
            $this->db->where('id !=', $id);
        $query = $this->db->get($this->que_employee);
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return NULL;
    }

    function is_mobile_number_available($mobile, $id = NULL)
    {
        $this->db->select($this->que_employee . '.id');
        $this->db->where('LCASE(mobile_number)', strtolower($mobile));
        if (!empty($id))
            $this->db->where('id !=', $id);
        $query = $this->db->get($this->que_employee);
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return NULL;
    }

    function get_emp_by_login($username, $password)
    {
        $password = md5($password);
        $this->db->select('tab_1.*');
        $this->db->where('password = ', $password);
        $where = '(LOWER(username) = "' . strtolower($username) . '" OR LOWER(tab_1.email_address) = "' . strtolower($username) . '")';
        $this->db->where($where);
        $this->db->group_by('tab_1.id');
        $query = $this->db->get($this->que_employee . ' AS tab_1');

        if ($query->num_rows() == 1) {
            return $query->row();
        }
        return NULL;
    }

    function get_increment_code_based_client($client_id)
    {
        $this->db->where('client_id', $client_id);
        $query = $this->db->get('que_employee');
        if ($query->num_rows() > 0) {
            $COUNT = $query->num_rows();
            $inc_count = $COUNT + 1;
            $increment_id = str_pad($inc_count, 4, '0', STR_PAD_LEFT);
            $entry_number = 'EMP' . '-' . $increment_id;
        } else {
            $increment_id = str_pad(1, 4, '0', STR_PAD_LEFT);
            $entry_number = 'EMP' . '-' . $increment_id;
        }
        return $entry_number;
    }
}
