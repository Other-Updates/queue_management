<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Category_type_model extends CI_Model {

    private $que_category_type = 'que_category_type';
    private $user_permission_table = 'que_user_type_permissions';
    private $user_modules_table = 'que_user_modules';
    private $user_sections_table = 'que_user_sections';
    private $token_increment = 'token_increment';
    private $que_counter = 'que_counter';

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function insert_category_type($data) {
        if ($this->db->insert($this->que_category_type, $data)) {
            $insert_id = $this->db->insert_id();
            return $insert_id;
        }

        return FALSE;
    }

    function insert_token_details($data) {
        if ($this->db->insert_batch($this->token_increment, $data)) {
            return true;
        }
        return FALSE;
    }

    function update_token_details($datas, $id) {
        $this->db->where('category_id', $id);
        if ($this->db->update($this->token_increment, $datas)) {

            return TRUE;
        }

        return FALSE;
    }

    public function get_category_type_class($status, $id) {

        $this->db->select('*');

        if ($status == 0 && $id != "")
            $this->db->where('que_category_type.id !=', $id);

        $query = $this->db->get('que_category_type')->result_array();
        if (!empty($query)) {
            foreach ($query as $key => $data) {
                if ($key >= 5) {
                    $inc = $key - 4;
                } else {
                    $inc = $key + 1;
                }
                $this->db->where('id', $data['id']);
                $this->db->update('que_category_type', ["class" => $inc]);
            }
        } else {
            return false;
        }
    }

    public function get_subcategory_based_on_id($id, $client_id) {
        $this->db->select('*,class as sub_class');
        $this->db->where("category_id", $id);
        $this->db->where("client_id", $client_id);
        $this->db->where('que_category.status', 1);
        $query = $this->db->get("que_category");
        if ($query->num_rows() > 0) {
            $data = $query->result_array();
            foreach ($data as $key => $result) {
                $this->db->where('id', $result['category_id']);
                $category_details = $this->db->get($this->que_category_type)->result_array();
                $data[$key]['main_category_name'] = $category_details[0]['category_type'];
                $data[$key]['class'] = $category_details[0]['class'];
            }

            return $data;
        }
    }

    function get_all_active_counters($client_id) {
        $this->db->select('que_counter.*');
        $this->db->where('que_counter.is_deleted', 0);
        $this->db->where('que_counter.status', 1);
        $this->db->where('que_counter.client_id', $client_id);
        $query = $this->db->get('que_counter');
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }

    function update_category_type($data, $id) {
        $data['updated_date'] = date('Y-m-d H:i:s');
        $this->db->where('id', $id);
        if ($this->db->update($this->que_category_type, $data)) {
            return TRUE;
        }

        return FALSE;
    }

    function delete_category_type($id) {
        $this->db->where('id', $id);
        if ($this->db->delete($this->que_category_type)) {
            return 1;
        }
        return 0;
    }

    function get_category_type_by_id($id) {
        $this->db->select($this->que_category_type . '.*');
        $this->db->where($this->que_category_type . '.id', $id);
        $query = $this->db->get($this->que_category_type);
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return NULL;
    }

    function get_all_category_type($client_id) {
        $this->db->select('que_category_type .*');
        $this->db->where($this->que_category_type . '.client_id', $client_id);
        $this->db->order_by('que_category_type.id', 'DESC');
        $query = $this->db->get($this->que_category_type);
        if ($query->num_rows() > 0) {
            $data = $query->result_array();
            foreach ($data as $key => $result) {
                $counter_name = array();
                $counter_id = explode(',', $result['counter_id']);
                $this->db->where_in('id', $counter_id);
                $result_data = $this->db->get('que_counter')->result_array();
                if ($result_data != "") {
                    foreach ($result_data as $c_name) {
                        $counter_name[] = $c_name['counter_name'];
                    }

                    $data[$key]['counter_name'] = implode(',', $counter_name);
                }
            }
            return $data;
        }

        return NULL;
    }

    function get_user_type_by_name($user_type_name) {
        $this->db->select($this->que_category_type . '.*');
        $this->db->where('LCASE(user_type_name)', strtolower($user_type_name));
        $query = $this->db->get($this->que_category_type);
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return NULL;
    }

    function is_category_type_available($category_type, $client_id) {
        $this->db->select($this->que_category_type . '.id');
        $this->db->where('LCASE(category_type)', ($category_type));
        $this->db->where($this->que_category_type . '.client_id', $client_id);
        $query = $this->db->get($this->que_category_type);
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return 0;
    }

    function get_all_counters() {
        $this->db->select('que_counter.*');
        $this->db->where('que_counter.is_deleted', 0);
//        $this->db->where('que_category_type.status', 1);
//        $this->db->join('que_category_type', 'que_counter.id=que_category_type.counter_id', 'LEFT');
        $query = $this->db->get('que_counter');
        if ($query->num_rows() > 0) {
            $data = $query->result_array();
            $results = '';
            foreach ($data as $result) {
                $this->db->where('que_category_type.counter_id', $result['id']);
                $datas = $this->db->get('que_category_type');
                if ($datas->num_rows() == 0) {
                    $results[] = $result;
                }
            }
            return $results;
        }
        return false;
    }

    function get_all_counters_edit($id) {
        $this->db->select('que_counter.*');
        $this->db->where('que_counter.is_deleted', 0);
//        $this->db->where('que_category_type.status', 1);
//        $this->db->join('que_category_type', 'que_counter.id=que_category_type.counter_id', 'LEFT');
        $query = $this->db->get('que_counter');
        if ($query->num_rows() > 0) {
            $data = $query->result_array();
            $results = '';
            foreach ($data as $result) {
                $this->db->where('que_category_type.counter_id', $result['id']);
                $datas = $this->db->get('que_category_type');
                $cat_data = $datas->result_array();
                if ($datas->num_rows() == 0 || $cat_data[0]['id'] == $id) {
                    $results[] = $result;
                }
            }
            return $results;
        }
        return false;
    }

}
