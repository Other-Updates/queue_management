<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Reports_model extends CI_Model {

    private $que_feedback = 'que_feedback';
    private $que_token_details = 'que_token_details';
    private $que_edit_token_details = 'que_edit_token_details';
    private $que_employee = 'que_employee';
    private $que_counter = 'que_counter';
    private $que_assign_counter = 'que_assign_counter';
    var $primaryTable = 'que_token_details tab_1';
    var $joinTable1 = 'que_employee tab_2';
    var $joinTable2 = 'que_counter tab_3';
    var $selectColumn = 'tab_1.*,tab_2.emp_name, tab_3.counter_name';
    var $column_order = array(null, 'tab_3.counter_name', 'tab_2.emp_name', 'tab_1.token_number', 'tab_1.created_date', 'tab_1.que_start_time', 'tab_1.que_total_waiting_time', 'tab_1.tkn_intime', 'tab_1.tkn_outtime', 'tab_1.processing_time', 'tab_1.token_status');
    var $column_search = array('tab_3.counter_name', 'tab_2.emp_name', 'tab_1.token_number', 'tab_1.created_date', 'tab_1.que_start_time', 'tab_1.que_total_waiting_time', 'tab_1.tkn_intime', 'tab_1.tkn_outtime', 'tab_1.processing_time', 'tab_1.token_status');
    var $order = array('tab_1.id' => 'desc ');

    function __construct() {
        date_default_timezone_set('Asia/Kolkata');
        parent::__construct();
    }

    public function get_counter_token_status($current_date, $get_last_week_dates, $client_id) {
        $this->db->select('*');
        $this->db->where('status', 1);
        $this->db->where('is_deleted', 0);
        $this->db->where('client_id', $client_id);
        $query = $this->db->get($this->que_counter)->result_array();

        $token_result = '';

        $tkn_counter = '';
        foreach ($query as $key => $result) {
            $tkn_counter[$key] = $result['counter_name'];
            $tkn_counter_id[$key] = $result['id'];
        }
        $tkn_status = ["Success", "Hold", "Missed", "Transfer", "Hold-Reassign", "Missed-Reassign"];
        $tkn_counter_name = $tkn_counter;

        $token_result['counter_list'] = $tkn_counter;
        $token_result['counter_id'] = $tkn_counter_id;


        for ($i = 0; $i < count($tkn_status); $i++) {
            $tokenresult[$i]['name'] = $tkn_status[$i];
            $sum_all_tkn = 0;
            for ($j = 0; $j < count($tkn_counter_name); $j++) {

                $this->db->select('COUNT(token_status) as tkn_count');
                if ($tkn_status[$i] == "Hold") {
                    $this->db->where_in('token_status', ["Hold", "Hold-Reassign"]);
                }if ($tkn_status[$i] == "Missed") {
                    $this->db->where_in('token_status', ["Missed", "Missed-Reassign"]);
                } else {
                    $this->db->where('token_status', $tkn_status[$i]);
                }
                $this->db->where('counter_id', $tkn_counter_id[$j]);
                $this->db->where('DATE_FORMAT(' . $this->que_token_details . '.created_date,"%Y-%m-%d")', $current_date);
                $token_status = $this->db->get($this->que_token_details)->result_array();
                $tokenresult[$i]['data'][$j] = $token_status[0]['tkn_count'];
                $couter_tkn_count[$j] = $this->get_counter_overll_count($tkn_counter_id[$j]);
                $counter_curr_status[$j] = $this->get_counter_curr_status($tkn_counter_id[$j]);
                $counter_curr_token[$j] = $this->get_counter_curr_token($tkn_counter_id[$j]);
                $counter_tkn_week_data[$j] = $this->get_counter_tkn_week_data($tkn_counter_id[$j], $get_last_week_dates['date']);

                $counter_tkn_percentage_sum = count($this->get_counter_tkn_percentage($tkn_counter_id[$j]));
                $counter_tkn_percentage[$j] = $counter_tkn_percentage_sum;
                $sum_all_tkn +=$counter_tkn_percentage_sum;
            }
        }

        $token_result['couter_tkn_count'] = $couter_tkn_count;
        $token_result['counter_curr_status'] = $counter_curr_status;
        $token_result['counter_curr_token'] = $counter_curr_token;
        $token_result['counter_tkn_counts'] = $counter_tkn_percentage;
        $token_result['sum_all_tkn'] = $sum_all_tkn;
        $token_result['counter_data'] = $tokenresult;
        $token_result['counter_tkn_week_data'] = $counter_tkn_week_data;
        return $token_result;
    }

    public function get_counter_tkn_week_data($counter_id, $dates) {

        foreach ($dates as $key => $result) {
            $this->db->select('SEC_TO_TIME( SUM( TIME_TO_SEC( `processing_time` ) ) ) AS timeSum ');
            $this->db->where('counter_id', $counter_id);
            $this->db->where('DATE_FORMAT(' . $this->que_token_details . '.created_date,"%Y-%m-%d")', date('Y-m-d', strtotime($result)));
            $token_details = $this->db->get($this->que_token_details)->result_array();
            $time[] = $this->round_hours($token_details[0]['timeSum']);
        }
        return $time;
    }

    public function get_counter_tkn_percentage($id) {
        $this->db->select('COUNT(token_number) as tkn_count,token_number');
        $this->db->where('counter_id', $id);
        $this->db->where('DATE_FORMAT(' . $this->que_token_details . '.created_date,"%Y-%m-%d")', date('Y-m-d', strtotime(date('Y-m-d'))));
        $this->db->group_by('token_number');
        $token_details = $this->db->get($this->que_token_details)->result_array();
        return $token_details;
    }

    function round_hours($time) {
        $explode_time = explode(':', $time);
        $hours = round($explode_time[0]);
        if ($explode_time[1] == "00") {
            $mins = "";
        } else {
            $mins = $explode_time[1];
        }

        if (!empty($mins))
            $time = $hours . "." . $mins;
        else
            $time = $hours;

        if ($hours == 0 && $mins == "")
            $time = 0;
        //if($time="0.")
        //$time=0;

        return $time;
    }

    public function get_counter_overll_count($id) {
        $this->db->select('COUNT(token_number) as tkn_count');
        $this->db->where('counter_id', $id);
        $this->db->where('DATE_FORMAT(' . $this->que_token_details . '.created_date,"%Y-%m-%d")', date('Y-m-d', strtotime(date('Y-m-d'))));
        $token_details = $this->db->get($this->que_token_details)->result_array();

        return $token_details[0]['tkn_count'];
    }

    public function get_counter_curr_status($id) {
        $this->db->select('emp_status');
        $this->db->where('counter_id', $id);
        $token_curr_status = $this->db->get($this->que_assign_counter)->result_array();
        return $token_curr_status[0]['emp_status'];
    }

    public function get_counter_curr_token($id) {
        $this->db->select('token_number');
        $this->db->where('counter_id', $id);
        $this->db->where('DATE_FORMAT(' . $this->que_token_details . '.created_date,"%Y-%m-%d")', date('Y-m-d'));
        $this->db->where('token_status', '');
        $this->db->order_by('id', 'asc');
        $token_details = $this->db->get($this->que_token_details)->result_array();
        return $token_details[0]['token_number'];
    }

    public function get_all_feedback($client_id) {
        $this->db->select('*');
        $this->db->order_by('id', desc);
        $this->db->where('client_id', $client_id);
        $query = $this->db->get('que_feedback');

        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return NULL;
    }

    public function get_all_today_token($client_id) {
        $this->db->select('que_token_details.*,que_counter.counter_name,que_employee.emp_name');
        $this->db->join('que_counter', 'que_counter.id=que_token_details.counter_id');
        $this->db->join('que_employee', 'que_employee.id = que_token_details.emp_id');
        $this->db->where('que_counter.client_id', $client_id);
        $this->db->where('DATE_FORMAT(que_token_details.created_date,"%Y-%m-%d")', date('Y-m-d'));
        $query = $this->db->get('que_token_details');

        if ($query->num_rows() > 0) {
            return $query->result_array();
        }

        return NULL;
    }

    public function get_all_tkn_number($client_id) {
        $this->db->select('token_number');
        $this->db->where('DATE_FORMAT(' . $this->que_token_details . '.created_date,"%Y-%m-%d")', date('Y-m-d'));
        $this->db->group_by('token_number');
        $this->db->where('que_employee.client_id', $client_id);
        $this->db->join('que_employee', 'que_employee.id=que_token_details.emp_id');
        $this->db->where('token_number !=', ' ');
        $query = $this->db->get($this->que_token_details);
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }

        return NULL;
    }

    public function get_tkn_number_bydate($from_date, $to_date, $client_id) {
        $from_date = str_replace('/', '-', $from_date);
        $to_date = str_replace('/', '-', $to_date);
        $from_date = date('Y-m-d', strtotime($from_date));
        $to_date = date('Y-m-d', strtotime($to_date));

        $this->db->select('token_number');
        $this->db->where($this->que_token_details . '.created_date >=', $from_date);
        $this->db->where($this->que_token_details . '.created_date <=', $to_date);
        $this->db->group_by('token_number');
        $this->db->where('token_number !=', ' ');
        $this->db->where('que_counter.client_id', $client_id);
        $this->db->join('que_counter', 'que_counter.id=que_token_details.counter_id');
        $query = $this->db->get($this->que_token_details);
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }

        return NULL;
    }

    public function get_all_today_edit_token($client_id) {
        $this->db->select('que_edit_token_details.*,que_counter.counter_name,que_employee.emp_name');
        $this->db->join('que_counter', 'que_counter.id=que_edit_token_details.counter_id');
        $this->db->join('que_employee', 'que_employee.id = que_edit_token_details.emp_id');
        $this->db->where('que_employee.client_id', $client_id);
        $this->db->where('DATE_FORMAT(que_edit_token_details.created_date,"%Y-%m-%d")', date('Y-m-d'));
        $query = $this->db->get('que_edit_token_details');
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }

        return NULL;
    }

    public function get_datatables($search_data, $client_id) {

        $this->db->select('tab_1.*,tab_2.emp_name,tab_3.counter_name');
        $this->db->join($this->que_employee . ' AS tab_2', 'tab_2.id = tab_1.emp_id', 'LEFT');
        $this->db->join($this->que_counter . ' AS tab_3', 'tab_3.id = tab_1.counter_id', 'LEFT');
        $counter_id = trim($search_data['counter_id']);
        $emp_id = $search_data['emp_id'];
        $status = $search_data['status'];
        $tkn_number = $search_data['tkn_number'];

        $sfrom = explode(' ', $search_data['from_date']);
        $date = explode('/', $sfrom[0]);

        $sfrom_date = $date[2] . "-" . $date[1] . "-" . $date[0];

        $from_date_time = $sfrom_date;

        $sto = explode(' ', $search_data['to_date']);
        $to_date = explode('/', $sto[0]);

        $sto_date = $to_date[2] . "-" . $to_date[1] . "-" . $to_date[0];
        $to_date_time = $sto_date;


        if (isset($from_date_time) && !empty($from_date_time) && $from_date_time != '--' && isset($to_date_time) && !empty($to_date_time) && $to_date_time != '--') {

            $this->db->where('DATE_FORMAT(tab_1.created_date,"%Y-%m-%d")>=', $from_date_time);
            $this->db->where('DATE_FORMAT(tab_1.created_date,"%Y-%m-%d")<=', $to_date_time);
        }
        if (isset($counter_id) && !empty($counter_id)) {
            $this->db->like('tab_1.counter_id', $counter_id);
        }
        if (isset($emp_id) && !empty($emp_id)) {
            $this->db->like('tab_1.emp_id', $emp_id);
        }
        if (isset($status) && !empty($status)) {
            $this->db->like('tab_1.token_status', $status);
        }
        if (isset($tkn_number) && !empty($tkn_number && $tkn_number != "Select Token Number")) {
            $this->db->where('tab_1.token_number', $tkn_number);
        }

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

        if (isset($_POST['length']) && $_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $this->db->where('tab_2.client_id', $client_id);
        $query = $this->db->get($this->que_token_details . ' AS tab_1');
        return $query->result();
    }

    public function count_all($search_data, $client_id) {
        $this->db->select('tab_1.*,tab_2.emp_name,tab_3.counter_name');
        $this->db->join($this->que_employee . ' AS tab_2', 'tab_2.id = tab_1.emp_id', 'LEFT');
        $this->db->join($this->que_counter . ' AS tab_3', 'tab_3.id = tab_1.counter_id', 'LEFT');
        $counter_id = trim($search_data['counter_id']);
        $emp_id = $search_data['emp_id'];
        $status = $search_data['status'];

        $sfrom = explode(' ', $search_data['from_date']);
        $date = explode('/', $sfrom[0]);

        $sfrom_date = $date[2] . "-" . $date[1] . "-" . $date[0];

        $from_date_time = $sfrom_date;

        $sto = explode(' ', $search_data['to_date']);
        $to_date = explode('/', $sto[0]);

        $sto_date = $to_date[2] . "-" . $to_date[1] . "-" . $to_date[0];
        $to_date_time = $sto_date;

        if (isset($from_date_time) && !empty($from_date_time) && $from_date_time != '--' && isset($to_date_time) && !empty($to_date_time) && $to_date_time != '--') {

            $this->db->where('DATE_FORMAT(tab_1.created_date,"%Y-%m-%d")>=', $from_date_time);
            $this->db->where('DATE_FORMAT(tab_1.created_date,"%Y-%m-%d")<=', $to_date_time);
        }
        if (isset($counter_id) && !empty($counter_id)) {
            $this->db->like('tab_1.counter_id', $counter_id);
        }
        if (isset($emp_id) && !empty($emp_id)) {
            $this->db->like('tab_1.emp_id', $emp_id);
        }
        if (isset($status) && !empty($status)) {
            $this->db->like('tab_1.token_status', $status);
        }
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
        $this->db->where('tab_2.client_id', $client_id);
        $query = $this->db->get($this->que_token_details . ' AS tab_1');
        return $query->num_rows();
    }

    public function count_filtered($search_data, $client_id) {
        $this->db->select('tab_1.*,tab_2.emp_name,tab_3.counter_name');
        $this->db->join($this->que_employee . ' AS tab_2', 'tab_2.id = tab_1.emp_id', 'LEFT');
        $this->db->join($this->que_counter . ' AS tab_3', 'tab_3.id = tab_1.counter_id', 'LEFT');
        $counter_id = trim($search_data['counter_id']);
        $emp_id = $search_data['emp_id'];
        $status = $search_data['status'];
        $tkn_number = $search_data['tkn_number'];

        $sfrom = explode(' ', $search_data['from_date']);
        $date = explode('/', $sfrom[0]);

        $sfrom_date = $date[2] . "-" . $date[1] . "-" . $date[0];

        $from_date_time = $sfrom_date;

        $sto = explode(' ', $search_data['to_date']);
        $to_date = explode('/', $sto[0]);

        $sto_date = $to_date[2] . "-" . $to_date[1] . "-" . $to_date[0];
        $to_date_time = $sto_date;


        if (isset($from_date_time) && !empty($from_date_time) && $from_date_time != '--' && isset($to_date_time) && !empty($to_date_time) && $to_date_time != '--') {

            $this->db->where('DATE_FORMAT(tab_1.created_date,"%Y-%m-%d")>=', $from_date_time);
            $this->db->where('DATE_FORMAT(tab_1.created_date,"%Y-%m-%d")<=', $to_date_time);
        }
        if (isset($counter_id) && !empty($counter_id)) {
            $this->db->like('tab_1.counter_id', $counter_id);
        }
        if (isset($emp_id) && !empty($emp_id)) {
            $this->db->like('tab_1.emp_id', $emp_id);
        }
        if (isset($status) && !empty($status)) {
            $this->db->like('tab_1.token_status', $status);
        }
        if (isset($tkn_number) && !empty($tkn_number && $tkn_number != "Select Token Number")) {
            $this->db->where('tab_1.token_number', $tkn_number);
        }
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
        $this->db->where('tab_2.client_id', $client_id);
        $query = $this->db->get($this->que_token_details . ' AS tab_1');

        return $query->num_rows();
    }

    function get_emp_by_counter($counter_id) {
        $this->db->select('tab_1.*,tab_2.emp_name');
        $this->db->join($this->que_employee . ' AS tab_2', 'tab_2.id = tab_1.emp_id', 'LEFT');
        $this->db->where('counter_id', $counter_id);
        $query = $this->db->get($this->que_assign_counter . ' AS tab_1');

        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return 0;
    }

}
