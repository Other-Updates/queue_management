<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Subcategory_model extends CI_Model {

    private $que_category = 'que_category';
    private $que_category_type = 'que_category_type';

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function insert_category($data) {
        if ($this->db->insert($this->que_category, $data)) {
            $insert_id = $this->db->insert_id();
            return $insert_id;
        }
        return FALSE;
    }

    function update_category($data, $id) {
        $data['updated_date'] = date('Y-m-d H:i:s');
        $this->db->where('id', $id);
        if ($this->db->update($this->que_category, $data)) {
            return TRUE;
        }
        return FALSE;
    }

    function delete_subcategory($id) {
        $this->db->where('id', $id);
        if ($this->db->delete($this->que_category)) {
            return 1;
        }
        return 0;
    }

    function get_category_details_id($id) {
        $this->db->select($this->que_category . '.*');
//        $this->db->where($this->que_category . '.status', 1);
        $this->db->where($this->que_category . '.id', $id);
        $query = $this->db->get($this->que_category);
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return NULL;
    }

    function get_all_category($client_id) {
        $this->db->select('tab_1.*');
        $this->db->where('tab_1.status', 1);
        $this->db->where('tab_1.client_id', $client_id);
        $query = $this->db->get($this->que_category_type . ' AS tab_1');
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return NULL;
    }

    function get_all_category_details($client_id) {
        $this->db->select('tab_1.*, tab_2 . category_type');
        $this->db->where('tab_1.client_id', $client_id);
        $this->db->join($this->que_category_type . ' AS tab_2', 'tab_2.id = tab_1.category_id', 'LEFT');
        $this->db->order_by('tab_1.id', 'desc');
        $query = $this->db->get($this->que_category . ' AS tab_1');
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return NULL;
    }

    public function get_sub_category_type_class($id) {
        $this->db->select('*');
        $this->db->where('category_id', $id);
        $query = $this->db->get('que_category')->result_array();
        if (!empty($query)) {
            foreach ($query as $key => $data) {
                if ($key >= 5) {
                    $inc = $key - 4;
                } else {
                    $inc = $key + 1;
                }
                $this->db->where('id', $data['id']);
                $this->db->update('que_category', ["class" => $inc]);
            }
        } else {
            return false;
        }
    }

    function get_user_type_by_name($user_type_name) {
        $this->db->select($this->que_category . '.*');
        $this->db->where('LCASE(user_type_name)', strtolower($user_type_name));
        $query = $this->db->get($this->que_category);
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return NULL;
    }

    function is_sub_category_available($subcategory_name, $category_id, $client_id) {
        $this->db->select($this->que_category . '.id');
        $this->db->where($this->que_category . '.category_id', $category_id);
        $this->db->where('LCASE(sub_category)', strtolower($subcategory_name));
        $this->db->where($this->que_category . '.client_id', $client_id);
        $query = $this->db->get($this->que_category);
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }

        return 0;
    }

    function insert_user_permission($data) {
        if ($this->db->insert($this->user_permission_table, $data)) {
            $sal_id = $this->db->insert_id();
            return true;
        }

        return false;
    }

    function delete_user_permission_by_type($type) {
        $this->db->where('user_type_id', $type);
        if ($this->db->delete($this->user_permission_table)) {
            if ($this->db->affected_rows() > 0) {
                return true;
            }
        }
        return false;
    }

    function get_user_permissions_by_type($user_type_id) {
        $this->db->select('tab_1.*');
        $this->db->where('tab_1.user_type_id', $user_type_id);
        $query = $this->db->get($this->user_permission_table . ' AS tab_1');
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }

        return NULL;
    }

    function get_user_type_permissions_by_section($user_type_id) {
        $this->db->select('tab_1.*,tab_2.user_section_name,tab_2.user_section_key,tab_3.user_module_key');
        $this->db->join($this->user_sections_table . ' AS tab_2', 'tab_2.id = tab_1.section_id', 'LEFT');
        $this->db->join($this->user_modules_table . ' AS tab_3', 'tab_3.id = tab_1.module_id', 'LEFT');
        $this->db->where('tab_1.user_type_id', $user_type_id);
        $query = $this->db->get($this->user_permission_table . ' AS tab_1');
        $result = $query->result_array();
        $permissions = array();
        if (!empty($result)) {
            foreach ($result as $key => $value) {
                $permissions[$value['user_module_key'] . '|' . $value['user_section_key']] = array('all' => $value['acc_all'], 'view' => $value['acc_view'], 'add' => $value['acc_add'], 'edit' => $value['acc_edit'], 'delete' => $value['acc_delete']);
            }
        }

        return $permissions;
    }

    function get_user_type_permissions_by_module($user_type_id) {
        $this->db->select('tab_1.*,tab_2.user_module_name,tab_2.user_module_key,tab_3.user_section_name,tab_3.user_section_key');
        $this->db->join($this->user_modules_table . ' AS tab_2', 'tab_2.id = tab_1.module_id', 'LEFT');
        $this->db->join($this->user_sections_table . ' AS tab_3', 'tab_3.id = tab_1.section_id', 'LEFT');
        $this->db->where('tab_1.user_type_id', $user_type_id);
        $query = $this->db->get($this->user_permission_table . ' AS tab_1');
        $result = $query->result_array();
        $permissions = array();
        if (!empty($result)) {
            foreach ($result as $key => $value) {
                $permissions[$value['user_module_key']][$value['user_section_key']] = array('all' => $value['acc_all'], 'view' => $value['acc_view'], 'add' => $value['acc_add'], 'edit' => $value['acc_edit'], 'delete' => $value['acc_delete']);
            }
        }
        return $permissions;
    }

}
