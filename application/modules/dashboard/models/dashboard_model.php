<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Dashboard_model extends CI_Model {

    private $token_details_table = 'que_token_details';
    private $que_counter = 'que_counter';

    function __construct() {
        $this->load->database();
        parent::__construct();
    }

    public function get_add_image_data($type, $count, $client_id) {
        $this->load->helper('url');

        $this->db->select('que_advertisement.*,que_add_details.sort_order,que_add_details.time_duration,que_add_details.add_data,que_add_details.id as detail_id');
        $this->db->where('que_advertisement.is_deleted', 0);
        $this->db->where('que_advertisement.status', 1);
        $this->db->where('que_advertisement.type !=', 3);
        $this->db->where('que_advertisement.client_id', $client_id);
        $this->db->order_by('que_advertisement.total_sort_order', 'asc');
        $this->db->order_by('que_add_details.sort_order', 'asc');
        $this->db->join('que_add_details', 'que_add_details.add_id = que_advertisement.id', 'LEFT');
        $query = $this->db->get('que_advertisement')->result_array();

        $result = "";
        if ($query) {
            foreach ($query as $key => $data) {

                $result[$key]['add_id'] = $data['id'];
                $result[$key]['details_id'] = $data['detail_id'];
                $result[$key]['add_name'] = $data['name'];
                if ($data['position'] == 1)
                    $position = "Left";
                elseif ($data['position'] == 2)
                    $position = "Bottom";
                else
                    $position = "";
                $result[$key]['position'] = $position;

                if ($data['type'] == 1)
                    $type = "Images";
                elseif ($data['type'] == 2)
                    $type = "Videos";
                elseif ($data['type'] == 3)
                    $type = "Content";
                else
                    $type = "";

                $result[$key]['type'] = $type;
                $result[$key]['total_sort_order'] = $data['total_sort_order'];
                $result[$key]['total_duration'] = $data['total_duration'];


                $result[$key]['sort_order'] = $data['sort_order'];
                $result[$key]['time_duration'] = $data['time_duration'];
                $result[$key]['time_duration_sec'] = strtotime($data['time_duration']);

                if ($add_data['add_direction'] == 1)
                    $direction = "Vertical";
                elseif ($add_data['add_direction'] == 2)
                    $direction = "Horizontal";
                else
                    $direction = "";


                $result[$key]['direction'] = $direction;
                if ($data['type'] == 1) {
                    $result[$key]['add_data'] = base_url() . "attachments/advertisements/images/" . $data['add_data'];
                } elseif ($data['type'] == 2) {
                    $result[$key]['add_data'] = base_url() . "attachments/advertisements/videos/" . $data['add_data'];
                } elseif ($data['type'] == 3) {
                    $result[$key]['add_data'] = $data['add_data'];
                }

                $result[$key]['key'] = $key;
            }
            if (isset($result[$count])) {
                return $result[$count];
            } else {
                return $result[0];
            }
        } else {
            return false;
        }
    }

    function get_count_of_token_status($data) {
        $client_id = $this->user_auth->get_user_id();
        $this->db->select('tab_1.*');
        $this->db->where('tab_1.token_status', $data);
        $this->db->where('tab_1.token_status', $data);
        $this->db->join('que_counter AS tab_2', 'tab_2.id=tab_1.counter_id');
        $this->db->where('tab_2.client_id', $client_id);
        $this->db->where('DATE(tab_1.created_date) = DATE(NOW())');
        $query = $this->db->get($this->token_details_table . ' AS tab_1');
        if ($query->num_rows() > 0) {
            return $query->num_rows();
        }
        return 0;
    }

    public function get_add_conetnt_data($type, $count, $client_id) {
        $this->load->helper('url');

        $this->db->select('que_advertisement.*,que_add_details.sort_order,que_add_details.time_duration,que_add_details.add_data');
        $this->db->where('que_advertisement.is_deleted', 0);
        $this->db->where('que_advertisement.status', 1);
        $this->db->where('que_advertisement.type', $type);
        $this->db->order_by('que_advertisement.total_sort_order', 'asc');
        $this->db->where('que_advertisement.client_id', $client_id);
        $this->db->order_by('que_add_details.sort_order', 'asc');
        $this->db->join('que_add_details', 'que_add_details.add_id = que_advertisement.id', 'LEFT');
        $query = $this->db->get('que_advertisement')->result_array();

        $result = "";
        if ($query) {
            foreach ($query as $key => $data) {

                $result[$key]['add_id'] = $data['id'];
                $result[$key]['add_name'] = $data['name'];
                if ($data['position'] == 1)
                    $position = "Left";
                elseif ($data['position'] == 2)
                    $position = "Bottom";
                else
                    $position = "";
                $result[$key]['position'] = $position;

                if ($data['type'] == 1)
                    $type = "Images";
                elseif ($data['type'] == 2)
                    $type = "Videos";
                elseif ($data['type'] == 3)
                    $type = "Content";
                else
                    $type = "";

                $result[$key]['type'] = $type;
                $result[$key]['total_sort_order'] = $data['total_sort_order'];
                $result[$key]['total_duration'] = $data['total_duration'];


                $result[$key]['sort_order'] = $data['sort_order'];
                $result[$key]['time_duration'] = $data['time_duration'];
                $result[$key]['time_duration_sec'] = strtotime($data['time_duration']);

                if ($add_data['add_direction'] == 1)
                    $direction = "Vertical";
                elseif ($add_data['add_direction'] == 2)
                    $direction = "Horizontal";
                else
                    $direction = "";


                $result[$key]['direction'] = $direction;
                if ($data['type'] == 1) {
                    $result[$key]['add_data'] = base_url() . "attachments/advertisements/images/" . $data['add_data'];
                } elseif ($data['type'] == 2) {
                    $result[$key]['add_data'] = base_url() . "attachments/advertisements/videos/" . $data['add_data'];
                } elseif ($data['type'] == 3) {
                    $result[$key]['add_data'] = $data['add_data'];
                }

                $result[$key]['key'] = $key;
                $result[$key]['key'] = $key;
            }
            if (isset($result[$count])) {
                // return $result[$count];
            } else {
                //return $result[0];
            }

            return $result;
        } else {
            return false;
        }
    }

    function get_count_of_total_token($client_id) {
        $this->db->select('tab_1.*');
        $this->db->where('DATE(tab_1.created_date) = DATE(NOW())');
        $this->db->join('que_counter AS tab_2', 'tab_2.id=tab_1.counter_id');
        $this->db->where('tab_2.client_id', $client_id);
        $query = $this->db->get($this->token_details_table . ' AS tab_1');
        if ($query->num_rows() > 0) {
            return $query->num_rows();
        }
        return 0;
    }

    function get_count_of_success_token() {
        $this->db->select('tab_1.*');
        $this->db->where('tab_1.token_status', 'success');
        $this->db->where('DATE(tab_1.created_date) = DATE(NOW())');
        $query = $this->db->get($this->token_details_table . ' AS tab_1');
        if ($query->num_rows() > 0) {
            return $query->num_rows();
        }
        return 0;
    }

    function get_count_of_missed_token() {
        $this->db->select('tab_1.*');
        $this->db->where('tab_1.token_status', 'Missed');
        $this->db->where('DATE(tab_1.created_date) = DATE(NOW())');
        $query = $this->db->get($this->token_details_table . ' AS tab_1');
        if ($query->num_rows() > 0) {
            return $query->num_rows();
        }
        return 0;
    }

    function get_count_of_hold_token() {
        $this->db->select('tab_1.*');
        $this->db->where('tab_1.token_status', 'Hold');
        $this->db->where('DATE(tab_1.created_date) = DATE(NOW())');
        $query = $this->db->get($this->token_details_table . ' AS tab_1');
        if ($query->num_rows() > 0) {
            return $query->num_rows();
        }
        return 0;
    }

    public function get_all_tokens($client_id) {
        $this->db->select('que_counter.*,');
        $this->db->where('que_assign_counter.status', 1);
        $this->db->where('que_counter.status', 1);
        $this->db->where('que_counter.client_id', $client_id);
        $this->db->join('que_counter', 'que_counter.id = que_assign_counter.counter_id', 'LEFT');
        $query = $this->db->get('que_assign_counter');
        if ($query->num_rows() > 0) {
            $data = $query->result_array();
            foreach ($data as $key => $result) {
                $this->db->select('*');
                $this->db->where('counter_id', $result['id']);
                $this->db->where('token_status', '');
                $this->db->where('DATE_FORMAT(que_token_details.created_date,"%Y-%m-%d")', date('Y-m-d'));
                $query_result = $this->db->get('que_token_details');
                if ($query_result->num_rows() > 0) {
                    $data[$key]['que_token_count'] = $query_result->num_rows();
                } else {
                    $data[$key]['que_token_count'] = '-';
                }
                $result_token = $query_result->result_array();
                $emp_id = $result_token[0]['emp_id'];
                $this->db->select('*');
                $this->db->where('emp_id', $emp_id);
                $query = $this->db->get('que_assign_counter');
                $datas = $query->result_array();
                $emp_status = $datas[0]['emp_status'];
                $data[$key]['emp_status'] = $emp_status;
                if ($emp_status == 1 && $query_result->num_rows() > 0) {
                    $data[$key]['token_number'] = $result_token[0]['token_number'];
                    $tokn_numers = implode(' ', preg_split('//', $result_token[0]['token_number'], -1, PREG_SPLIT_NO_EMPTY));
                    $data[$key]['token_number_format'] = $tokn_numers;
                } else {
                    $data[$key]['token_number'] = '-';
                    $data[$key]['token_number_format'] = '-';
                }
                if (!empty($data)) {
                    $emp_status_data[] = ["name" => $data[$key]['counter_name'], "title" => $data[$key]['token_number'], "emp_status" => $data[$key]['status']];
                }

                $data[$key]['voice_msg'] = $result_token[0]['voice_msg'];
                $data[$key]['que_detail_id'] = $result_token[0]['id'];
            }
            return $data;
        } else {
            return NULL;
        }
    }

}
