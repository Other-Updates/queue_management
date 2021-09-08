<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Counterscreen_model extends CI_Model {

    private $que_token_details = 'que_token_details';
    private $que_counter = 'que_counter';

    function __construct() {
        date_default_timezone_set('Asia/Kolkata');
        parent::__construct();
//        $this->load->model('masters/shop_model');
    }

    public function get_all_token() {
        $this->db->select('que_counter.*,');
        $this->db->where('que_assign_counter.status', 1);
        $this->db->where('que_counter.status', 1);
        $this->db->join('que_counter', 'que_counter.id = que_assign_counter.counter_id', 'LEFT');
        $query = $this->db->get('que_assign_counter');
        if ($query->num_rows() > 0) {
            $data = $query->result_array();
            foreach ($data as $key => $result) {
                $this->db->select('*');
                $this->db->where('counter_id', $result['id']);
                $this->db->where('token_status', '');
                $this->db->where('DATE_FORMAT(que_token_details.created_date,"%Y-%m-%d")', date('Y-m-d'));
                $this->db->limit(1);
                $query_result = $this->db->get('que_token_details');
                $result_token = $query_result->result_array();
                $emp_id = $result_token[0]['emp_id'];
                $this->db->select('*');
                $this->db->where('emp_id', $emp_id);
                $query = $this->db->get('que_assign_counter');
                $datas = $query->result_array();
                $emp_status = $datas[0]['emp_status'];
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
                $data['emp_status_data'] = $emp_status_data;
                $data[$key]['voice_msg'] = $result_token[0]['voice_msg'];
                $data[$key]['que_detail_id'] = $result_token[0]['id'];
            }
            return $data;
        } else {
            return NULL;
        }
    }

    public function get_all_tokens($user_id) {
        $this->db->select('que_counter.*,');
        $this->db->where('que_assign_counter.status', 1);
        $this->db->where('que_counter.status', 1);
        $this->db->where('que_counter.client_id', $user_id);
        $this->db->join('que_counter', 'que_counter.id = que_assign_counter.counter_id', 'LEFT');
        $query = $this->db->get('que_assign_counter');
        if ($query->num_rows() > 0) {
            $data = $query->result_array();
            foreach ($data as $key => $result) {
                $this->db->select('*');
                $this->db->where('counter_id', $result['id']);
                $this->db->where('token_status', '');
                $this->db->where('DATE_FORMAT(que_token_details.created_date,"%Y-%m-%d")', date('Y-m-d'));
                $this->db->limit(1);
                $query_result = $this->db->get('que_token_details');
                $result_token = $query_result->result_array();
                $emp_id = $result_token[0]['emp_id'];
                $this->db->select('*');
                $this->db->where('emp_id', $emp_id);
                $query = $this->db->get('que_assign_counter');
                $datas = $query->result_array();
                $emp_status = $datas[0]['emp_status'];
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

    function get_videos_data($client_id) {
        $this->db->select('que_advertisement.*,que_add_details.sort_order,que_add_details.time_duration,que_add_details.add_data,que_add_details.id as detail_id');
        $this->db->where('que_advertisement.is_deleted', 0);
        $this->db->where('que_advertisement.status', 1);
        $this->db->where('que_advertisement.type', 2);
        $this->db->where('que_advertisement.client_id', $client_id);
        $this->db->order_by('que_advertisement.total_sort_order', 'asc');
        $this->db->order_by('que_add_details.sort_order', 'asc');
        $this->db->join('que_add_details', 'que_add_details.add_id = que_advertisement.id', 'LEFT');
        $query = $this->db->get('que_advertisement')->result_array();
        $result = '';
        foreach ($query as $key => $vidoes_data) {
            $result[$key]['detail_id'] = $vidoes_data['detail_id'];
            $result[$key]['add_data'] = base_url() . "attachments/advertisements/videos/" . $vidoes_data['add_data'];
        }
        return $result;
    }

    function get_all_empty_status($id) {

        $this->db->select('*');
        $query = $this->db->get('que_assign_counter');
        if ($query->num_rows() > 0) {
            $data = $query->result_array();
            $all_counter = array();
            foreach ($data as $result) {
                $counter_id = $result['counter_id'];
                array_push($all_counter, $counter_id);
            }
            return $all_counter;
        }
    }

    function update_voice_status($id) {
        $this->db->set('voice_msg', 1);
        $this->db->where('id', $id);
        if ($this->db->update('que_token_details')) {
            return true;
        }
        return FALSE;
    }

}
